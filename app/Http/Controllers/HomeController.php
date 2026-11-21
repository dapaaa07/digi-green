<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CoffeeProduct;
use App\Models\Destination;
use App\Models\QrPoint;
use App\Models\Report;
use App\Models\VillageProfile;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $profile = VillageProfile::first();
        $featuredDestinations = Destination::where('is_featured', true)
            ->orderBy('order_weight')
            ->take(4)
            ->get();

        if ($featuredDestinations->count() < 4) {
            $more = Destination::whereNotIn('id', $featuredDestinations->pluck('id'))
                ->orderBy('order_weight')
                ->take(4 - $featuredDestinations->count())
                ->get();
            $featuredDestinations = $featuredDestinations->concat($more);
        }

        $allDestinations = Destination::orderBy('order_weight')->get();
        $qrPoints = QrPoint::where('is_active', true)->get();
        $featuredCoffees = CoffeeProduct::where('is_available', true)->take(3)->get();
        $latestArticles = Article::where('is_published', true)->orderByDesc('published_at')->take(2)->get();

        $statistics = [
            'elevation' => '1.150 mdpl',
            'coffee_farmers' => '85+ Hektar',
            'qr_points' => $qrPoints->count() . ' Titik Plang',
            'resolved_reports' => Report::where('status', 'resolved')->count() . ' Ditindaklanjuti',
        ];

        return view('home', compact(
            'profile',
            'featuredDestinations',
            'allDestinations',
            'qrPoints',
            'featuredCoffees',
            'latestArticles',
            'statistics'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\QrPoint;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DestinationController extends Controller
{
    public function index(Request $request): View
    {
        $query = Destination::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $destinations = $query->orderBy('order_weight')->paginate(9);
        $categories = Destination::select('category')->distinct()->pluck('category');
        $allDestinations = Destination::orderBy('order_weight')->get();
        $qrPoints = QrPoint::where('is_active', true)->get();

        return view('destinations.index', compact('destinations', 'categories', 'allDestinations', 'qrPoints'));
    }

    public function show(string $slug): View
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();
        $otherDestinations = Destination::where('id', '!=', $destination->id)
            ->take(3)
            ->get();

        return view('destinations.show', compact('destination', 'otherDestinations'));
    }
}

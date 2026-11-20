<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminDestinationController extends Controller
{
    public function index(): View
    {
        $destinations = Destination::orderBy('order_weight')->paginate(15);
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create(): View
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'excerpt' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'required|string', // supports URL or uploaded path
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'google_maps_url' => 'nullable|url',
            'facilities_input' => 'nullable|string', // comma-separated facilities
            'operating_hours' => 'nullable|string|max:100',
            'price_info' => 'nullable|string|max:100',
            'contact_person' => 'nullable|string|max:100',
            'whatsapp_number' => 'nullable|string|max:30',
            'cleanliness_tips' => 'nullable|string',
            'is_featured' => 'boolean',
            'order_weight' => 'integer',
        ]);

        $slug = Str::slug($validated['name']);
        $uniqueSlug = $slug;
        $counter = 1;
        while (Destination::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = "{$slug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $uniqueSlug;

        $facilities = [];
        if (!empty($validated['facilities_input'])) {
            $facilities = array_map('trim', explode(',', $validated['facilities_input']));
        }
        $validated['facilities'] = $facilities;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['order_weight'] = (int) ($validated['order_weight'] ?? 0);

        unset($validated['facilities_input']);

        Destination::create($validated);

        return redirect()->route('admin.destinations.index')->with('success', 'Tempat wisata berhasil ditambahkan.');
    }

    public function edit(Destination $destination): View
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'excerpt' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'google_maps_url' => 'nullable|url',
            'facilities_input' => 'nullable|string',
            'operating_hours' => 'nullable|string|max:100',
            'price_info' => 'nullable|string|max:100',
            'contact_person' => 'nullable|string|max:100',
            'whatsapp_number' => 'nullable|string|max:30',
            'cleanliness_tips' => 'nullable|string',
            'is_featured' => 'boolean',
            'order_weight' => 'integer',
        ]);

        $facilities = [];
        if (!empty($validated['facilities_input'])) {
            $facilities = array_map('trim', explode(',', $validated['facilities_input']));
        }
        $validated['facilities'] = $facilities;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['order_weight'] = (int) ($validated['order_weight'] ?? 0);

        unset($validated['facilities_input']);

        $destination->update($validated);

        return redirect()->route('admin.destinations.index')->with('success', 'Data tempat wisata berhasil diperbarui.');
    }

    public function destroy(Destination $destination): RedirectResponse
    {
        $destination->delete();
        return redirect()->route('admin.destinations.index')->with('success', 'Tempat wisata berhasil dihapus.');
    }
}

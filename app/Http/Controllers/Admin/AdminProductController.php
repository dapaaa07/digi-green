<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoffeeProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    public function index(): View
    {
        $products = CoffeeProduct::orderBy('is_featured', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        return view('admin.products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'process_type' => 'required|string|max:100',
            'roast_level' => 'required|string|max:100',
            'flavor_notes' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'packaging_size' => 'required|string|max:50',
            'description' => 'nullable|string',
            'producer_name' => 'required|string|max:255',
            'contact_whatsapp' => 'required|string|max:30',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_available' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $imagePath = $validated['image'] ?? 'https://images.unsplash.com/photo-1587734195503-904fca47e0e9?auto=format&fit=crop&w=800&q=80';
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $imagePath = '/storage/' . $path;
        }

        $slug = Str::slug($validated['name']);
        $uniqueSlug = $slug;
        $counter = 1;
        while (CoffeeProduct::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = "{$slug}-{$counter}";
            $counter++;
        }

        CoffeeProduct::create([
            'name' => $validated['name'],
            'slug' => $uniqueSlug,
            'process_type' => $validated['process_type'],
            'roast_level' => $validated['roast_level'],
            'flavor_notes' => $validated['flavor_notes'] ?? null,
            'price' => $validated['price'],
            'packaging_size' => $validated['packaging_size'],
            'description' => $validated['description'] ?? null,
            'producer_name' => $validated['producer_name'],
            'contact_whatsapp' => $validated['contact_whatsapp'],
            'image' => $imagePath,
            'is_available' => $request->boolean('is_available'),
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk kopi baru berhasil ditambahkan.');
    }

    public function edit(CoffeeProduct $product): View
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, CoffeeProduct $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'process_type' => 'required|string|max:100',
            'roast_level' => 'required|string|max:100',
            'flavor_notes' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'packaging_size' => 'required|string|max:50',
            'description' => 'nullable|string',
            'producer_name' => 'required|string|max:255',
            'contact_whatsapp' => 'required|string|max:30',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_available' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $imagePath = $product->image;
        if ($request->filled('image')) {
            $imagePath = $request->image;
        }
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $imagePath = '/storage/' . $path;
        }

        if ($validated['name'] !== $product->name) {
            $slug = Str::slug($validated['name']);
            $uniqueSlug = $slug;
            $counter = 1;
            while (CoffeeProduct::where('slug', $uniqueSlug)->where('id', '!=', $product->id)->exists()) {
                $uniqueSlug = "{$slug}-{$counter}";
                $counter++;
            }
            $product->slug = $uniqueSlug;
        }

        $product->update([
            'name' => $validated['name'],
            'process_type' => $validated['process_type'],
            'roast_level' => $validated['roast_level'],
            'flavor_notes' => $validated['flavor_notes'] ?? null,
            'price' => $validated['price'],
            'packaging_size' => $validated['packaging_size'],
            'description' => $validated['description'] ?? null,
            'producer_name' => $validated['producer_name'],
            'contact_whatsapp' => $validated['contact_whatsapp'],
            'image' => $imagePath,
            'is_available' => $request->boolean('is_available'),
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Data produk kopi berhasil diperbarui.');
    }

    public function destroy(CoffeeProduct $product): RedirectResponse
    {
        $name = $product->name;
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', "Produk {$name} berhasil dihapus.");
    }
}

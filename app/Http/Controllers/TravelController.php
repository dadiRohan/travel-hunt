<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use App\Models\Tag;
use App\Models\TravelImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TravelController extends Controller
{
    /**
     * Show the home page with all travels.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tag = $request->input('tag');

        $travels = Travel::query();

        if ($search) {
            $travels = $travels->search($search);
        }

        if ($tag) {
            $travels = $travels->byTag($tag);
        }

        $travels = $travels->latest()
                          ->with(['user', 'images', 'tags', 'likes', 'comments'])
                          ->paginate(12);

        $tags = Tag::all();

        return view('travels.index', compact('travels', 'tags', 'search', 'tag'));
    }

    /**
     * Show the form for creating a new travel.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('travels.create', compact('tags'));
    }

    /**
     * Store a newly created travel in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'travel_date' => 'nullable|date',
            'images' => 'required|array|min:1|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
        ]);

        // Create the travel
        $travel = auth()->user()->travels()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'] ?? null,
            'travel_date' => $validated['travel_date'] ?? null,
        ]);

        // Store images
        if ($request->hasFile('images')) {
            $order = 0;
            foreach ($request->file('images') as $image) {
                $path = $image->store('travels', 'public');
                TravelImage::create([
                    'travel_id' => $travel->id,
                    'image_path' => $path,
                    'order' => $order++,
                ]);
            }
        }

        // Attach tags
        if (isset($validated['tags'])) {
            $travel->tags()->attach($validated['tags']);
        }

        return redirect()->route('travels.show', $travel->id)
                       ->with('success', 'Travel post created successfully!');
    }

    /**
     * Display the specified travel.
     */
    public function show(Travel $travel)
    {
        $travel->load(['user', 'images', 'tags', 'likes', 'comments.user']);
        
        // Get related travels from same tags
        $relatedTravels = Travel::whereHas('tags', function ($q) use ($travel) {
                                    $q->whereIn('tags.id', $travel->tags->pluck('id'));
                                })
                                ->where('id', '!=', $travel->id)
                                ->latest()
                                ->limit(6)
                                ->get();

        return view('travels.show', compact('travel', 'relatedTravels'));
    }

    /**
     * Show the form for editing the specified travel.
     */
    public function edit(Travel $travel)
    {
        $this->authorize('update', $travel);
        $tags = Tag::all();
        return view('travels.edit', compact('travel', 'tags'));
    }

    /**
     * Update the specified travel in storage.
     */
    public function update(Request $request, Travel $travel)
    {
        $this->authorize('update', $travel);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'travel_date' => 'nullable|date',
            'new_images' => 'nullable|array|max:10',
            'new_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
        ]);

        $travel->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'] ?? null,
            'travel_date' => $validated['travel_date'] ?? null,
        ]);

        // Add new images if provided
        if ($request->hasFile('new_images')) {
            $maxOrder = $travel->images()->max('order') ?? 0;
            foreach ($request->file('new_images') as $image) {
                $path = $image->store('travels', 'public');
                TravelImage::create([
                    'travel_id' => $travel->id,
                    'image_path' => $path,
                    'order' => ++$maxOrder,
                ]);
            }
        }

        // Update tags
        if (isset($validated['tags'])) {
            $travel->tags()->sync($validated['tags']);
        }

        return redirect()->route('travels.show', $travel->id)
                       ->with('success', 'Travel post updated successfully!');
    }

    /**
     * Remove the specified travel from storage.
     */
    public function destroy(Travel $travel)
    {
        $this->authorize('delete', $travel);

        // Delete images
        foreach ($travel->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $travel->delete();

        return redirect()->route('travels.index')
                       ->with('success', 'Travel post deleted successfully!');
    }

    /**
     * Delete a specific image from travel.
     */
    public function deleteImage($imageId)
    {
        $image = TravelImage::findOrFail($imageId);
        $travel = $image->travel;

        $this->authorize('delete', $travel);

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image deleted successfully!');
    }
}

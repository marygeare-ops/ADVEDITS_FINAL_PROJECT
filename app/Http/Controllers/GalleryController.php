<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $images = Gallery::query()
            ->where('is_published', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        // One main editorial photograph.
        $featuredImages = $images->take(1);

        // The next six photographs become collection cards.
        $collectionImages = $images->slice(1, 6);

        // All remaining photographs go into the photo gallery.
        $additionalImages = $images->slice(7);

        return view('gallery', [
            'featuredImages' => $featuredImages,
            'collectionImages' => $collectionImages,
            'additionalImages' => $additionalImages,
            'totalImages' => $images->count(),
        ]);
    }
}

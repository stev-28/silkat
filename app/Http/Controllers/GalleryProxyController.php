<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GalleryProxyController extends Controller
{
    public function fetchExternalGallery()
    {
        $url = 'https://dlht.papuabaratprov.go.id/pages/galeri';

        // Fetch the HTML content
        $response = Http::get($url);

        if (!$response->ok()) {
            return response()->json([], 500);
        }

        $html = $response->body();

        // Use DOMDocument to parse HTML
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);

        // Find gallery items (adjust the XPath as needed)
        $items = [];
        // Example: find all images in the gallery section
        foreach ($xpath->query('//img') as $img) {
            $src = $img->getAttribute('src');
            $title = $img->getAttribute('alt') ?: $img->getAttribute('title') ?: '';
            // Make sure the src is an absolute URL
            if ($src && !preg_match('#^https?://#', $src)) {
                $src = 'https://dlht.papuabaratprov.go.id' . $src;
            }
            // Only add if it's a real image (filter out logos, etc. as needed)
            if (strpos($src, 'galeri') !== false || strpos($src, 'gallery') !== false) {
                $items[] = [
                    'src' => $src,
                    'title' => $title,
                ];
            }
        }

        // If no images found, fallback to some text-based gallery items (optional)
        if (empty($items)) {
            // Try to extract gallery titles as fallback
            foreach ($xpath->query('//h2 | //h3') as $heading) {
                $text = trim($heading->textContent);
                if ($text) {
                    $items[] = [
                        'src' => null,
                        'title' => $text,
                    ];
                }
            }
        }

        return response()->json($items);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use DOMDocument;
use DOMXPath;

class GalleryProxyController extends Controller
{
    public function fetchExternalGallery(): JsonResponse
    {
        try {
            // Fetch the external gallery page
            $response = Http::timeout(30)->get('https://dlht.papuabaratprov.go.id/pages/galeri');
            
            if (!$response->successful()) {
                return response()->json([
                    'error' => 'Failed to fetch external gallery',
                    'status' => $response->status()
                ], 500);
            }

            $html = $response->body();
            
            // Create DOM document
            $dom = new DOMDocument();
            @$dom->loadHTML($html, LIBXML_NOERROR | LIBXML_NOWARNING);
            
            $xpath = new DOMXPath($dom);
            
            $items = [];
            
            // Find all article elements that contain gallery items
            $articles = $xpath->query('//article[contains(@class, "post")]');
            
            foreach ($articles as $article) {
                // Get the image element within the article
                $imgElement = $xpath->query('.//img[contains(@class, "img-thumbnail")]', $article)->item(0);
                
                if ($imgElement) {
                    $src = $imgElement->getAttribute('src');
                    $alt = $imgElement->getAttribute('alt') ?: '';
                    
                    // Get the title from the h2 element within the same article
                    $titleElement = $xpath->query('.//h2//a', $article)->item(0);
                    $title = $titleElement ? trim($titleElement->textContent) : $alt;
                    
                    // Ensure URL is absolute
                    if ($src && !preg_match('#^https?://#', $src)) {
                        $src = 'https://dlht.papuabaratprov.go.id' . $src;
                    }
                    
                    if ($src) {
                        $items[] = [
                            'src' => $src,
                            'title' => $title ?: 'Galeri DLHP Papua Barat',
                        ];
                    }
                }
            }
            
            // If no items found, return empty array
            if (empty($items)) {
                return response()->json([]);
            }
            
            return response()->json($items)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching gallery: ' . $e->getMessage()
            ], 500)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
        }
    }
}
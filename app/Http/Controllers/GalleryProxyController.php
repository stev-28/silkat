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
            $dom = new \DOMDocument();
            @$dom->loadHTML($html, LIBXML_NOERROR | LIBXML_NOWARNING);
            
            $xpath = new \DOMXPath($dom);
            
            $items = [];
            $unique = [];
            
            // Cari semua elemen galeri
            $cards = $xpath->query('//div[contains(@class, "card_custom")]');
            
            foreach ($cards as $card) {
                // Ambil gambar
                $img = $xpath->query('.//img', $card)->item(0);
                $src = $img ? $img->getAttribute('src') : null;

                // Ambil judul
                $titleElement = $xpath->query('.//div[contains(@class, "card_custom-body")]/h4/a', $card)->item(0);
                $title = $titleElement ? trim($titleElement->textContent) : '';

                // Ambil link detail (opsional)
                $link = $titleElement ? $titleElement->getAttribute('href') : '';

                // Filter: hanya ambil jika ada gambar dan judul, dan tidak duplikat
                if ($src && $title) {
                    $key = md5($src . $title);
                    if (!isset($unique[$key])) {
                        $items[] = [
                            'src' => $src,
                            'title' => $title,
                            'link' => $link,
                        ];
                        $unique[$key] = true;
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
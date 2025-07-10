<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BeritaContentController extends Controller
{
    public function getContent(Request $request): JsonResponse
    {
        $url = $request->get('url');
        
        if (!$url) {
            return response()->json([
                'success' => false,
                'message' => 'URL tidak valid'
            ]);
        }

        try {
            // Fetch content from URL
            $context = stream_context_create([
                'http' => [
                    'method' => 'GET',
                    'header' => [
                        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
                    ],
                    'timeout' => 10
                ]
            ]);

            $html = file_get_contents($url, false, $context);
            
            if ($html === false) {
                throw new \Exception('Gagal mengambil konten dari URL');
            }

            // Parse HTML untuk mengambil konten berita
            $content = $this->extractNewsContent($html);
            
            if ($content) {
                return response()->json([
                    'success' => true,
                    'content' => $content
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat mengekstrak konten berita'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat konten: ' . $e->getMessage()
            ]);
        }
    }

    private function extractNewsContent(string $html): ?string
    {
        // Remove script and style tags
        $html = preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/mi', '', $html);
        $html = preg_replace('/<style\b[^<]*(?:(?!<\/style>)<[^<]*)*<\/style>/mi', '', $html);
        
        // Try to find article content
        $patterns = [
            '/<article[^>]*>(.*?)<\/article>/si',
            '/<div[^>]*class="[^"]*content[^"]*"[^>]*>(.*?)<\/div>/si',
            '/<div[^>]*class="[^"]*post-content[^"]*"[^>]*>(.*?)<\/div>/si',
            '/<div[^>]*class="[^"]*entry-content[^"]*"[^>]*>(.*?)<\/div>/si',
            '/<div[^>]*id="content"[^>]*>(.*?)<\/div>/si',
            '/<div[^>]*class="[^"]*berita[^"]*"[^>]*>(.*?)<\/div>/si',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $html, $matches)) {
                $content = $matches[1];
                
                // Clean up the content
                $content = $this->cleanContent($content);
                
                if (strlen($content) > 100) { // Ensure we have meaningful content
                    return $content;
                }
            }
        }

        // If no specific content found, try to extract main content area
        if (preg_match('/<main[^>]*>(.*?)<\/main>/si', $html, $matches)) {
            $content = $this->cleanContent($matches[1]);
            if (strlen($content) > 100) {
                return $content;
            }
        }

        // Fallback: try to get body content
        if (preg_match('/<body[^>]*>(.*?)<\/body>/si', $html, $matches)) {
            $content = $this->cleanContent($matches[1]);
            if (strlen($content) > 100) {
                return $content;
            }
        }

        return null;
    }

    private function cleanContent(string $content): string
    {
        // Remove navigation, header, footer elements
        $content = preg_replace('/<nav[^>]*>.*?<\/nav>/si', '', $content);
        $content = preg_replace('/<header[^>]*>.*?<\/header>/si', '', $content);
        $content = preg_replace('/<footer[^>]*>.*?<\/footer>/si', '', $content);
        $content = preg_replace('/<aside[^>]*>.*?<\/aside>/si', '', $content);
        
        // Remove common unwanted elements
        $content = preg_replace('/<div[^>]*class="[^"]*(?:sidebar|menu|navigation|breadcrumb|post-share|post-meta)[^"]*"[^>]*>.*?<\/div>/si', '', $content);
        
        // Remove script and style tags
        $content = preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/mi', '', $content);
        $content = preg_replace('/<style\b[^<]*(?:(?!<\/style>)<[^<]*)*<\/style>/mi', '', $content);
        
        // Remove empty paragraphs and divs
        $content = preg_replace('/<p[^>]*>\s*<\/p>/i', '', $content);
        $content = preg_replace('/<div[^>]*>\s*<\/div>/i', '', $content);
        
        // Remove BR tags and replace with proper spacing
        $content = preg_replace('/<br\s*\/?>/i', "\n", $content);
        
        // Clean up HTML entities
        $content = html_entity_decode($content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        // Clean up whitespace
        $content = preg_replace('/\s+/', ' ', $content);
        $content = trim($content);
        
        return $content;
    }
} 
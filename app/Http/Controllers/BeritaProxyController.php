<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BeritaProxyController extends Controller
{
    public function fetchBerita()
    {
        $response = Http::get('https://dlht.papuabaratprov.go.id/pages/berita');
        $html = $response->body();
        $berita = [];

        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);

        // Ambil semua judul berita utama (h2/h3/h4, dsb)
        $items = $xpath->query('//div[contains(@class,"container") or contains(@class,"row")]/div[contains(@class,"card") or contains(@class,"berita") or contains(@class,"col")]//h2 | //h3 | //h4');
        if ($items->length === 0) {
            // fallback: ambil semua h2/h3/h4
            $items = $xpath->query('//h2 | //h3 | //h4');
        }
        foreach ($items as $node) {
            $judul = trim($node->textContent);
            $parent = $node->parentNode;
            $tanggal = '';
            $ringkasan = '';
            $link = '';
            $gambar = null;
            // Cari link
            $a = $parent->getElementsByTagName('a');
            if ($a->length > 0) {
                $link = $a->item(0)->getAttribute('href');
                if ($link && strpos($link, 'http') !== 0) {
                    $link = 'https://dlht.papuabaratprov.go.id' . $link;
                }
            }
            // Cari ringkasan (p di parent atau sibling)
            $p = $parent->getElementsByTagName('p');
            if ($p->length > 0) {
                $ringkasan = trim($p->item(0)->textContent);
            }
            // Cari tanggal (span atau p mengandung angka bulan/tahun)
            foreach ($parent->getElementsByTagName('p') as $pp) {
                if (preg_match('/\d{1,2}\s\w+,?\s?\d{2,4}/', $pp->textContent, $m)) {
                    $tanggal = $m[0];
                    break;
                }
            }
            // Selalu fetch halaman detail dan cari gambar utama
            if ($link) {
                try {
                    $detailRes = Http::timeout(5)->get($link);
                    if ($detailRes->ok()) {
                        $detailHtml = $detailRes->body();
                        $detailDom = new \DOMDocument();
                        libxml_use_internal_errors(true);
                        $detailDom->loadHTML($detailHtml);
                        $detailXpath = new \DOMXPath($detailDom);
                        // Cari <img> dengan class paling spesifik
                        $imgNode = $detailXpath->query('//img[contains(@class,"img-fluid") and contains(@class,"img-thumbnail-no-borders") and contains(@class,"img-thumbnail") and contains(@class,"rounded-0")]')->item(0);
                        // Fallback: <div class="post-image"> <img ...>
                        if (!$imgNode) {
                            $imgNode = $detailXpath->query('//div[contains(@class,"post-image")]//img')->item(0);
                        }
                        // Fallback: <img class="img-fluid">
                        if (!$imgNode) {
                            $imgNode = $detailXpath->query('//img[contains(@class,"img-fluid")]')->item(0);
                        }
                        if ($imgNode) {
                            $gambar = $imgNode->getAttribute('src');
                            if ($gambar && strpos($gambar, 'http') !== 0) {
                                $gambar = 'https://dlht.papuabaratprov.go.id' . $gambar;
                            }
                        }
                    }
                } catch (\Exception $e) {
                    // Jika gagal, biarkan $gambar null
                }
            }
            if ($judul && $link) {
                $berita[] = [
                    'judul' => $judul,
                    'tanggal' => $tanggal,
                    'ringkasan' => $ringkasan,
                    'link' => $link,
                    'gambar' => $gambar
                ];
            }
        }
        // Jika parsing gagal, fallback dummy
        if (empty($berita)) {
            $berita[] = [
                'judul' => 'Gagal parsing berita',
                'tanggal' => '',
                'ringkasan' => 'Tidak dapat mengambil berita dari sumber.',
                'link' => 'https://dlht.papuabaratprov.go.id/pages/berita'
            ];
        }
        return response()->json($berita);
    }
} 
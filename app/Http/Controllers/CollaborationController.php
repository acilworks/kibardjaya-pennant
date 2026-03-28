<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollaborationController extends Controller
{
    public function index()
    {
        $collaborations = [
            [
                'title' => 'Bali – Island of Stories',
                'image' => 'image/collaborate/collab-01.jpg',
                'tag'   => 'Destination Series',
                'desc'  => 'A tribute to the island that stays with you. Inspired by sunsets, waves, and quiet moments in between....',
                'url'   => '#',
            ],
            [
                'title' => 'Yogyakarta – Soul of Java',
                'image' => 'image/collaborate/collab-02.jpeg',
                'tag'   => 'Destination Series',
                'desc'  => 'Where tradition lives in every corner. A city of art, culture, and quiet resilience....',
                'url'   => '#',
            ],
            [
                'title' => 'Bromo – Land Above the Clouds',
                'image' => 'image/collaborate/collab-03.jpeg',
                'tag'   => 'Destination Series',
                'desc'  => 'Cold air, endless horizons, and silence that speaks. A memory from above the clouds....',
                'url'   => '#',
            ],
            [
                'title' => 'Handcraft Stories',
                'image' => 'image/collaborate/collab-04.jpg',
                'tag'   => 'Local Collab',
                'desc'  => 'Inspired by traditional patterns and reimagined for today. Where heritage meets modern craft....',
                'url'   => '#',
            ],
            [
                'title' => 'Coffee & Stories',
                'image' => 'image/collaborate/collab-05.jpg',
                'tag'   => 'Local Collab',
                'desc'  => 'Crafted for a small coffee shop that believes every cup has a story — just like every piece we make....',
                'url'   => '#',
            ],
            [
                'title' => 'Local Artist Series – Vol.01',
                'image' => 'image/collaborate/collab-06.jpeg',
                'tag'   => 'Artist Edition',
                'desc'  => 'A collaboration with a local artist exploring identity, texture, and modern heritage — translated into a collectible piece....',
                'url'   => '#',
            ],
        ];

        return view('collaborations.index', compact('collaborations'));
    }
}

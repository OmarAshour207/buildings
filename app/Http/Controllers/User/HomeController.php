<?php

namespace App\Http\Controllers\User;

use App\Building;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Thujohn\Rss\Rss;

class HomeController extends Controller
{
    public function generateRss(Rss $rss, Building $building)
    {
        $feed = $rss->feed('2.0', 'UTF-8');
        $feed->channel([
            'title'       => setting()->namesetting,
            'description' => setting()->description,
            'link'        => URL::to('/')
        ]);

        $buildings = $building->where('status', '1')->orderBy('id', 'desc')->get();
        foreach ($buildings as $bu) {
            $feed->item([
                'title' => $bu->name,
                'description|cdata' => $bu->description,
                'link' => \url('/building/'.$bu->id.'/'.str_replace(' ', '_', $bu->name))
            ]);
        }

        $feed->save('rss.xml');
        return view('admin.rss.rss');
    }

    public function rss(Rss $rss, Building $building)
    {
        $feed = $rss->feed('2.0', 'UTF-8');
        $feed->channel([
            'title'       => setting()->namesetting,
            'description' => setting()->description,
            'link'        => URL::to('/')
        ]);
        $buildings = $building->where('status', '1')->orderBy('id', 'desc')->get();
        foreach ($buildings as $bu) {
            $feed->item([
                'title' => $bu->name,
                'description|cdata' => $bu->description,
                'link' => \url('/building/'.$bu->id)
            ]);
        }

        return response($feed, 200)->header('Content-Type', 'text/xml');
    }
}

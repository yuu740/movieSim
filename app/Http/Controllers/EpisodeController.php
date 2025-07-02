<?php

namespace App\Http\Controllers;

use App\Models\Episodes;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    //
    public function createEpisode(Request $req) {
        $episodes = new Episodes();
        $episodes->movie_id = $req->movieID;
        $episodes->episodes = $req->episodes;
        $episodes->title = $req->title;

        $episodes->save();

        return redirect()->back();
    }
}

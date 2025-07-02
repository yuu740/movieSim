<?php

namespace App\Http\Controllers;

use App\Models\Episodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EpisodeController extends Controller
{
    //
    public function createEpisode(Request $req) {
        $rules = [
            'movieID' => 'required|exists:movies,id',
            'title' => 'required',
            'episodes' => 'required|starts_with:Episode'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        $episodes = new Episodes();
        $episodes->movie_id = $req->movieID;
        $episodes->episodes = $req->episodes;
        $episodes->title = $req->title;

        $episodes->save();

        return redirect()->back();
    }
}

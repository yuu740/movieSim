<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{

    public function index() {
        $movies= Movies::all();
        return view('index', ['movies' => $movies]);
    }
    public function createMovie(Request $req) {
        $file = $req->file('image');
        $imageName = time().'.'.$file->getClientOriginalExtension();
        Storage::putFileAs('public/images', $file, $imageName);
        $imageName = 'images/'.$imageName;
        $movie = new Movies();
        $movie->title = $req->title;
        $movie->description = $req->description; //based from name on view
        $movie->image = $imageName;

        $movie->save();

        return redirect()->back();

    }
}

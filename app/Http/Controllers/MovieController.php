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
        // Storage::disk('public')->putFileAs('images', $file, $imageName);
        Storage::putFileAs('images', $file, $imageName);
        // Storage::putFileAs('storage/app/private/public/images', $file, $imageName);

        $imageName = 'storage/images/'.$imageName;
        $movie = new Movies();
        $movie->title = $req->title;
        $movie->description = $req->description; //based from name on view
        $movie->image = $imageName;

        $movie->save();

        return redirect()->back();

    }

    public function updateMovie(Request $req) {
        $file = $req->file('image');



        $movie = Movies::find($req->id);



        $movie->title = $req->title != null ? $req->title : $movie->title;
        $movie->description = $req->description != null ? $req->description : $req->description; //based from name on view

        if ($file != null) {
            $imageName = time().'.'.$file->getClientOriginalExtension();
            // Storage::disk('public')->putFileAs('images', $file, $imageName);
            Storage::putFileAs('images', $file, $imageName);
            // Storage::putFileAs('storage/app/private/public/images', $file, $imageName);

            $imageName = 'storage/images/'.$imageName;
            Storage::delete('public/'.$movie->image);

        }
        else {
            $movie->image = $movie->image;
        }
        $movie->image = $imageName;

        $movie->save();

        return redirect()->back();

    }

    public function deleteMovie($id) {
        $movie = Movies::find($id);

        if (isset($movie)) {
            Storage::delete('public/'.$movie->image);
            $movie->delete();
        }
        return redirect()->back();
    }
}

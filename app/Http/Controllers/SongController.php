<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Song::class, 'song');
    // }

    public function index()
    {
        $songs = Song::all();
        return view('songs.index', compact('songs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'lyrics' => 'required|string',
        ]);

        Song::create($request->all());

        return redirect()->route('songs.index')->with('success', 'Song created successfully.');
    }

    public function show(string $id)
    {
        $song = Song::find($id);

        if (!$song) {
            return response()->json(['message' => 'Song not found'], 404);
        }

        // $this->authorize('view', $song);

        return response()->json($song);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'lyrics' => 'required|string',
        ]);

        $song = Song::findOrFail($id);
        $song->update($request->all());

        return redirect()->route('songs.index')->with('success', 'Song updated successfully.');
    }

        public function add()
    {
        return view('songs.create');
    }

    public function showLyrics($id)
{
    $song = Song::findOrFail($id);
    return view('songs.lyrics', compact('song'));
}



    public function edit($id)
    {
        $song = Song::find($id);
        if (!$song) {
            abort(404, 'Song not found');
        }
        return view('songs.edit', compact('song'));
    }

    public function destroy(string $id)
    {
        $song = Song::find($id);

        if (!$song) {
            return response()->json(['message' => 'Song not found'], 404);
        }

        // $this->authorize('delete', $song);

        if ($song->file_path) {
            Storage::delete($song->file_path);
        }
        $song->delete();

        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $songs = Song::where('title', 'LIKE', "%{$query}%")->get();
        return view('songs.index', compact('songs'));
    }
}

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Song</h2>
    <form method="POST" action="{{ route('songs.update', $song->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ $song->title }}" required>
        </div>
        <div class="form-group">
            <label for="artist">Artist</label>
            <input type="text" id="artist" name="artist" class="form-control" value="{{ $song->artist }}" required>
        </div>
        <div class="form-group">
            <label for="lyrics">Lyrics</label>
            <textarea id="lyrics" name="lyrics" class="form-control" required>{{ $song->lyrics }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

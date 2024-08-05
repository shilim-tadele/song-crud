@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Song</h2>
    <form method="POST" action="{{ route('songs.store') }}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="artist">Artist</label>
            <input type="text" id="artist" name="artist" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="lyrics">Lyrics</label>
            <textarea id="lyrics" name="lyrics" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection

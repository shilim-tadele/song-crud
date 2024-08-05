@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Songs</h2>

    @if(auth()->user()->is_admin)
    <div class="mb-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addSongModal">Add Song</button>
    </div>
    @endif

    <form method="GET" action="{{ route('songs.search') }}" class="mb-4">
        <input type="text" name="query" placeholder="Search for a song" class="form-control">
        <button type="submit" class="btn btn-secondary mt-2">Search</button>
    </form>

    <ul class="list-group">
    @foreach($songs as $song)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('songs.lyrics', $song->id) }}">{{ $song->title }}</a>

            @if(auth()->user()->is_admin)
                <div class="btn-group" role="group" aria-label="Admin Actions">
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editSongModal{{ $song->id }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('songs.destroy', $song->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this song?');" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            @endif
        </li>
    @endforeach
</ul>

</div>

<!-- Add Song Modal -->
<div class="modal fade" id="addSongModal" tabindex="-1" role="dialog" aria-labelledby="addSongModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSongModalLabel">Add Song</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
        </div>
    </div>
</div>

<!-- Edit Song Modals -->
@foreach($songs as $song)
<div class="modal fade" id="editSongModal{{ $song->id }}" tabindex="-1" role="dialog" aria-labelledby="editSongModalLabel{{ $song->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSongModalLabel{{ $song->id }}">Edit Song</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
        </div>
    </div>
</div>
@endforeach

@endsection

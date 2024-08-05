@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Search Songs</h2>
    <form method="GET" action="{{ route('songs.search') }}">
        <input type="text" name="title" placeholder="Song title">
        <button type="submit">Search</button>
    </form>
    @if(isset($songs))
        <ul>
            @foreach($songs as $song)
                <li><a href="{{ route('songs.show', $song->id) }}">{{ $song->title }}</a></li>
            @endforeach
        </ul>
    @endif
</div>
@endsection

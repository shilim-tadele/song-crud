@extends('layouts.app')

@section('content')
<div class="lyrics-container">
    <h2>{{ $song->title }} by {{ $song->artist }}</h2>
    <div class="lyrics-container mt-4">
        <pre>{{ $song->lyrics }}</pre>
    </div>
    <div class="mt-4">
        <a href="{{ route('songs.index') }}" class="btn btn-secondary">Back to Songs</a>
    </div>
</div>
@endsection

@section('styles')
<style>
    .lyrics-container {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        overflow-y: auto;
        white-space: pre-wrap; /* This ensures the text wraps within the container */
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        height: 400px; /* Optional: Set a fixed height to enable scrolling */
    }
    pre {
        white-space: pre-wrap; 
        word-wrap: break-word; 
    }
</style>
@endsection

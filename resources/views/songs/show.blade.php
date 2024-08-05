@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $song->title }}</h2>
    <p><strong>Artist:</strong> {{ $song->artist }}</p>
    <p>{{ $song->lyrics }}</p>
</div>
@endsection

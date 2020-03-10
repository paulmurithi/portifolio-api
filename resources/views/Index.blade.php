@extends('base')

@section('title', 'murithipaul')

@section('content')
    <h1>content section </h1>
    @forelse ($projects as $project)
        @php
            dd($project);
        @endphp
    @empty
        <h1>No projects to show</h1>
    @endforelse
@endsection
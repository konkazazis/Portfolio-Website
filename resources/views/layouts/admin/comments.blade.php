@extends('layouts.master')

@section('title', 'Comments')

@section('content')
    <div class="max-w-4xl mx-auto">

        <h1 class="font-serif text-3xl font-bold mb-8">Comments</h1>

        @foreach($comments as $comment)
            <div class="py-4 border-b border-stone-100">
                <p class="font-medium">{{ $comment->name }}</p>
                <p class="text-sm text-stone-400">{{ $comment->email }}</p>
                <p>{{ $comment->content }}</p>
            </div>
        @endforeach

    </div>
@endsection
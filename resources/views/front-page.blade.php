@extends('layouts.app')

@section('content')


    <div class="max-w-[600px] mx-auto mt-4">

        <img class="rounded" src="{{ Vite::asset('resources/images/sage-vite.png') }}" alt="Sage + Vite Logo">

        <p class="text-center">
            @hello('Homer', 'Simpson')
        </p>

        @if($pokemons)
            <ul class="text-center">
                @foreach ($pokemons as $pokemon)
                    <li>{!! $pokemon->post_title !!}</li>
                @endforeach
            </ul>

        @else
            <p>You don't have pokemons :( </p>    
        @endif

    </div>
    

@endsection

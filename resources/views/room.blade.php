@extends('layouts.app')

@section('content')

    <section>
        <div class="container">
            @if(Auth::check())
                <private-chat-component
                        :room="{{ json_encode($room) }}"
                        :id="{{ json_encode($id) }}"
                        :user="{{ Auth::user() }}"
                />
            @endif
        </div>
    </section>

@endsection
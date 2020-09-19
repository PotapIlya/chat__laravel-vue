@extends('layouts.app')

@section('content')

    <section>
        <div class="container">
            <chat-component
                :chat="{{ json_encode($chat) }}"
            />
        </div>
    </section>
@endsection
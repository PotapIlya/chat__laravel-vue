@extends('layouts.app')

@section('content')

    <section>
        <div class="container">
            <div class="d-flex flex-column">
                <ul class="my-3 list-inline">

                    @foreach($chat as $item)
                        <li>
                            <span class="d-block">{{ $item->name }}</span>
                            <span class="d-block h3">{{ $item->message }}</span>
                        </li>
                    @endforeach
                </ul>
                <form action="/message" method="POST" id="form" class="d-flex flex-column">
                    @csrf
                    <input type="text" name="name" required>
                    <textarea required name="message" id="" cols="30" rows="10"></textarea>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () =>
        {

            const socket = io(':6001');

{{--            const formElem = document.getElementById('form');--}}
{{--            formElem.onsubmit = async (e) => {--}}

{{--                console.log('click')--}}

{{--                e.preventDefault();--}}

{{--                const text = formElem.querySelector('textarea');--}}
{{--                const msg = { message: text.value}--}}

{{--                socket.send(msg);--}}
{{--                return false;--}}
{{--            };--}}


            socket.on('laravel_database_chat:message', function (data) {
                console.log(data)
            })


        })
    </script>

@endsection
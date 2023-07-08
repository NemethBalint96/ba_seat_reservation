@extends('layouts.app')

@section('content')
    <h1>Payment</h1>

    {{$msg}}

    <form method="POST" action="{{ route('payment') }}">
        @csrf

        <input type="email" name="email">

        <button type="submit">"Fizetés"</button>
    </form>
@endsection
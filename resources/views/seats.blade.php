@extends('layouts.app')

@section('content')
    <h1>Seats</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('reserve-seats') }}">
        @csrf

        @foreach($seats as $seat)
            <div>
                <input type="checkbox" name="seats[]" value="{{ $seat->id }}" {{ $seat->status !== 'szabad' ? 'disabled' : '' }}>
                <label>szék {{ $seat->id }} státusza: {{$seat->status}}</label>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary" id="reserveButton" disabled>Foglalás</button>
    </form>

    <form method="GET" action="{{ route('reset') }}" >
        <button>Reset</button>
    </form>

    {{-- <script src="{{ asset('js/formValidation.js') }}"></script> --}}
    <script src="../js/formValidation.js"></script>
@endsection
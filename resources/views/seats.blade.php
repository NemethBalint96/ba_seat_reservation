@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Székek</h1>

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
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="seats[]" value="{{ $seat->id }}" {{ $seat->status !== 'szabad' ? 'disabled' : '' }}>
                        <label class="form-check-label">Szék {{ $seat->id }} státusza: {{$seat->status}}</label>
                    </div>
                </div>
            @endforeach

            @error('seats')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary mb-3" id="reserveButton">Foglalás</button>
        </form>
    </div>
@endsection
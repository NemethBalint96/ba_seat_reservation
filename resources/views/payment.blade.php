@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Vásárlás</h1>

    <p>A vásárlásra 2 perc áll rendelkezésre. Az idő lejártával a foglalás felszabadul.</p>
    <p>Foglalás:</p></p>
    @foreach($seats as $seat)
        <p>Szék {{$seat}}</p>
    @endforeach

    <form method="POST" action="{{ route('payment') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">E-mail cím</label>
            <input type="email" class="form-control" id="email" name="email">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">"Fizetés"</button>
    </form>
@endsection
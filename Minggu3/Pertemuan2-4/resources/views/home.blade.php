@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Home Page</h1>
            <p class="lead"> This is the Home Page</p>
        </div>
        <p>Nama : {{ $nama }}</p>
        <p>mata Pelajaran</p>
        <ul>
            @foreach ($pelajaran as $i)
                <li>{{ $i }}</li>
            @endforeach
        </ul>
    </div>
@endsection
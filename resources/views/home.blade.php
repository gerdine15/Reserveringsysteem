@extends('layouts.app')

@section('content')
<div class="container">
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

    <div class="row">
        <table class="table table-bordered">
            <thead>
                <th scope="col">Baan/ Uur</th>
                @foreach($courts as $court)
                    <th scope="col">{{ $court->number }} {{ $court->type }}</th>
                @endforeach
            </thead>
            <tbody>
                {{-- @foreach($hours as $hour)

                @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
@endsection

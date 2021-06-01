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

    <div class="row title-wrap">
        <div class="col-md-12">
            <h1>
                Reserveren
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7 col-sm-12">
            <form action="{{ route('reservation.store', ['information' => $information]) }}" class="form-horizontal mt-4 row" method="POST">
            @csrf
                <div class="col">
                    <div class="form-group">
                        <label for="reservationUser">Gereserveerd door:</label>

                        <div class="font-weight-bold">
                            {{ $user->firstname }}
                            {{ $user->prefix }}
                            {{ $user->lastname }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date">Datum:</label>

                        <div class="font-weight-bold">
                            <input type="text" value="{{ $information->starttime->format('l d F Y') }}" name="date" id="date" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="time">Tijd:</label>

                        <div class="font-weight-bold">
                            {{ $information->starttime->format('H:i') }} - {{ $information->endtime->format('H:i') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="courtType">Baan en type:</label>

                        <div class="font-weight-bold">
                            <input type="hidden" id="courts_id" name="courts_id" value="{{ $information->courts_id }}">
                            {{ $information->courtNumber }} | {{ $information->courtType }}
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="users">Met welke medespeler(s)</label>

                        <div>
                            <select name="users" id="users">
                                <option value="">Maak een keuze..</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->prefix }} {{ $user->lastname}} | {{ $user->member }}</option>
                                @endforeach
                            </select>

                            @error ('users')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="opslaan" class="btn btn-secondary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

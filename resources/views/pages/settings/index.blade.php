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
                Instellingen
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <form action="{{ route('setting.update', ['setting' => $setting]) }}" class="form-horizontal mt-4 row" method="POST">
                @method('PUT')
                @csrf

                <div class="col">
                    <div class="form-group">
                        <label for="timeslot">Tijd reserveringsslot (minuten):</label>

                        <div>
                            <input type="text" id="timeslot" name="timeslot" value={{ $setting->timeslot }}>

                            @error('timeslot')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="amountOfReservations">Maximale aantal reserveringen:</label>

                        <div>
                            <input type="text" id="amountOfReservations" name="amountOfReservations" value="{{ $setting->amountOfReservations ?? old('amountOfReservations') }}">

                            @error('amountOfReservations')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Redirect naar het banen overzicht. --}}
                    {{-- <div class="form-group">
                        <div>
                            <a type="button" class="btn btn-primary">Banen overzicht</a>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <div>
                            <input type="submit" value="Opslaan">
                        </div>
                    </div>
                </div>
                <div class="col date">
                    <div class="form-group">
                        <label for="startdate">Start datum nieuwe reserveringsslot:</label>

                        <div>
                            <input type="date" id="startdate" name="startdate" value="{{ $setting->startdate ?? old('startdate') }}">

                            @error('startdate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="enddate">Tot</label>

                        <div>
                            <input type="date" id="enddate" name="enddate" value="{{ $setting->enddate ?? old('enddate') }}">

                            @error('enddate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

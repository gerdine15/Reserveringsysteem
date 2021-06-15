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

    <div class="row title-wrap text-center mb-2">
        <div class="col-md-12">
            <h3>
                <a href="{{ url("/home?date=" . $previousDay->format('Y-m-d')) }}" class="text-decoration-none text-dark">
                    <i class="fas fa-chevron-left"></i>
                </a>

                <span class="currentDate">
                    {{ $date->format('l d F Y') }}
                </span>

                <input type="date" class="d-none" id="newDate" name="date">

                <a href="{{ url("/home?date=" . $nextDay->format('Y-m-d')) }}" class="text-decoration-none text-dark">
                    <i class='fas fa-chevron-right'></i>
                </a>
            </h3>
        </div>
    </div>

    <div class="row">
        <table class="table table-bordered">
            <thead>
                <th scope="col">Baan/ Uur</th>
                @foreach($courts as $court)
                    <th scope="col">{{ $court->number }} {{ $court->type }}</th>
                @endforeach
            </thead>
            <tbody>
                @for ($i = $starttime; $i < $endtime; $i += $timeslot)
                <tr>
                    <td>
                        {{date('H:i', mktime($i / 60, $i % 60))}}
                    </td>

                    @for ($c = 0; $c < $courts->count(); $c++)
                        <td>
                            @php
                                $s = $reservations[$c]->filter(function ($value, $key) use ($i) {
                                    return date('H:i', mktime($i / 60, $i % 60)) == date("H:i",strtotime($value->starttime));
                                })->values();
                            @endphp

                            @if (isset($s[0]))
                                Gereserveerd
                            @else
                                <form action="{{ url('/reservation/create') }}">
                                    <input type="hidden"name="time" value="{{ date('H:i', mktime($i / 60, $i % 60)) }}">
                                    <input type="hidden" name="date" value="{{ $date }}">
                                    <input type="hidden" name="courts_id" value="{{ $courts[$c]->id }}">
                                    <input type="hidden" name="timeslot" value="{{ $timeslot }}">
                                    <input type="submit" class="btn btn-primary" value="Reserveren">
                                </form>
                            @endif
                        </td>
                    @endfor
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection

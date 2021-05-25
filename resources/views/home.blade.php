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
                <i class="fas fa-chevron-left"></i>
                {{ $date }}
                <i class="fas fa-chevron-right"></i>
            </h3>
            <input type="date" class="d-none">
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
                @for($i = $starttime; $i < $endtime; $i += $timeslot)
                    <tr>
                        <td>
                            {{date('H:i', mktime($i / 60, $i % 60))}}
                        </td>
                        @foreach($reservations as $reservation)
                            <td>
                                @foreach ($reservation as $item)
                                    @if (date('H:i:s', mktime($i / 60, $i % 60, 0)) == $item->starttime)
                                        Gereserveerd
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection

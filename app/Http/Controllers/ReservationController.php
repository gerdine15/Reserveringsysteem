<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Models\Court;
use App\Models\Reservation;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ReservationController extends Controller
{
    //
    public function index()
    {
        return view('pages.reservations.index');
    }

    public function create(Request $request)
    {
        $users = User::all() ?? [];
        $user = Auth::user();
        $setting = Setting::where('clubs_id', $user->clubs_id)->first();
        $court = Court::where('id', $request->courts_id)->first();

        $information = new stdClass();
        $information->starttime = Carbon::parse($request->time);
        $information->endtime = Carbon::parse($request->time)->addMinutes($setting->timeslot);
        $information->courts_id = $request->courts_id;
        $information->courtNumber = $court->number;
        $information->courtType = $court->type;

        return view('pages.reservations.create', ['users' => $users, 'user' => $user, 'information' => $information]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $setting = Setting::where('clubs_id', $user->clubs_id)->first();

        $validated = $request->validated();

        $reservation = new Reservation();
        $reservation->starttime = $validated->starttime;


        // dd($validated);

        // $reservation = new Reservation();
        // $reservation->starttime = $validated->starttime;
        // $reservation->endtime = ($validated->endtime + $setting->timeslot);
    }
}

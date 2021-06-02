<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Models\Court;
use App\Models\Reservation;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $information->date = Carbon::parse($request->date);
        $information->courts_id = $request->courts_id;
        $information->courtNumber = $court->number;
        $information->courtType = $court->type;

        return view('pages.reservations.create', ['users' => $users, 'user' => $user, 'information' => $information]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = User::find($request->userId);

            $request->starttime = Carbon::parse($request->starttime)->format('H:i');
            $request->endtime = Carbon::parse($request->endtime)->format('H:i');
            $starttime = $request->date . ' ' . $request->starttime;
            $endtime = $request->date . ' ' . $request->endtime;

            $reservation = new Reservation();
            $reservation->starttime = Carbon::parse($starttime);
            $reservation->endtime = Carbon::parse($endtime);
            $reservation->courts_id = $request->courts_id;
            $reservation->save();

            foreach($request->users as $member)
            {
                $member = User::find($member);
                $member->reservations()->attach($reservation);
            }

            $user->reservations()->attach($reservation);
        } catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Er is iets fout gegaan.');
        }

        DB::commit();
        return redirect(route('home', ['date' => $request->date]))->with('success', 'Baan succesvol gereserveerd!');

    }
}

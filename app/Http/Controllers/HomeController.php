<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Court;
use App\Models\Reservation;
use App\Models\Setting;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $courts = Court::where('clubs_id', $user->clubs_id)->get();
        $setting = Setting::where('clubs_id', $user->clubs_id)->first();
        $reservations = [];

        if ($request->date) {
            $date = Carbon::parse($request->date);
        } else {
            $date = Carbon::today();
        }

        foreach ($courts as $court)
        {
            $reservations[] = Reservation::where('courts_id', $court->id)
                                            ->whereDate('starttime', $date)
                                            ->get();
        }

        // dd($reservations);

        $starttime = 8 * 60;
        $endtime = 23 * 60;

        return view('home',
        [
            'courts' => $courts,
            'reservations' => $reservations,
            'starttime' => $starttime,
            'endtime' => $endtime,
            'timeslot' => $setting->timeslot,
            'date' => $date,
            'previousDay' => $date->copy()->subDays(),
            'nextDay' => $date->copy()->addDay(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingUpdateRequest;
use App\Models\Club;
use App\Models\Court;
use App\Models\Reservation;
use App\Models\Setting;
use App\Models\Timeslot;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $setting = Setting::where('clubs_id', $user->clubs_id)->first();

        return view('pages.settings.index', ['setting' => $setting]);
    }

    public function update(SettingUpdateRequest $request, Setting $setting)
    {
        DB::beginTransaction();

        $validated = $request->validated();

        try
        {
            $setting->amountOfReservations = $validated['amountOfReservations'];
            if ($validated['timeslot'] !== $setting->timeslot)
            {
                $timeslot = new Timeslot();
                $timeslot->minutes = $validated['timeslot'];
                $timeslot->startdate = $validated['startdate'];
                $timeslot->enddate = $validated['enddate'];
                $timeslot->settings_id = $setting->id;
                $timeslot->save();
            }
            $setting->save();
        } catch (Exception $e)
        {
            DB::rollback();
            // dd($e);
            return redirect()->back()->with('error', 'Er is iets fout gegaan.');
        }

        DB::commit();
        return redirect(route('setting.index'))->with('success', 'Instellingen succesvol gewijzigd.');
    }

    public function getLatestReservation(Club $club)
    {
        DB::beginTransaction();

        try
        {
            $courts = Court::where('clubs_id', $club->id)->get();

            foreach ($courts as $court)
            {
                $reservations[] = Reservation::where('courts_id', $court->id)->orderBy('endtime', 'desc')->first();
            }

            $collection = collect($reservations);
            $time = $collection->max('endtime');
        } catch (Exception $e)
        {
            DB::rollback();
            return redirect()->back()->with('error', 'Er is iets fout gegaan.');
        }
        DB::commit();
        return json_encode(Carbon::parse($time)->addDay()->format('Y-m-d'));
    }
}

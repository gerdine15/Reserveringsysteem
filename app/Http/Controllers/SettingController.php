<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingUpdateRequest;
use App\Models\Setting;
use App\Models\User;
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
                $setting->timeslot = $validated['timeslot'];
                $setting->startdate = $validated['startdate'];
                $setting->enddate = $validated['enddate'];
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
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //
    public function index()
    {
        return view('pages.reservations.index');
    }

    public function create()
    {
        $users = User::all() ?? [];

        return view('pages.reservations.create', ['users' => $users]);
    }

    public function store(ReservationStoreRequest $request)
    {

    }
}

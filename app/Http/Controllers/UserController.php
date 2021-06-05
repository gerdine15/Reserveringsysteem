<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all() ?? [];
        $roles = Role::get();

        return view('pages.user.index', ['users' => $users, 'roles' => $roles]);
    }

    public function show(Request $request, User $user)
    {
        if ($request->ajax()) {
            return [
                'id' => $user->id,
                'name' => $user->firstname . ' '. $user->prefix . ' ' . $user->lastname,
                'role_id' => $user->roles_id,
            ];
        }
    }

    public function update(Request $request, User $user)
    {
        DB::beginTransaction();

        try {
            $user->roles_id = $request->role_id;
            $user->save();
        } catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Er is iets fout gegaan.');
        }

        DB::commit();
        return $user;
    }
}

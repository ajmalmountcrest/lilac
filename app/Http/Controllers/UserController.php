<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('department', 'designation')->get();
        return view('index', compact('users'));
    }

    public function search(Request $request)
    {
        $search=$request->input('search') ;
        $query = User::with('department', 'designation')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('department', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('designation', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            });

        $users = $query->get();

        return response()->json($users);
    }
}

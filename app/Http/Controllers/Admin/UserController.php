<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
        
            $query->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
            });
        }        

        $perPage = $request->input('perPage', session('perPage', 5));
        session(['perPage' => $perPage]);
        $users = $query->paginate($perPage);
        return view('admin.users.index', compact('users'));
    }
}

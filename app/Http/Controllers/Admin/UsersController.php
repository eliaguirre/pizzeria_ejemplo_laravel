<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use App\User;

class UsersController extends Controller
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


    public function index(Request $request)
    {
        return view('admin/users');
    }

    public function list(Request $request)
    {
        return  User::all('id', 'name', 'email', 'role');
    }

    public function add(Request $request)
    {
        $this->validate($request, [
          'email' => 'required|string|email|max:200',
          'name' => 'required|string|max:200',
          'password' => 'required|confirmed|string|max:300',
          'role' => 'required|string|max:300'
         ]);
        $user = new User();
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->role = $request->input('role');
        $user->password = \Hash::make( $request->input('password') );
        $user->save();
        return $this->list($request);
    }

    public function delete(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->delete();
        return $this->list($request);
    }
}

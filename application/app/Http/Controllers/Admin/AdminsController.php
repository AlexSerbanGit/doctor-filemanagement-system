<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;

class AdminsController extends Controller
{
    
    public function index(){
        $users = User::where('role_id', '=', 1)->sortable()->paginate(15);

        $total = User::where('role_id', '=', 1)->count();
        return view('admin.admins')->with([
            'users' => $users,
            'total' => $total,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191|unique:users', 
            'full_name' => 'required|string|max:191', 
            'email' => 'required|string|max:191|unique:users',
            'password' => 'required|string|max:191',
            'phone_number' => ['required', 'string', 'max:20'],
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error', 'Invalid data sent');
        }

        $user = new User;
        $user->name = $request->name;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = 1;
        $user->phone_number = $request->phone_number;
        $user->save();

        return redirect()->back()->with('success', 'Admin created!');
    }

    public function edit(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191', 
            'full_name' => 'required|string|max:191', 
            'email' => 'required|string|max:191|email',
            'phone_number' => ['required', 'string', 'max:20'],
        ]);
    
        if($validator->fails()){
            return redirect()->back()->with('error', 'Invalid data sent');
        }

        $user = User::find($id);
        if($user && $user->role_id == 1){

            if($request->email != $user->email){
                $users = User::where('email', '=', $request->email)->get();

                if($users->count() > 0){
                    return redirect()->back()->with('error', 'There is a user with that email already registered!');
                }
                $user->email = $request->email;

            }

            if($request->name != $user->name){
                $users = User::where('name', '=', $request->name)->get();

                if($users->count() > 0){
                    return redirect()->back()->with('error', 'There is a user with that username already registered!');
                }
                $user->name = $request->name;

            }

            if($request->password){
                $user->password = bcrypt($request->password);
            }
            
            $user->full_name = $request->full_name;
            $user->phone_number = $request->phone_number;
            $user->save();
            
    
            return redirect()->back()->with('success', 'Admin updated!');
        }

        return redirect()->back()->with('error', 'This user does not exist or its not a patient');
    }

}

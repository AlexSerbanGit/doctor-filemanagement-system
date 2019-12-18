<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class PatientsController extends Controller
{
    
    public function index(){
        $users = User::where('role_id', '=', 2)->paginate(15);

        return view('admin.patients')->with([
            'users' => $users,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191', 
            'email' => 'required|string|max:191',
            'password' => 'required|string|max:191',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error', 'Invalid data sent');
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = 2;
        $user->save();

        return redirect()->back()->with('success', 'Patient created!');
    }

    public function edit(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191', 
            'email' => 'required|string|max:191',
        ]);
    
        if($validator->fails()){
            return redirect()->back()->with('error', 'Invalid data sent');
        }

        $user = User::find($id);
        if($user && $user->role_id == 2){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
    
            return redirect()->back()->with('success', 'Patient updated!');
        }

        return redirect()->back()->with('error', 'This user does not exist or its not a patient');
    }

    public function delete($id){

        $user = User::find($id);

        if($user && $user->role_id == 2){
            $user->delete();
            
            return redirect()->back()->with('success', 'Patient deleted!');
        }

        return redirect()->back()->with('error', 'This user does not exist or its not a patient');

    }

}

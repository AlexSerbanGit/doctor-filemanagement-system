<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class ConvenantsController extends Controller
{
    public function index(){
        $users = User::where('role_id', '=', 3)->paginate(15);
        return view('admin.convenants')->with([
            'users' => $users,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191', 
            'email' => 'required|string|max:191|unique:users',
            'password' => 'required|string|max:191',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error', 'Invalid data sent');
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = 3;
        $user->save();

        return redirect()->back()->with('success', 'Convenant created!');
    }

    public function edit(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191', 
            'email' => 'required|string|max:191|unique:users',
        ]);
    
        if($validator->fails()){
            return redirect()->back()->with('error', 'Invalid data sent');
        }

        $user = User::find($id);
        if($user && $user->role_id == 3){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
    
            return redirect()->back()->with('success', 'Convenant updated!');
        }

        return redirect()->back()->with('error', 'This user does not exist or its not a convenant');
    }

    public function delete($id){

        $user = User::find($id);

        if($user && $user->role_id == 3){
            $user->delete();
            
            return redirect()->back()->with('success', 'Convenant deleted!');
        }

        return redirect()->back()->with('error', 'This user does not exist or its not a convenant');

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;

class UserController extends Controller
{
    public function Users() {
        Session::put('page', 'users');
        $users = User::get()->toArray();
        return view('admin.users.users')->with(compact('users'));
    }

    public function updateUserStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            User::where('id', $data['user_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'user_id'=>$data['user_id']]);
        }
    }

    public function deleteUser($id) {
        User::where('id', $id)->delete();
        $message = "User has been deleted successfully!";
        
        return redirect()->back()->with('success_message', $message);
    }
}

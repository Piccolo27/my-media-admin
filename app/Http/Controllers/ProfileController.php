<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct admin home page
    public function index()
    {
        $id = Auth::user()->id;

        $user = User::select('id','name','address','phone','gender','email')->where('id',$id)->first();
        return view('admin.profile.index')->with(['user' => $user]);
    }

    //update account info
    public function update(Request $request)
    {
        $userData = $this->getUserInfo($request);
        $validator = $this->userValidationCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        User::where('id',Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess' => 'Admin account updated']);
    }

    //password chnage page
    public function changePasswordPage()
    {
        return view('admin.profile.changePassword');
    }

    //change password
    public function changePassword(Request $request)
    {
        $validator = $this->changePasswordValidationCheck($request);

        if($validator)
        if ($validator->fails())
        {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $dbPassword = User::where('id',Auth::user()->id)->first()->password;
        $hashPassword = Hash::make($request->newPassword); //get hash password from user new password

        $data = [
            'password' => $hashPassword,
            'updated_at' => Carbon::now()
        ];

        if(Hash::check($request->oldPassword, $dbPassword))
        {
            User::where('id',Auth::user()->id)->update($data);
            return redirect()->route('dashboard');
        }
        else
        {
            return back()->with([ 'fail' => 'Password update failed!']);
        }
    }

    //get user info
    private function getUserInfo($request)
    {
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'phone' => $request->adminPhone,
            'address' => $request->adminAddress,
            'gender' => $request->adminGender,
            'updated_at' => Carbon::now()
        ];
    }

    //validation
    private function userValidationCheck($request)
    {
        return Validator::make($request->all(), [
            'adminName' => 'required',
            'adminEmail' => 'required',
        ],[
            'adminName.required' => 'Name is required',
            'adminEmail.required' => 'Email is required'
        ]);

    }

    //password change validation
    private function changePasswordValidationCheck($request)
    {
        return Validator::make($request->all(),[
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|max:30',
            'confirmPassword' => 'required|same:newPassword'
        ],[
            'confirmPassword.same' => 'New Password & Confirm Password must be same!'
        ]);
    }
}

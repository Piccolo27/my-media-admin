<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //direct admin list page
    public function index(){
        $userData = User::select('id', 'name', 'email', 'phone', 'address', 'gender')->get();
        return view('admin.list.index', compact('userData'));
    }

    //delete admin account
    public function deleteAccount($id)
    {
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'User Account Deleted!']);
    }

    //admin list search
    public function adminListSearch (Request $request)
    {
        $userData = User::orWhere('name', 'LIKE', '%'.$request->adminSearchKey.'%')
                        ->orWhere('email', 'LIKE', '%'.$request->adminSearchKey.'%')
                        ->orWhere('phone', 'LIKE', '%'.$request->adminSearchKey.'%')
                        ->orWhere('address', 'LIKE', '%'.$request->adminSearchKey.'%')
                        ->orWhere('gender', $request->adminSearchKey)
                        ->get();
        return view('admin.list.index', compact('userData'));
    }
}

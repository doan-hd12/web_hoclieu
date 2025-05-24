<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    function accountpanel()
    
{

$user = DB::table("users")->whereRaw("id=?",[Auth::user()->id])->first();
return view("profile.account",compact("user"));
}

//



    function saveaccountinfo(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'full_name' => ['nullable', 'string', 'max:255'],
        'photo' => ['nullable','image'],
        'phone' => ['nullable','string'],
    ]);

    $id = $request->input('id');

    $data["name"] = $request->input("name");
    $data["phone"] = $request->input("phone");
    $data["email"] = $request->input("email");
    $data["full_name"] = $request->input("full_name");

    if($request->hasFile("photo"))
    {
        $fileName = $id . '.' . $request->file('photo')->extension();        
        $request->file('photo')->storeAs('public/profile', $fileName);
        $data['photo'] = $fileName;
    }

    DB::table("users")->where("id",$id)->update($data);

    return redirect()->route('account')->with('status', 'Cập nhật thành công');


}


    public function showChangePasswordForm()
    {
        return view('profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'], // 'confirmed' nghĩa là phải có field new_password_confirmation
        ]);

        $user = Auth::user();

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }


}

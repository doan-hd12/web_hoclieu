<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\User;
use App\Models\Major;




class AdminController extends Controller
{
    //
    public function index(){
            return view('admin.index');


    }

    function thong_tin()
    
    {
    $user = DB::table("users")->whereRaw("id = ?", [Auth::user()->id])->first();
    return view('admin.thong_tin', compact('user'));
    }

//



    function luu_thong_tin(Request $request)
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

    return redirect()->route('admin.profile')->with('status', 'Cập nhật thành công');


}


    public function show_reset_password()
    {
        return view('admin.doi_mat_khau');
    }

    public function reset_password(Request $request)
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


    // quản trịị user

   
 public function admin_user()
{
    $users = User::where('role', 'user')
                ->orderBy('updated_at', 'desc')
                ->paginate(10); // hoạt động gần đây
    return view('admin.users.index', compact('users'));
}


public function toggleBlock($id)
{
    $user = User::findOrFail($id);
    $user->is_blocked = !$user->is_blocked;
    $user->save();

    return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
}

// quản lý tài liệu


public function admin_document(Request $request)
{
    $majorId = $request->query('major_id');
    $majors = Major::all();

    // Lấy danh sách tài liệu cùng thông tin người dùng, chuyên ngành và đếm lượt tải
    $documents = Document::with(['user', 'major'])
        ->withCount('downloads') // Laravel sẽ tự đếm và thêm cột 'downloads_count'
        ->when($majorId, function ($query) use ($majorId) {
            return $query->where('major_id', $majorId);
        })
        ->latest()
        ->paginate(10);

    return view('admin.documents.index', compact('documents', 'majors', 'majorId'));
}

public function destroy($id)
{
    $doc = Document::findOrFail($id);

    // Xoá file thật nếu cần
    Storage::delete($doc->file_path);

    $doc->delete();
    return back()->with('success', 'Xóa tài liệu thành công!');
}




}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Major;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Comment;
use App\Models\Download;
use App\Models\Rating;



class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   // tìm kiếm
public function index(Request $request)
{
    $search = $request->input('search');

    $documents = Document::with(['major', 'user'])
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhereHas('major', function ($q2) use ($search) {
                      $q2->where('name', 'like', '%' . $search . '%');
                  });
            });
        })
        ->orderByDesc('created_at')
        ->get();

    return view('documents.index', [
        'documents' => $documents,
        'title' => $search, // truyền từ khóa tìm kiếm để hiển thị
    ]);
}




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $subjects = Subject::all();
        $majors = Major::all(); 

        return view('documents.create', compact('subjects','majors'));    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'major_id' => 'required|exists:majors,id',
            'subject_id' => 'nullable|exists:subjects,id',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,txt,xlsx,jpg,png|max:10240' // tối đa 10MB
        ]);
    
        // Lưu file
        $filePath = $request->file('file')->store('documents', 'public');
    
        // Tạo bản ghi
        Document::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'user_id' => Auth::id(),

            'subject_id' => $request->subject_id,
            'major_id' => $request->major_id,

            
        ]);
    
        return redirect()->route('documents.create')->with('success', 'Tải lên thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // return view('documents.show', compact('document'));
        $major = Major::findOrFail($id);

    $documents = $major->documents()->latest()->get();

    return view('documents.show', compact('major', 'documents'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view('documents.edit', compact('document'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $document->update([
            'title' => $request->title,
        ]);

        return redirect()->route('documents.index')->with('success', 'Cập nhật thành công.');
    

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'Đã xóa tài liệu.');
    
    }
    //
    public function detail($id)
    {
        $document = Document::with('user', 'comments.user')->findOrFail($id);
    
        return view('documents.detail', compact('document'));
    }
    //
    public function preview($id)
    {
        $document = Document::findOrFail($id);
        $file = Storage::disk('public')->path($document->file_path);
    
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    
        switch ($extension) {
            case 'pdf':
                return response()->file($file, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="preview.pdf"',
                ]);
    
            case 'txt':
                return response()->file($file, [
                    'Content-Type' => 'text/plain',
                    'Content-Disposition' => 'inline; filename="preview.txt"',
                ]);
            case 'jpg':
            case 'jpeg':
                return response()->file($file, [
                    'Content-Type' => 'image/jpeg', 
                    'Content-Disposition' => 'inline; filename="preview.jpg"',
                ]);

            case 'png':
                return response()->file($file, [
                    'Content-Type' => 'image/png',
                    'Content-Disposition' => 'inline; filename="preview.png"',
                ]);

       
            case 'doc':
            case 'docx':
            case 'ppt':
            case 'pptx':
            case 'xls':
            case 'xlsx':
                // Chuyển hướng đến Google Docs Viewer (chỉ hoạt động với file public)
                $publicUrl = asset('storage/' . $document->file_path);
                return redirect("https://docs.google.com/gview?url=$publicUrl&embedded=true");
    
            default:
                abort(404, 'Không hỗ trợ xem trước định dạng này.');
        }
    }

   

public function download($id)
{
    $document = Document::findOrFail($id);
    $filePath = storage_path('app/public/' . $document->file_path);

    if (file_exists($filePath)) {
        // Ghi nhận lượt tải vào bảng downloads
        Download::create([
            'user_id' => auth()->id(),
            'document_id' => $document->id,
        ]);

        // Đồng thời tăng bộ đếm tổng
        // $document->increment('downloads_count');

        return response()->download($filePath, $document->title . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }

    abort(404, 'Tài liệu không tồn tại.');
}





public function addComment(Request $request, $id)
{
    $request->validate([
        'content' => 'required|string|max:1000',
        'rating' => 'nullable|integer|min:1|max:5'
    ]);

    // Tạo bình luận mới
    Comment::create([
        'user_id' => auth()->id(),
        'document_id' => $id,
        'content' => $request->content,
    ]);

    // Cập nhật hoặc tạo mới đánh giá
    Rating::updateOrCreate(
        [
            'user_id' => auth()->id(),      // Người dùng hiện tại
            'document_id' => $id,           // Tài liệu cần đánh giá
        ],
        [
            'rating' => $request->rating,   // Đánh giá từ 1 đến 5
        ]
    );

    return back()->with('success', 'Bình luận đã được gửi.');
}

public function reply(Request $request, Document $document, Comment $comment)
{
    $request->validate([
        'reply_content' => 'required|string|max:1000',
    ]);

    $reply = new Comment();
    $reply->content = $request->reply_content;
    $reply->user_id = auth()->id();
    $reply->document_id = $document->id;
    $reply->parent_id = $comment->id; // Quan trọng để biết đây là phản hồi
    $reply->save();

    return back()->with('success', 'Phản hồi đã được gửi!');
}



    
}

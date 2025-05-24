<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Download;
use App\Models\Major;



class HomeController extends Controller
{
    public function home()
    {
    
    $majorsWithStats = Major::select('majors.*')
    ->withCount(['documents as document_count'])
    ->with([
        'documents' => function ($q) {
            $q->select('id', 'major_id');
        }
    ])
    ->get()
    ->map(function ($major) {
        $totalDownloads = DB::table('downloads')
            ->join('documents', 'downloads.document_id', '=', 'documents.id')
            ->where('documents.major_id', $major->id)
            ->count();

        $major->total_downloads = $totalDownloads;
        return $major;
    })
    ->sortByDesc('total_downloads')
    ->values();

$latestDocuments = Document::with(['user'])
    ->withCount('downloads')
    ->orderByDesc('created_at')
    ->take(8)
    ->get();
    return view('home', compact('majorsWithStats', 'latestDocuments'));

    }

 
}


@extends('layouts.admin')

@section('title', 'Quản lý tài liệu')

@section('content')
    <div class="p-4">
        <h1 class="text-2xl font-bold mb-4">Quản lý tài liệu</h1>

        {{-- Lọc theo bộ sưu tập --}}
        <form method="GET" class="mb-4">
            <label for="major_id" class="mr-2 font-semibold">Lọc theo chuyên ngành:</label>
            <select name="major_id" id="major_id" onchange="this.form.submit()" class="border p-1 rounded">
                <option value="">Tất cả</option>
                @foreach($majors as $major)
                    <option value="{{ $major->id }}" {{ $majorId == $major->id ? 'selected' : '' }}>
                        {{ $major->name }}
                    </option>
                @endforeach
            </select>
        </form>

        <table class="table table-bordered">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Tên tài liệu</th>
                    <th class="p-2 border">Mô tả tài liệu</th>
                    <th class="p-2 border">Người đăng tải</th>
                    <th class="p-2 border">Lĩnh vực</th>
                    <th class="p-2 border">Thời gian</th>
                    <th class="p-2 border">Lượt tải</th>
                    <th class="p-2 border">Tệp</th>
                    <th class="p-2 border">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($documents as $doc)
                <tr>
                    <td class="p-2 border font-semibold">{{ $doc->title }}</td>
                    <td class="p-2 border">{{ \Illuminate\Support\Str::limit($doc->description, 50) }}</td>
                    <td class="p-2 border">{{ $doc->user->name??'ẩn danh' }}</td>
                    <td class="p-2 border">{{ $doc->major->name ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $doc->created_at->format('d/m/Y H:i') }}</td>
                    <td class="p-2 border text-center">{{ $doc->downloads_count }}</td>
                    <td class="p-2 border text-blue-600">
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="underline">Xem</a>
                    </td>
                    <td class="p-2 border text-center">
                        <form action="{{ route('admin.documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-red px-2 py-1 rounded text-xs hover:bg-red-600">Xóa</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center p-4 text-gray-500">Không có tài liệu nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    
        <div class="mt-4">
            {{ $documents->withQueryString()->links() }}
            <br>
        </div>
    </div>
@endsection

<x-layouts.app :title="'Tìm kiếm: ' . $title">
@php
    $count = count($documents);
    $columnsPerRow = 4;
    $emptySlots = $columnsPerRow - ($count % $columnsPerRow);
@endphp

<br>
<h4 class="text-2xl font-bold mb-4">🏷️ Kết quả tìm kiếm cho: <span class="text-blue-600">"{{ $title }}"</span></h4>
<p class="mb-4 text-gray-600">Tìm thấy <strong>{{ $count }}</strong> tài liệu</p>

<div class="row row-cols-1 row-cols-md-4 g-4">
    @foreach ($documents as $doc)
        <div class="col">
            <a href="{{ route('documents.detail', $doc->id) }}" style="text-decoration: none;">
                <div class="card document-card h-100">
                    <img src="{{ asset('images/logo.jpg') }}" alt="{{ $doc->title }}" class="document-thumbnail">

                    <div class="card-body">
                        <h6 class="document-title text-center">{{ $doc->title }}</h6>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="document-meta text-left text-truncate">
                                👤 {{ $doc->user->name ?? 'Ẩn danh' }}<br>
                                🕒 {{ $doc->created_at->diffForHumans() }}<br>
                                ⬇️ <span class="text-success fw-bold">{{ $doc->downloads_count }}</span> lượt tải
                            </div>

                            <a href="{{ route('documents.detail', $doc->id) }}" class="btn btn-sm btn-detail" style="text-decoration: none;">Chi tiết</a>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach

    {{-- Thêm cột trống nếu không đủ hàng --}}
    @if ($count % $columnsPerRow !== 0)
        @for ($i = 0; $i < $emptySlots; $i++)
            <div class="col d-none d-md-block"></div>
        @endfor
    @endif
</div>

<style>
.row {
    gap: 20px 0px;
}

.document-card {
    border: 1px solid #e5e7eb;
    border-radius: 7px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    overflow: hidden;
}

.document-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
}

.document-thumbnail {
    width: 100%;
    height: 210px;
    object-fit: cover;
    border-bottom: 0px solid #eee;
}

.document-title {
    font-size: 1.1rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 0px;
}

.document-meta {
    font-size: 0.8rem;
    color: #666;
    line-height: 1.4;
    margin-bottom: 0px;
}

.card-body a.btn {
    white-space: nowrap;
    margin-left: 0px;
}

.btn-detail {
    background-color: #3b82f6;
    color: white;
    font-weight: bold;
    padding: 6px 14px;
    border-radius: 6px;
    text-decoration: none;
    border: none;
    transition: background-color 0.2s ease;
    white-space: nowrap;
}

.btn-detail:hover {
    background-color: #2563eb;
}
</style>
</x-layouts.app>

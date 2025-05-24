<x-layouts.app :title="'Tài liệu: ' . $document->title">
    <div class="document-container">
        <h4 class="document-title">Tiêu đề: {{ $document->title }}</h4>

        <div class="document-meta mb-4 space-y-1">
            <p><span class="font-semibold">Mô tả:</span> {{ $document->description }}</p>
            <p><span class="font-semibold">Người đăng:</span> {{ $document->user->name ?? 'Không xác định' }}</p>
            <p><span class="font-semibold">Thời gian đăng:</span> {{ $document->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="text-right">
            <a href="{{ route('documents.download', $document->id) }}" class="download-link">⬇️ Tải xuống</a>
        </div>

        <div class="preview-section mt-6">
            <h5>📄 Xem trước tài liệu:</h5>
            <iframe src="{{ route('documents.preview', $document->id) }}" width="100%" height="600px" class="border"></iframe>
        </div>
    </div>

    {{-- Bình luận --}}
    {{-- <x-comment :document="$document" /> --}}
    {{-- @include('documents.comment', ['document' => $document]) --}}

   @php
    $comments = $document->comments->sortByDesc('created_at');
@endphp

<div class="max-w-4xl mx-auto mt-12 comment-box">
    {{-- Nội dung bình luận giữ nguyên ở đây --}}
    
    <div class="px-4 py-6 bg-white rounded-lg shadow-md">
        <h4 class="text-2xl font-bold text-gray-800 mb-6">💬 Bình luận & Đánh giá</h4>

        @auth
            <form method="POST" action="{{ route('documents.comment', $document->id) }}" class="space-y-5 mb-8">
                @csrf
                <div>
                    <label for="content">Bình luận📄</label>
                    <textarea name="content" id="content" rows="2" required></textarea>
                </div>
                <div>
                    <label for="rating">Đánh giá ⭐</label>
                    <select name="rating" id="rating">
                        <option value="">none</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} ⭐</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" style= "background-color:rgb(7, 147, 207);">Đăng</button>
            </form>
        @else
            <p class="text-gray-600">🔒 <a href="{{ route('login') }}" class="text-blue-600 underline">Đăng nhập</a> để bình luận.</p>
        @endauth

        <br><h5 class="text-lg font-semibold mb-4">Đánh giá gần đây 💬</h5>

        <div x-data="{ expanded: false }" class="space-y-5">
            @foreach ($comments->take(4) as $comment)
            <div class="comment-item">
                    <div class="flex justify-between mb-1">
                        <span class="comment-user">👤 {{ Str::limit($comment->user->name, 20, '...') }}</span>
                        <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    @if ($comment->rating)
                        <div class="text-yellow-500 mb-1">
                            @for ($i = 0; $i < $comment->rating; $i++) ⭐ @endfor
                        </div>
                    @endif
                    <p class="comment-content">{{ $comment->content }}</p>
@auth
    <div x-data="{ replyOpen: false }" class="mt-2">
        <button @click="replyOpen = !replyOpen" class="text-sm text-blue-500 hover:underline">Trả lời</button>

        <div x-show="replyOpen" class="mt-2">
            <form method="POST" action="{{ route('documents.comment.reply', ['document' => $document->id, 'comment' => $comment->id]) }}">
                @csrf
                <textarea name="reply_content" rows="2" class="w-full border p-2 rounded mb-2" required></textarea>
                <button type="submit" class="text-sm bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Gửi phản hồi</button>
            </form>
        </div>
    </div>
@else
    <p class="text-sm text-gray-600 mt-2">🔒 <a href="{{ route('login') }}" class="text-blue-600 underline">Đăng nhập</a> để trả lời.</p>
@endauth
                </div>
            @endforeach

            <template x-if="expanded">
                <div class="space-y-5 mt-4">
                    @foreach ($comments->skip(4) as $comment)
                    <div class="comment-item">
                            <div class="flex justify-between mb-1">
                                <span class="comment-user">{{ Str::limit($comment->user->name, 20, '...') }}</span>
                                <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            @if ($comment->rating)
                                <div class="text-yellow-500 mb-1">
                                    @for ($i = 0; $i < $comment->rating; $i++) ⭐ @endfor
                                </div>
                            @endif
                            <p class="comment-content">{{ $comment->content }}</p>
                            @if ($comment->replies->count())
    <div class="mt-3 ml-4 border-l-2 pl-4 space-y-2">
        @foreach ($comment->replies as $reply)
            <div class="text-sm bg-gray-100 p-2 rounded">
                <div class="flex justify-between">
                    <span class="font-semibold">👤 {{ $reply->user->name }}</span>
                    <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                </div>
                <p class="mt-1">{{ $reply->content }}</p>
            </div>
        @endforeach
    </div>
@endif

                            <button class="text-sm text-blue-600 mt-2 hover:underline">Trả lời</button>
                        </div>
                    @endforeach
                </div>
            </template>

            @if ($comments->count() > 4)
                <div class="text-center mt-4">
                    <button x-show="!expanded" @click="expanded = true" class="text-blue-600 font-medium hover:underline">Xem thêm</button>
                    <button x-show="expanded" @click="expanded = false" class="text-blue-600 font-medium hover:underline">Thu gọn</button>
                </div>
            @endif
        </div>
    </div>
</div>





    <style>
        /* resources/css/document.css */
.document-container {
    max-width: 64rem; /* 4xl */
    margin: 1.5rem auto 0;
    padding: 1.5rem;
    background-color: #fff;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.document-title {
    font-size: 1.875rem;
    font-weight: bold;
    color: #1f2937;
    margin-bottom: 1rem;
}

.document-meta {
    font-size: 0.875rem;
    color: #4b5563;
}

.document-meta p {
    margin: 0.25rem 0;
}

.download-link {
    font-size: 1.5em;
    color: #2563eb;
    text-decoration: none;
}

.preview-section h5 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
}

.comment-box {
        max-width: 64rem; /* 4xl */
    margin-top: 20px;
    padding: 20px;
    background-color: white;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.comment-item {
    margin-top:10px;
    border: 1px solid #e5e7eb;
    background-color: #f9fafb;
    padding: 12px;
    border-radius: 0.5rem;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    max-height:̀50px;
}

.comment-user {
        font-size: 1.2rem;
    font-weight: 600;
    color: #1f2937;
}

.comment-time {
    font-size: 0.8rem;
    color: #6b7280;
}

.comment-content {
    color: #374151;
    line-height: 1.4;
}

    </style>

        <script src="//unpkg.com/alpinejs" defer></script>

</x-layouts.app>

<x-layouts.app :title="'Web học liệu: Trang chủ'">

    <br><h4 class="text-2xl font-bold mb-6">Chào mừng đến với Website Chia Sẻ Học Liệu</h4>

    <p class="text-gray-700">Đây là nơi bạn có thể tải lên, tìm kiếm và chia sẻ tài liệu học tập miễn phí.</p>

    

        <div class="container mt-4">
            {{-- Tài liệu nổi bật --}}
            <h4 class="mt-5 mb-3">🌟 Bộ sưu tập nổi bật</h4>
            <div class="slider-container position-relative">
                <button class="slider-btn left">&lt;</button>
                <div class="slider-wrapper">
                    @foreach ($majorsWithStats as $major)
                        <div class="slider-item">
                            <a href="{{ route('documents.show', $major->id) }}"style="text-decoration: none;">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('images/' . $major->file_anh) }}" class="card-img-top" alt="{{ $major->name }}">
                                <h5 class="card-title text-center">{{ $major->name }}</h5>

                                <div class="card-body">
                                    <p class="card-text text-left">📄 {{ $major->document_count }} tài liệu</p>
                                    <p class="card-text text-left">⬇️ {{ $major->total_downloads }} lượt tải</p>

                                </div>
                            </div>
                        </a>
                        </div>
                    @endforeach
                </div>
                <button class="slider-btn right">&gt;</button>
            </div>
            
    
            {{-- Tài liệu mới --}}
            <h4 class="mt-5 mb-3">📄 Tài liệu mới tải lên</h4>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach ($latestDocuments as $doc)
                    <div class="col">
                        <a href="{{ route('documents.detail', $doc->id) }}"style="text-decoration: none;">
                        <div class="card document-card h-100">
                            <img src="{{ asset('images/logo.jpg') }}" alt="{{ $doc->title }}" class="document-thumbnail">
                            <div class="card-body">
                                <h6 class="document-title text-center text-truncate">{{ $doc->title }}</h6>
                            
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div class="document-meta text-left text-truncate flex-grow-1 ">
                                        👤 {{ $doc->user->name ?? 'Ẩn danh' }}<br>
                                        🕒 {{ $doc->created_at->diffForHumans() }}<br>
                                        ⬇️ <span class="text-success fw-bold">{{ $doc->downloads_count }}</span> lượt tải
                                    </div>
                                    <div class="flex-shrink: 0;">
                                    <a href="{{ route('documents.detail', $doc->id) }}" class="btn btn-sm btn-detail">Chi tiết</a>

                                    </div>
                            
                                </div>
                            </div>
                            
                            <a>
                        </div>
                    </div>
                @endforeach

               
            </div>
            
            
        </div>
    
    
<style>
    
        .slider-container {
            position: relative;
            overflow: hidden;
            width: 100%;
            margin-bottom: 40px;
        }
        
        .slider-container:hover .slider-btn {
            opacity: 1;
            visibility: visible;
        }
        
        .slider-wrapper {
            display: flex;
            transition: transform 0.2s ease-in-out; /* mượt hơn */
            gap: 25px;
        }
        
        .slider-item {
            min-width: 25%; /* 100% / 4 items */
            flex: 0 0 25%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 7px;
            overflow: hidden;
            background-color: #fff;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        
        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            border: none;
            font-size: 24px;
            padding: 8px 12px;
            z-index: 10;
            cursor: pointer;
            border-radius: 4px;
        
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease;
        }
        
        .slider-btn.left {
            left: 10px;
        }
        
        .slider-btn.right {
            right: 10px;
        }


.slider-item:hover {
    transform: translateY(-5px);
}

.slider-item img {
    width: 100%;
    height: 185px;
    object-fit: cover;
}

.slider-item .card-body {
    padding: 10px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.slider-item h5 {
    background:#767779;
    padding:0px;
    font-size: 1.35rem;
    font-weight: bold;
    margin-bottom: 0px;
    text-align: center;
    color: #2c3e50;
}

.slider-item p {
    font-size: 0.8rem;
    text-align: center;
    margin: 0px 0;
    color: #555;
}
/* tài liệu mới */
.row {
  gap: 20px 0px; 
}
 /* .container {
  max-width: 1100px;
  margin: auto;
} */



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
    font-size: 0.75rem;
    color: #666;
    line-height: 1.3;
    margin-bottom: 0px;
}


.card-body a.btn {
    white-space: nowrap;
    margin-left: 0px;
}
/* chi tiết */
.btn-detail {
    background-color: #3b82f6; /* blue-500 */
    color: white;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 6px;
    text-decoration: none;
    border: none;
    transition: background-color 0.2s ease;
    white-space: nowrap;
}

.btn-detail:hover {
    background-color: #2563eb; /* blue-600 */
}





</style>        
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.querySelector('.slider-wrapper');
        const items = document.querySelectorAll('.slider-item');
        const btnLeft = document.querySelector('.slider-btn.left');
        const btnRight = document.querySelector('.slider-btn.right');
        let position = 0;
        const visibleItems = 4;

        btnLeft.addEventListener('click', () => {
            if (position > 0) {
                position--;
                wrapper.style.transform = `translateX(-${position * 25}%)`;
            }
        });

        btnRight.addEventListener('click', () => {
            if (position < items.length - visibleItems) {
                position++;
                wrapper.style.transform = `translateX(-${position * 25}%)`;
            }
        });
    });
</script>



</x-layouts.app>

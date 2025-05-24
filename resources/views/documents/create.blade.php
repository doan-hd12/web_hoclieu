<x-layouts.app title="Tải lên tài liệu mới">
    <div class="form-container">
        <h2 class="form-title">📤 Tải lên tài liệu</h2>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="error-item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="upload-form">
            @csrf

            <div class="form-group">
                <label class="form-label">📚 Tiêu đề</label>
                <input type="text" name="title" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">📝 Mô tả</label>
                <textarea name="description" rows="4" class="form-input"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">📖 Lĩnh vực <span style="color: red">*</span></label>
                <select name="major_id" class="form-input" required>
                    <option value="">-- chọn lĩnh vực --</option>
                    @foreach ($majors as $major)
                        <option value="{{ $major->id }}">{{ $major->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">📚 Chuyên ngành, môn học</label>
                <select name="subject_id" class="form-input">
                    <option value="">-- Khác --</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label class="form-label">📎 Tệp tài liệu</label>
                <input type="file" name="file" class="form-input" required>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-submit">Tải lên</button>
            </div>
        </form>
    </div>

    <style>
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 32px;
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }
    
        .form-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 24px;
            color: #2d3748;
        }
    
        .form-group {
            margin-bottom: 20px;
        }
    
        .form-label {
            display: block;
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 6px;
        }
    
        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #cbd5e0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
    
        .form-input:focus {
            outline: none;
            border-color: #3182ce;
            box-shadow: 0 0 0 2px rgba(66, 153, 225, 0.3);
        }
    
        .btn-submit {
            display: inline-block;
            background-color: #3182ce;
            color: white;
            padding: 10px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
    
        .btn-submit:hover {
            background-color: #2b6cb0;
        }
    
        .form-footer {
            text-align: center;
            margin-top: 20px;
        }
    
        .alert-success {
            background-color: #e6fffa;
            color: #2c7a7b;
            padding: 12px;
            border-radius: 6px;
            text-align: center;
            margin-bottom: 20px;
        }
    
        .alert-error {
            background-color: #fed7d7;
            color: #c53030;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
    
        .alert-error ul {
            margin: 0;
            padding-left: 20px;
        }
    
        .error-item {
            font-size: 14px;
        }
    </style>
    
</x-layouts.app>

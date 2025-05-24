@extends('layouts.admin')

@section('title', 'Quản lý người dùng')

@section('content')
<h2>Người dùng hoạt động gần đây</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tên</th>
            <th>Email</th>
            <th>Hoạt động cuối</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->updated_at->diffForHumans() }}</td>
            <td>{{ $user->is_blocked ? 'Bị khóa' : 'Hoạt động' }}</td>
            <td>
                <form action="{{ route('admin.users.block', $user->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-sm {{ $user->is_blocked ? 'btn-success' : 'btn-danger' }}">
                        {{ $user->is_blocked ? 'Mở khóa' : 'Khóa' }}
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links() }}
@endsection

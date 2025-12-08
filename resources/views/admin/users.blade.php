@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Users Management</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
            <tr>
                <td>{{ $u->user_id }}</td>
                <td>{{ $u->username }}</td>
                <td>{{ $u->password }}</td>
                <td>{{ $u->role }}</td>
                <td>
                    <form action="{{ route('admin.users.toggleRole', $u->user_id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-warning">
                            {{ $u->role === 'admin' ? 'Make User' : 'Make Admin' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.users.delete', $u->user_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xoá user này?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

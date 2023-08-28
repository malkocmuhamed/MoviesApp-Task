@extends('layouts.app')

@section('content')
    <div class="p-5">
        <h2>Manage Users</h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary" style="float:right">Create User</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role === 1 ? 'Admin' : 'User' }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-2 mb-1" style="display:flex; justify-content:center;">
        {{ $users->links() }}
        </div>
    </div>
    @if(session('success'))
    <div id="flash-message" class="alert alert-success" data-auto-dismiss="5000"
        style="width:50%; margin:auto">
        {{ session('success') }}
    </div>
    @endif
@endsection

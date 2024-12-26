@extends('layout')
@section('main')
<div class="container">
    <h1>Places</h1>
    <a href="{{ route('admin.places.create') }}" class="btn btn-primary mb-3">Create Place</a>

    @if (Session::has('success'))
    <div class="alert alert-success" style="background:#28272f; color: white;">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <table class="table table-boarded">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Rating</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($places as $place)
                <tr>
                    <td>{{ $place->id }}</td>
                    <td>{{ $place->name }}</td>
                    <td>{{ $place->rating }}</td>
                    <td>{{ $place->category->name }}</td>
                    <td>
                        <a href="{{ route('admin.places.show', $place->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.places.edit', $place->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.places.destroy', $place->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

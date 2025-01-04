@extends('layout')
@section('main')
<div class="container">
    <h1>Reviews</h1>
       <!-- Search Form -->
       <form action="{{ route('admin.reviews.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by user name or place name" value="{{ request('search') }}">
                <div class="input-group-append" style="margin-left: 10px;">
                    <button class="btn btn-primary btn-rounded" type="submit">
                        <i class="fas fa-search"></i> Search
                    </button>
            </div>
        </div>
    </form>
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
                <th>User Name</th>
                <th>Place</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->user->name }}</td>
                    <td>{{ $review->place->name }}</td>
                    <td>{{ $review->place->category->name }}</td>
                    <td>
                        <a href="{{ route('admin.reviews.show', $review->id) }}" class="btn btn-info btn-rounded btn-sm">
                            <i class="fa fa-eye"></i>

                        </a>
                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-rounded btn-sm" onclick="return confirm('Are You sure?')">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
        <!-- Pagination Buttons -->
        <div class="d-flex justify-content-between mt-4">
            <!-- Previous Page Button -->
            @if($reviews->onFirstPage())
            <span class="btn btn-secondary btn-rounded disabled">Previous</span>
            @else
            <a href="{{ $reviews->previousPageUrl() }}" class="btn btn-primary btn-rounded">Previous</a>
            @endif

            <!-- Next Page Button -->
            @if($reviews->hasMorePages())
            <a href="{{ $reviews->nextPageUrl() }}" class="btn btn-primary btn-rounded">Next</a>
            @else
            <span class="btn btn-secondary btn-rounded disabled">Next</span>
            @endif
        </div>
</div>
@endsection

@extends('layout')
@section('main')



<div class="container">
    <h2>All Categories</h2>

    <!-- Success Message -->
    @if (Session::has('success'))
        <div class="alert alert-success" style="background:#28272f; color: white;">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

    <!-- Add Category Button -->
    <button class="btn btn-primary btn-rounded btn-fw" data-bs-toggle="modal" data-bs-target="#createCategoryModal" style="margin: 10px">
       Create Category
    </button>

    <!-- Category Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>
                    {{ $category->name }}
                    @if ($category->children->isNotEmpty())
                        <ul>
                            @foreach ($category->children as $child)
                                <li>{{ $child->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>
                <td>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No categories available.</td>
            </tr>
        @endforelse
        
        </tbody>
    </table>
</div>

<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Category Name -->
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" id="categoryName" required>
                    </div>
                    <!-- Parent Category -->
                    <div class="mb-3">
                        <label for="parentCategory" class="form-label">Parent Category (Optional)</label>
                        <select name="parent_id" class="form-select" id="parentCategory">
                            <option value="" selected>No Parent</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Font Awesome for Icons -->

<script>
    function toggleSubcategories(categoryId) {
        const subcategories = document.getElementById(`subcategories${categoryId}`);
        const icon = document.getElementById(`toggleIcon${categoryId}`);
        
        if (subcategories.classList.contains('d-none')) {
            subcategories.classList.remove('d-none');
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            subcategories.classList.add('d-none');
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    }
</script>

@endsection

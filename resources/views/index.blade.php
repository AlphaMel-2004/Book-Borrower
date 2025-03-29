@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">📚 Books List</h1>

    <!-- Search Form -->
    <form action="{{ route('books.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by Title, Author, or ISBN..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">🔍 Search</button>
        </div>
    </form>

    <a href="{{ route('books.create') }}" class="btn btn-success mb-3">➕ Add New Book</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Copies</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->copies_available }}</td>
                    <td>
                        <a href="{{ route('books.show', $book) }}" class="btn btn-info btn-sm">👁 View</a>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">✏ Edit</a>

                        <!-- Delete Button (Triggers Modal) -->
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $book->id }}">
                            🗑 Delete
                        </button>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal{{ $book->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $book->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete **{{ $book->title }}**? This action cannot be undone.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('books.destroy', $book) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $books->links() }} <!-- Pagination -->
</div>
@endsection

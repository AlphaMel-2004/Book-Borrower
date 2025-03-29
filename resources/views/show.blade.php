@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card shadow-lg p-4 w-75">
            <div class="card-body text-center">
                <h2 class="mb-4 text-info fw-bold">📖 Book Details</h2>

                <div class="mb-3">
                    <h3 class="text-primary">{{ $book->title }}</h3>
                    <p class="fs-5"><strong>Author:</strong> {{ $book->author }}</p>
                    <p class="fs-5"><strong>ISBN:</strong> {{ $book->isbn }}</p>
                    <p class="fs-5"><strong>Copies Available:</strong> {{ $book->copies_available }}</p>
                </div>

                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary px-4">⬅️ Back</a>
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-warning px-4">✏️ Edit</a>

                    <!-- Delete Button with Confirmation Modal -->
                    <button class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        🗑️ Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="deleteModalLabel">⚠️ Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong>{{ $book->title }}</strong>? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">❌ Cancel</button>
                <form action="{{ route('books.destroy', $book) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">🗑️ Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-center text-warning">✏️ Edit Book</h2>

        <form action="{{ route('books.update', $book) }}" method="POST" class="p-4 shadow rounded bg-light">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title:</label>
                <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Author:</label>
                <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">ISBN:</label>
                <input type="text" name="isbn" class="form-control" value="{{ $book->isbn }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Copies Available:</label>
                <input type="number" name="copies_available" class="form-control" min="1" value="{{ $book->copies_available }}" required>
            </div>

            <button type="submit" class="btn btn-warning w-100">💾 Update Book</button>
        </form>
    </div>
@endsection

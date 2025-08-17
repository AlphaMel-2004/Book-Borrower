@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4 text-center text-primary">➕ Add New Book</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-lg p-4 bg-light mx-auto" style="max-width: 600px;">
        <form action="{{ route('books.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label fw-bold">📖 Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label fw-bold">✍️ Author</label>
                <input type="text" name="author" id="author" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="isbn" class="form-label fw-bold">🔢 ISBN <span id="isbn-count">(0/13)</span></label>
                <input type="text" name="isbn" id="isbn" class="form-control" required maxlength="13">
            </div>

            <div class="mb-3">
                <label for="copies_available" class="form-label fw-bold">📦 Available Copies</label>
                <input type="number" name="copies_available" id="copies_available" class="form-control" required min="1">
            </div>

            <div class="d-flex gap-2 justify-content-center">
                <button type="submit" class="btn btn-success">✅ Add Book</button>
                <a href="{{ route('books.index') }}" class="btn btn-danger">❌ Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    // Live character counter for ISBN field
    document.getElementById('isbn').addEventListener('input', function () {
        document.getElementById('isbn-count').textContent = `(${this.value.length}/13)`;
    });
</script>

@endsection

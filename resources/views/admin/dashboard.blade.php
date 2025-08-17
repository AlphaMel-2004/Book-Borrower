@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-xl font-semibold mb-2">Total Books</div>
                <div class="text-3xl font-bold text-green-600">{{ $totalBooks }}</div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-xl font-semibold mb-2">Currently Borrowed</div>
                <div class="text-3xl font-bold text-blue-600">{{ $borrowedBooks->count() }}</div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-xl font-semibold mb-2">Users with Fines</div>
                <div class="text-3xl font-bold text-red-600">{{ $usersWithFines->count() }}</div>
            </div>
        </div>

        <!-- Borrowed Books Table -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-4">Currently Borrowed Books</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book Title</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrowed By</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrowed Date</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($borrowedBooks as $borrowing)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $borrowing->book->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $borrowing->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $borrowing->borrowed_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $borrowing->due_at->format('M d, Y') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Users with Fines Table -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-4">Users with Unpaid Fines</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Unpaid Fines</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($usersWithFines as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ₱{{ $user->fines->where('status', 'unpaid')->sum('amount') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="{{ route('admin.fines.index', ['user' => $user->id]) }}" class="text-indigo-600 hover:text-indigo-900">View Details</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

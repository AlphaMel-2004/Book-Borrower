<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-2">Welcome, {{ $user->name }}!</h2>
                    <p class="text-gray-600">Here's an overview of your library activity.</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-xl font-semibold mb-2">Borrowed Books</div>
                    <div class="text-3xl font-bold text-blue-600">{{ $borrowedBooks->count() }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-xl font-semibold mb-2">Unpaid Fines</div>
                    <div class="text-3xl font-bold text-red-600">{{ $unpaidFines->count() }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-xl font-semibold mb-2">Pending Requests</div>
                    <div class="text-3xl font-bold text-yellow-600">{{ $pendingRequests->count() }}</div>
                </div>
            </div>

            <!-- Borrowed Books Section -->
            @if($borrowedBooks->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-4">Currently Borrowed Books</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book Title</th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrowed Date</th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($borrowedBooks as $borrowing)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $borrowing->book->title }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $borrowing->borrowed_at ? $borrowing->borrowed_at->format('M d, Y') : 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $borrowing->due_at ? $borrowing->due_at->format('M d, Y') : 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($borrowing->due_at && $borrowing->due_at->isPast())
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Overdue
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        On Time
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Unpaid Fines Section -->
            @if($unpaidFines->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-4">Unpaid Fines</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($unpaidFines as $fine)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $fine->description }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                ₱{{ number_format($fine->amount, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $fine->created_at->format('M d, Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('user.fines.index') }}" class="text-indigo-600 hover:text-indigo-900">View All Fines →</a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('user.books.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded text-center">
                            Browse Books
                        </a>
                        <a href="{{ route('user.fines.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-4 rounded text-center">
                            View Fines
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

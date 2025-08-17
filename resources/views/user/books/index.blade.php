<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Available Books</h2>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($books->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ISBN</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Available Copies</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($books as $book)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $book->title }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $book->author }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $book->isbn }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $book->getAvailableCopies() > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $book->getAvailableCopies() }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @if(in_array($book->id, $userBorrowings))
                                                    <span class="text-gray-500 italic">Already Borrowed</span>
                                                @elseif(in_array($book->id, $userRequests))
                                                    <span class="text-yellow-600 italic">Request Pending</span>
                                                @else
                                                    @if($book->getAvailableCopies() > 0)
                                                        <form method="POST" action="{{ route('user.books.borrow', $book) }}" class="inline">
                                                            @csrf
                                                            <button type="submit" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                                                Borrow
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form method="POST" action="{{ route('user.books.reserve', $book) }}" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-green-600 hover:text-green-900">
                                                            Reserve
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg">No books available at the moment.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
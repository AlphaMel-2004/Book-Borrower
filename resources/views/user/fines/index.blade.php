<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">My Fines</h2>
                        <a href="{{ route('user.dashboard') }}" class="text-indigo-600 hover:text-indigo-900">
                            ← Back to Dashboard
                        </a>
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

                    @if($fines->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($fines as $fine)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $fine->description }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                ₱{{ number_format($fine->amount, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $fine->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ ucfirst($fine->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $fine->created_at ? $fine->created_at->format('M d, Y') : 'N/A' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Summary Section -->
                        <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-gray-900">{{ $fines->count() }}</div>
                                    <div class="text-sm text-gray-500">Total Fines</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-red-600">₱{{ number_format($fines->where('status', 'unpaid')->sum('amount'), 2) }}</div>
                                    <div class="text-sm text-gray-500">Unpaid Amount</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-green-600">₱{{ number_format($fines->where('status', 'paid')->sum('amount'), 2) }}</div>
                                    <div class="text-sm text-gray-500">Paid Amount</div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-gray-500 text-lg mb-2">No fines found.</div>
                            <p class="text-gray-400">You don't have any fines at the moment.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

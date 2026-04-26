<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 tracking-tight">Category List</h2>
                            <p class="text-sm text-gray-500 mt-1">Manage your category</p>
                        </div>
                        <a href="{{ route('category.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm">
                            + Add Category
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-200 text-green-700 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">Total Product</th>
                                    <th class="px-6 py-3 text-right font-semibold text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($categories as $cat)
                                    <tr>
                                        <td class="px-6 py-4 font-medium">{{ $cat->name }}</td>
                                        <td class="px-6 py-4">{{ $cat->products_count }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <x-action-buttons 
                                                :editUrl="route('category.edit', $cat->id)" 
                                                :deleteUrl="route('category.destroy', $cat->id)" 
                                            />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">No categories found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
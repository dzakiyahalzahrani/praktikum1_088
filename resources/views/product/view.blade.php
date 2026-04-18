<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('product.index') }}" class="p-1.5 rounded-md text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">Product</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Viewing product</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
    <x-action-buttons 
        :editUrl="route('product.edit', $product->id)" 
        :deleteUrl="route('product.delete', $product->id)" 
    />
</div>

    
                    </div>

                    <div class="rounded-lg border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 shrink-0 text-sm text-gray-500 dark:text-gray-400">Product Name</div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $product->name }}</div>
                        </div>
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 shrink-0 text-sm text-gray-500 dark:text-gray-400">Quantity</div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->quantity > 10 ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' }}">
                                {{ $product->quantity > 10 ? 'In Stock' : 'Low Stock' }}
                            </span>
                        </div>
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 shrink-0 text-sm text-gray-500 dark:text-gray-400">Price</div>
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        </div>
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 shrink-0 text-sm text-gray-500 dark:text-gray-400">Owner</div>
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-600 dark:text-indigo-300 text-xs font-bold uppercase">
                                    {{ substr($product->user->name, 0, 2) }}
                                </div>
                                <span class="text-sm text-gray-800 dark:text-gray-100">{{ $product->user->name }}</span>
                            </div>
                        </div>
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 shrink-0 text-sm text-gray-500 dark:text-gray-400">Created At</div>
                            <div class="text-sm text-gray-800 dark:text-gray-300">{{ $product->created_at->format('d M, H:i') }}</div>
                        </div>
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 shrink-0 text-sm text-gray-500 dark:text-gray-400">Updated At</div>
                            <div class="text-sm text-gray-800 dark:text-gray-300">{{ $product->updated_at->format('d M, H:i') }}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
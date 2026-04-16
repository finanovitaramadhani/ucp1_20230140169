<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Header --}}
                    <div class="flex items-center gap-3 mb-6">
                        <a href="{{ route('product.show', $product) }}"
                           class="p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition">
                            ←
                        </a>
                        <div>
                            <h2 class="text-xl font-bold">
                                Edit Product
                            </h2>
                            <p class="text-sm text-gray-500">
                                Update {{ $product->name }}
                            </p>
                        </div>
                    </div>

                    {{-- ERROR DARI isDirty --}}
                    @if (session('error'))
                        <div class="mb-4 px-4 py-2 bg-red-100 text-red-700 rounded-lg text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- ERROR GLOBAL --}}
                    @if ($errors->any())
                        <div class="mb-4 px-4 py-2 bg-red-100 text-red-700 rounded-lg text-sm">
                            Semua field wajib diisi dengan benar!
                        </div>
                    @endif

                    {{-- Delete Form --}}
                    <form id="delete-product-form"
                          action="{{ route('product.delete', $product->id) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                    </form>

                    {{-- Form --}}
                    <form action="{{ route('product.update', $product) }}"
                          method="POST"
                          class="space-y-5">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Product Name *
                            </label>
                            <input type="text"
                                    name="name"
                                    value="{{ old('name', $product->name) }}"
                                    class="w-full px-4 py-2.5 rounded-lg border text-sm
                                    {{ $errors->has('name') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700' }}
                                    text-gray-900 dark:text-gray-100
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Quantity --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Quantity *
                            </label>
                            <input type="number"
                                    name="quantity"
                                    value="{{ old('quantity', $product->quantity) }}"
                                    min="0"
                                    class="w-full px-4 py-2.5 rounded-lg border text-sm
                                    {{ $errors->has('quantity') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700' }}
                                    text-gray-900 dark:text-gray-100
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @error('quantity')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Price --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Price (Rp) *
                            </label>
                            <input type="number"
                                    name="price"
                                    value="{{ old('price', $product->price) }}"
                                    class="w-full px-4 py-2.5 rounded-lg border text-sm
                                    {{ $errors->has('price') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700' }}
                                    text-gray-900 dark:text-gray-100
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @error('price')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Actions --}}
                        <div class="flex justify-between pt-2">

                            {{-- Delete --}}
                            <button type="submit"
                                    form="delete-product-form"
                                    onclick="return confirm('Are you sure?')"
                                    class="text-red-500 text-sm">
                                🗑 Delete
                            </button>

                            <div class="flex gap-3">
                                <a href="{{ route('product.show', $product) }}"
                                   class="px-4 py-2 border rounded text-sm">
                                    Cancel
                                </a>

                                <button type="submit"
                                        class="px-5 py-2 bg-indigo-600 text-white rounded text-sm">
                                    Update
                                </button>
                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-800">
                    <p>You have <span id="user-credits">{{ Auth::user()->credits }}</span> credits</p>
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold mb-2">Items available in the store:</h3>
                        
                        <!-- Loop through items fetched from database -->
                        @foreach($items as $item)
                        <div class="flex items-center justify-between border-b border-gray-300 py-2">
                            <div class="flex-1">
                                <p class="text-sm">{{ $item->name }}</p>
                                <p class="text-xs text-gray-800">Price: {{ $item->price }} credits</p>
                            </div>
                            <button data-price="{{ $item->price }}" data-item="{{ $item->name }}" class="buy-item inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Buy') }}
                            </button>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for feedback -->
    <div id="purchase-feedback" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded shadow-lg flex flex-col items-center">
            <div id="feedback-text" class="text-lg font-semibold text-gray-800 mb-4"></div>
            <button id="close-feedback" class="self-end px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 transition ease-in-out duration-150">
                Close
            </button>
        </div>
    </div>
        
    <script src="{{ asset('js/store.js') }}"></script>
</x-app-layout>

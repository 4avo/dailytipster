<!-- resources/views/predictions/index.blade.php -->
<x-app-layout>
    <div class="py-12 bg-black min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black text-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($predictions->isEmpty())
                        <div class="text-center text-gray-500">
                            {{ __('You have no recent activity') }}
                        </div>
                    @else
                        <h2 class="font-bold text-xl mb-4">Your Predictions</h2>
                        <ul class="space-y-6">
                            @foreach($predictions as $prediction)
                                <li class="bg-gray-800 p-4 rounded-lg shadow hover:bg-gray-700 transition duration-200">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="font-semibold text-lg">
                                                <strong>{{ $prediction->home_team }}</strong> vs <strong>{{ $prediction->away_team }}</strong>
                                            </div>
                                            <div class="text-gray-300 mt-2">
                                                {{ $prediction->prediction }}
                                            </div>
                                            <div class="text-gray-500 text-sm mt-2">
                                                Created on: {{ $prediction->created_at->format('F j, Y') }}
                                            </div>
                                        </div>
                                        <div class="text-sm text-right">
                                            <span class="inline-block px-3 py-1 font-semibold text-{{ $prediction->status == 'Pending' ? 'yellow' : ($prediction->status == 'Won' ? 'green' : 'red') }}-600 bg-{{ $prediction->status == 'Pending' ? 'yellow' : ($prediction->status == 'Won' ? 'green' : 'red') }}-200 rounded-full">
                                                {{ $prediction->status }}
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

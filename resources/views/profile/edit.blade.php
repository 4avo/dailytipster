<x-app-layout>
    <div class="bg-black min-h-screen flex items-center justify-center">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-3xl mx-auto bg-gray-900 p-6 rounded-lg shadow-lg">
                <h1 class="text-4xl font-bold text-white mb-8 text-center">Update Profile Information</h1>

                @if (session('status') == 'Profile updated successfully!')
                    <div class="success-message mb-4 text-sm font-medium text-green-600 bg-green-100 border border-green-400 rounded-lg p-4">
                        {{ session('status') }}
                    </div>
                @elseif (session('status') == 'Failed to update profile.')
                    <div class="error-message mb-4 text-sm font-medium text-red-600 bg-red-100 border border-red-400 rounded-lg p-4">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 text-sm font-medium text-red-600 bg-red-100 border border-red-400 rounded-lg p-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-6">
                        <label for="firstname" class="block text-white text-lg font-semibold mb-2">First Name</label>
                        <input id="firstname" name="firstname" type="text" class="mt-1 block w-full bg-gray-800 border border-gray-600 text-white rounded-lg py-2 px-4 focus:ring-2 focus:ring-blue-500" value="{{ old('firstname', $user->firstname) }}" required autofocus autocomplete="name">
                        @error('firstname')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="lastname" class="block text-white text-lg font-semibold mb-2">Last Name</label>
                        <input id="lastname" name="lastname" type="text" class="mt-1 block w-full bg-gray-800 border border-gray-600 text-white rounded-lg py-2 px-4 focus:ring-2 focus:ring-blue-500" value="{{ old('lastname', $user->lastname) }}" required autocomplete="family-name">
                        @error('lastname')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-white text-lg font-semibold mb-2">Email</label>
                        <input id="email" name="email" type="email" class="mt-1 block w-full bg-gray-800 border border-gray-600 text-white rounded-lg py-2 px-4 focus:ring-2 focus:ring-blue-500" value="{{ old('email', $user->email) }}" required autocomplete="email">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-white text-lg font-semibold mb-2">Password</label>
                        <input id="password" name="password" type="password" class="mt-1 block w-full bg-gray-800 border border-gray-600 text-white rounded-lg py-2 px-4 focus:ring-2 focus:ring-blue-500" autocomplete="new-password">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-white text-lg font-semibold mb-2">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-gray-800 border border-gray-600 text-white rounded-lg py-2 px-4 focus:ring-2 focus:ring-blue-500" autocomplete="new-password">
                        @error('password_confirmation')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .success-message {
            animation: fadeInOut 4s forwards;
        }
        .error-message {
            animation: fadeInOut 4s forwards;
        }
        @keyframes fadeInOut {
            0%, 100% {
                opacity: 0;
            }
            10%, 90% {
                opacity: 1;
            }
        }
    </style>
</x-app-layout>

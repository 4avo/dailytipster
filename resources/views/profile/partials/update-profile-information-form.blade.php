<!-- resources/views/profile/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-white mb-6">Update Profile Information</h1>

    <form action="{{ route('profile.update') }}" method="POST" class="bg-gray-900 p-6 rounded-lg shadow-lg">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="firstname" class="block text-white text-sm font-bold mb-2">First Name:</label>
            <input id="firstname" name="firstname" type="text" class="mt-1 block w-full bg-gray-800 border border-gray-700 text-white rounded-lg" value="{{ old('firstname', $user->firstname) }}" required autofocus autocomplete="name">
        </div>

        <div class="mb-4">
            <label for="lastname" class="block text-white text-sm font-bold mb-2">Last Name:</label>
            <input id="lastname" name="lastname" type="text" class="mt-1 block w-full bg-gray-800 border border-gray-700 text-white rounded-lg" value="{{ old('lastname', $user->lastname) }}" required autocomplete="family-name">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-white text-sm font-bold mb-2">Email:</label>
            <input id="email" name="email" type="email" class="mt-1 block w-full bg-gray-800 border border-gray-700 text-white rounded-lg" value="{{ old('email', $user->email) }}" required autocomplete="email">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-white text-sm font-bold mb-2">Password:</label>
            <input id="password" name="password" type="password" class="mt-1 block w-full bg-gray-800 border border-gray-700 text-white rounded-lg" autocomplete="new-password">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-white text-sm font-bold mb-2">Confirm Password:</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-gray-800 border border-gray-700 text-white rounded-lg" autocomplete="new-password">
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Profile</button>
    </form>
</div>
@endsection

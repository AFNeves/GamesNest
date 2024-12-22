@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center p-6 w-full bg-gray-600 rounded-lg">
        <h2 class="text-2xl mb-4 text-white">Edit Your Review</h2>

        <form method="POST" action="{{ route('review.update', $review->id) }}" class="w-full max-w-md space-y-4 bg-gray-700 p-6 rounded-lg">
            @csrf
            @method('PUT')

            <!-- Review Text -->
            <textarea name="text" placeholder="Update your review here..." class="w-full p-4 rounded-lg bg-gray-800 text-white" required>{{ old('text', $review->text) }}</textarea>

            <!-- Rating -->
            <input type="number" name="rating" min="0" max="5" step="0.1" placeholder="Rating (0-5)" class="w-full p-2 rounded-lg bg-gray-800 text-white" value="{{ old('rating', $review->rating) }}" required>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg">Update Review</button>
        </form>
    </div>
@endsection

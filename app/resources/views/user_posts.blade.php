<x-layout>

    <body class="bg-gray-100 p-6">

        <div class="max-w-3xl mx-auto space-y-6">
            @if ($posts->isEmpty())
                <p class="text-gray-400">No posts found.</p>
            @else
                @foreach ($posts as $post)
                    <div class="p-6 bg-white rounded-2xl shadow-md border border-gray-200">
                        <div class="flex items-center space-x-4">
                            <!-- Author Avatar -->
                            <img src="{{ 'https://placehold.co/50' }}" alt="Author Avatar"
                                class="w-12 h-12 rounded-full border border-gray-300">

                            <div>
                                <!-- Author Name -->
                                <h2 class="text-lg font-semibold text-gray-900">{{ $user->name ?? 'Unknown' }}</h2>
                                <!-- Post Date -->
                                <p class="text-sm text-gray-500">{{ $post->created_at->format('F j, Y') }}</p>
                            </div>
                        </div>

                        <!-- Post Content -->
                        <div class="mt-4">
                            <h3 class="text-xl font-bold text-gray-900">{{ $post->title }}</h3>
                            <p class="mt-2 text-gray-700 leading-relaxed">
                                {{ $post->content }}
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex space-x-4">
                                <button class="text-blue-600 hover:text-blue-800 transition">Like</button>
                                <button class="text-gray-600 hover:text-gray-800 transition">Comment</button>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
        @endif



</x-layout>

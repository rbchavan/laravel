<x-layout>

    <body class="bg-gray-100 p-6">
        <div class="max-w-3xl mx-auto space-y-6">

            {{-- Create Post Button --}}
            <div class="flex justify-end">
                <button id="createPostBtn"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                    + Create Post
                </button>
            </div>

            {{-- Create Post Form (Initially Hidden) --}}
            <div id="createPostForm" class="hidden p-6 bg-white rounded-2xl shadow-md border border-gray-200 mt-4">
                <form action="{{ route('user.posts.create', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    {{-- Title Field --}}
                    <div class="mb-4">
                        <label for="title" class="block text-gray-600 text-sm font-medium">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="w-1/2 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700">
                        @error('title')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Content Field --}}
                    <div class="mb-4">
                        <label for="content" class="block text-gray-600 text-sm font-medium">Content</label>
                        <textarea id="content" name="content" rows="5"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700">{{ old('content') }} </textarea>
                        @error('content')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                        class="w-full bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition">
                        Submit Post
                    </button>
                </form>
            </div>

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

        {{-- JavaScript for Toggle Form --}}
        <script>
            document.getElementById('createPostBtn').addEventListener('click', function() {
                document.getElementById('createPostForm').classList.toggle('hidden');
            });
        </script>

</x-layout>

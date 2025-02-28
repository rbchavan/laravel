<x-layout title="Users List">

    <div id="notification" class="fixed top-4 right-4 hidden p-4 rounded-lg shadow-lg">
        <p id="notificationMessage" class="text-white"></p>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-lg font-semibold text-gray-800">Confirm Deletion</h2>
            <p class="text-gray-600 mt-2">Are you sure you want to delete this user?</p>
            <div class="mt-4 flex justify-end space-x-2">
                <button id="cancelDelete" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
                <button id="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded">Delete</button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto bg-gray-800 p-6 rounded-lg shadow-md">

        <h2 class="text-2xl font-semibold mb-4">All Users</h2>

        <div class="mb-4">
            <button onclick="toggleCreateForm()"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500">Create User</button>
        </div>

        <div id="createUserForm" class="hidden bg-gray-900 p-4 rounded-lg mb-6">
            <form id="userForm">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-white">Name</label>
                    <input type="text" name="name" id="name"
                        class="w-64 p-2 bg-gray-800 text-white rounded-lg" required value="{{ old('name') }}">
                    <div id="nameError" class="text-red-500 text-sm mt-1"></div>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-white">Email</label>
                    <input type="email" name="email" id="email"
                        class="w-64 p-2 bg-gray-800 text-white rounded-lg" required value="{{ old('email') }}">
                    <div id="emailError" class="text-red-500 text-sm mt-1"></div>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-white">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-64 p-2 bg-gray-800 text-white rounded-lg" required>
                    <div id="passwordError" class="text-red-500 text-sm mt-1"></div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-white">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-64 p-2 bg-gray-800 text-white rounded-lg" required>
                    <div id="passwordConfirmationError" class="text-red-500 text-sm mt-1"></div>
                </div>

                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500">Submit</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-700 rounded-lg">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="border border-gray-600 px-4 py-2 text-left">ID</th>
                        <th class="border border-gray-600 px-4 py-2 text-left">Name</th>
                        <th class="border border-gray-600 px-4 py-2 text-left">Email</th>
                        <th class="border border-gray-600 px-4 py-2 text-center" colspan="2">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border border-gray-700 odd:bg-gray-800 even:bg-gray-700"
                            id="user-{{ $user->id }}">
                            <td class="border border-gray-600 px-4 py-2">{{ $user->id }}</td>
                            <td class="border border-gray-600 px-4 py-2">{{ $user->name }}</td>
                            <td class="border border-gray-600 px-4 py-2">{{ $user->email }}</td>
                            <td class="border border-gray-600 px-4 py-2">
                                <a href="{{ route('user.posts.index', ['user' => $user->id]) }}"
                                    class="bg-teal-400 text-white px-3 py-1 rounded inline-block">
                                    <i class="fa-solid fa-eye"></i> Post({{ $user->posts_count }})
                                </a>
                            </td>

                            <td class="border border-gray-600 px-4 py-2">
                                <button class="delete-user bg-red-400 text-white px-3 py-1 rounded"
                                    data-id="{{ $user->id }}">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-layout>

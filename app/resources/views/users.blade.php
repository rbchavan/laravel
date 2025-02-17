<x-layout title="Users List">
    <div class="max-w-4xl mx-auto bg-gray-800 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">All Users</h2>
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-700 rounded-lg">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="border border-gray-600 px-4 py-2 text-left">ID</th>
                        <th class="border border-gray-600 px-4 py-2 text-left">Name</th>
                        <th class="border border-gray-600 px-4 py-2 text-left">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border border-gray-700 odd:bg-gray-800 even:bg-gray-700">
                        <td class="border border-gray-600 px-4 py-2">{{ $user->id }}</td>
                        <td class="border border-gray-600 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-600 px-4 py-2">{{ $user->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>

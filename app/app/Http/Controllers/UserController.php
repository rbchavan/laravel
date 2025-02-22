<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;

class UserController extends Controller
{
    #[Get(uri: '/users', name: 'users.index')]
    public function profile()
    {
        $users = User::all();

        return view('users', ['users' => $users]);
    }

    #[Post(uri: '/user/create', name: 'user.create')]
    public function create(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one number, and one special character.',
        ]);



        try {
            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->password = Hash::make($validated['password']);
            $user->save();


            return response()->json([
                'message' => 'Item created successfully!',
                'success' => true,
            ]);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }

    #[Delete(uri: '/user/delete/{id}', name: 'user.delete')]
    public function delete($id)
    {

        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'User deleted successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'User not found!']);
    }

    
}

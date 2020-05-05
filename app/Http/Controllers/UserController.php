<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users\User;

class UserController extends Controller
{
    /**
     * Get all users
     * 
     * @return array
     */
    public function getAllUsers()
    {
        return User::get();
    }

    /**
     * Get single user
     * 
     * @return array
     */
    public function get($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404, 'Could not find user');
        }

        return $user;
    }

    /**
     * Get current user
     * 
     * @return array
     */
    public function current(Request $request)
    {
        return auth('api')->user();
    }

    /**
     * Update user
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return array
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404, 'Could not find user');
        }
        $user->update($request->json()->all());
        $user = User::find($id);

        return $user;
    }

    /**
     * Create a new user
     * 
     * @return array
     */
    public function create(Request $request)
    {
        $user = User::create($request->all());

        return $user;
    }

    /**
     * Delete a user
     * 
     * @param int $id
     * 
     * @return array
     */
    public function delete(int $id)
    {
        User::where('id', $id)->delete();

        return ['success' => true];
    }
}

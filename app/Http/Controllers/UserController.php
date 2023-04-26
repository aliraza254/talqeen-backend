<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\Admin\BaseController as BaseController;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        if ($user->isEmpty()) {
            return response()->json(['error' => 'No User Found'], 404);
        }
        return $this->sendResponse(new UserResource($user), 'All User.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return response()->json(['error' => 'No User Found'], 404);
        }
        return $this->sendResponse(new UserResource($user), 'User Fetched.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        return $this->sendResponse(new UserResource($user), 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if(!$user){
            return $this->sendError('User not found', 404);
        }

        $user->delete($id);
        return $this->sendResponse(new UserResource($user), 'User deleted successfully!');

    }
}

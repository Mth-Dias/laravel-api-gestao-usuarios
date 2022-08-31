<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'payload' => User::paginate(5),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $newUserRequest)
    {
        $new_user = new User;

        $new_user->fill($newUserRequest->toArray());

        $new_user->password = Hash::make($new_user->password);

        $new_user_created = $new_user->save();

        if ($new_user_created)
            return response()->json([
                'message' => 'Usuário criado com sucesso!'
            ], 200);

        return response()->json([
            'message' => 'Houve um erro ao tentar criar um novo usuário.'
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $updateUserRequest, User $user): JsonResponse
    {
        $current_password_verify = Hash::check($updateUserRequest['current_password'], $user->password);

        if (!$current_password_verify)
            return response()->json([
                'message' => 'A senha atual do usuário não confere!'
            ], 403);

        $new_userPassword_hashed = Hash::make($updateUserRequest);

        $user->password = $new_userPassword_hashed;

        $updated = $user->save();

        if ($updated)
            return response('User Updated');

        return response('User not updated sucessfully', 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user): Response
    {
        $deleted = $user->delete();

        if ($deleted)
            return response('User Deleted');

        return response('User not deleted sucessfully', 400);
    }
}

<?php
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Get user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the user"
 *     )
 * )
 */
Flight::route('GET /users/@id', function ($id) {
    $user = Flight::user_service()->getUserById($id);

    Flight::json($user);
});

/**
 * @OA\Get(
 *     path="/users/byMail/{email}",
 *     tags={"users"},
 *     summary="Get user by email",
 *     @OA\Parameter(
 *         name="email",
 *         in="path",
 *         required=true,
 *         description="Email of the user",
 *         @OA\Schema(type="string", example="user@example.com")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the user"
 *     )
 * )
 */
Flight::route('GET /users/byMail/@email', function ($email) {
    $user = Flight::user_service()->getUserByEmail($email);

    Flight::json($user);
});

/**
 * @OA\Post(
 *     path="/users",
 *     tags={"users"},
 *     summary="Create a new user",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"username", "email", "password"},
 *             @OA\Property(property="username", type="string", example="johndoe"),
 *             @OA\Property(property="email", type="string", example="john@example.com"),
 *             @OA\Property(property="password", type="string", example="securePassword123"),
 *             @OA\Property(property="full_name", type="string", example="John Doe"),
 *             @OA\Property(property="role", type="string", enum={"admin", "user"}, example="user")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User created successfully"
 *     )
 * )
 */
Flight::route('POST /users', function () {
    $data = Flight::request()->data->getData();

    Flight::json(Flight::user_service()->createUser($data));
});

/**
 * @OA\Patch(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Update a user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user to update",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=false,
 *         @OA\JsonContent(
 *             @OA\Property(property="username", type="string", example="updated_username"),
 *             @OA\Property(property="email", type="string", example="updated@example.com"),
 *             @OA\Property(property="password", type="string", example="newPassword123"),
 *             @OA\Property(property="full_name", type="string", example="Updated Name"),
 *             @OA\Property(property="role", type="string", enum={"admin", "user"}, example="admin")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User updated successfully"
 *     )
 * )
 */
Flight::route('PATCH /users/@id', function ($id) {
    $data = Flight::request()->data->getData();

    Flight::json(Flight::user_service()->updateUser($id, $data));
});

/**
 * @OA\Delete(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Delete a user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user to delete",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /users/@id', function ($id) {
    Flight::json(Flight::user_service()->deleteUser($id));
});
?>
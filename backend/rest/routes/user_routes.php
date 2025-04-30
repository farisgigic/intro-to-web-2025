<?php
require_once __DIR__ . '/../services/UserService.class.php';
require_once __DIR__ . '/../../data/roles.php';

Flight::set('userService', new UserService());

Flight::group("/users", function () {

    Flight::route('GET /', function () {
        Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
        $payload = Flight::request()->query;

        // Set default values for missing parameters
        $params = [
            'start' => isset($payload['start']) ? (int) $payload['start'] : 0,
            'search' => isset($payload['search']['value']) ? $payload['search']['value'] : '',
            'draw' => isset($payload['draw']) ? (int) $payload['draw'] : 1,
            'limit' => isset($payload['length']) ? (int) $payload['length'] : 10,
            'order_column' => isset($payload['order'][0]['name']) ? $payload['order'][0]['name'] : 'username',
            'order_direction' => isset($payload['order'][0]['dir']) ? $payload['order'][0]['dir'] : 'asc',
        ];

        $data = Flight::get('userService')->get_users_paginated(
            $params['start'],
            $params['limit'],
            $params['search'],
            $params['order_column'],
            $params['order_direction']
        );

        echo json_encode([
            'draw' => $params['draw'],
            'data' => $data['data'],
            'recordsFiltered' => $data['count'],
            'recordsTotal' => $data['count'],
            'end' => $data['count']
        ]);
    });


    /**
     * @OA\Get(
     *      path="/users/all",
     *      tags={"users"},
     *      summary="Get all users",
     *      @OA\Response(
     *           response=200,
     *           description="Get all users"
     *      )
     * )
     */
    Flight::route('GET /all', function () {
        Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // Only admins can see all users
        $data = Flight::get('userService')->getAllUsers();
        Flight::json($data, 200);
    });

    /**
     * @OA\Get(
     *      path="/users/user/{id}",
     *      tags={"users"},
     *      summary="Get user by id",
     *      @OA\Response(
     *           response=200,
     *           description="User data, or false if user does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="id", example="1", description="User ID")
     * )
     */
    Flight::route('GET /user/@id', function ($id) {
        //Flight::auth_middleware()->authorizeRole("user"); // Users can get their own data or admin can access others
        $data = Flight::get('userService')->getUserById($id);
        if ($data) {
            Flight::json($data, 200);
        } else {
            Flight::json(['message' => 'User not found'], 404);
        }
    });

    /**
     * @OA\Post(
     *      path="/users/add_user",
     *      tags={"users"},
     *      summary="Add users data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="User data, or exception if user is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="Recipe data payload",
     *          @OA\JsonContent(
     *              required={"first_name", "last_name", "username", "email", "password", "address", "city", "zip_code", "birth_date"},
     *              @OA\Property(property="first_name", type="string", example="Faris", description="User's first name"),
     *              @OA\Property(property="last_name", type="string", example="Gigic", description="User's last name"),
     *              @OA\Property(property="username", type="string", example="farisg", description="User's username"),
     *              @OA\Property(property="email", type="string", example="fare@swagger.ba", description="User's email"),
     *              @OA\Property(property="password", type="string", example="somepassword", description="User's password"),
     *              @OA\Property(property="address", type="string", example="Francuske revolucije bb", description="User's address"),
     *              @OA\Property(property="city", type="string", example="Sarajevo", description="User's city"),
     *              @OA\Property(property="zip_code", type="string", example="71000", description="User's zip code"),
     *              @OA\Property(property="birth_date", type="string", example="1990-01-01", description="User's birth date"),
     *          )
     *      )
     * )
     */
    Flight::route('POST /add_user', function () {
        Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
        $data = Flight::request()->data->getData();

        // Validate email format
        if (!isset($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            Flight::json(["error" => "Invalid email format."], 400);
            return;
        }

        try {
            $user = Flight::get("userService")->createUser($data);
            Flight::json([
                "message" => "You have successfully added",
                "data" => $user,
                "payload" => $data
            ], 200);
        } catch (Exception $e) {
            // Catch and return a clean error message
            Flight::json(["error" => $e->getMessage()], 400);
        }
    });

    /**
     * @OA\Delete(
     *      path="/users/delete_user/{id}",
     *      tags={"users"},
     *      summary="Delete user by id",
     *      @OA\Response(
     *           response=200,
     *           description="Deleted user data with provided id "
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="id", example="1", description="User ID")
     * )
     */
    Flight::route('DELETE /delete_user/@id', function ($user_id) {
        Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // Only admin can delete users
        try {
            Flight::get("userService")->deleteUser($user_id);
            Flight::json(["message" => "You have successfully deleted"], 200);
        } catch (Exception $e) {
            Flight::json(["error" => "User with this ID does not exist."], 400);
        }
    });

    /**
     * @OA\Put(
     *     path="/users/edit_user/{id}",
     *     tags={"users"},
     *     summary="Update a user by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"first_name", "last_name", "username", "email", "password", "address", "city", "zip_code", "birth_date"},
     *             @OA\Property(property="first_name", type="string", example="Faris", description="User's first name"),
     *             @OA\Property(property="last_name", type="string", example="Gigic", description="User's last name"),
     *             @OA\Property(property="username", type="string", example="farisg", description="User's username"),
     *             @OA\Property(property="email", type="string", example="fare@swagger.ba", description="User's email"),
     *             @OA\Property(property="password", type="string", example="somepassword", description="User's password"),
     *             @OA\Property(property="address", type="string", example="Francuske revolucije bb", description="User's address"),
     *             @OA\Property(property="city", type="string", example="Sarajevo", description="User's city"),
     *             @OA\Property(property="zip_code", type="string", example="71000", description="User's zip code"),
     *             @OA\Property(property="birth_date", type="string", format="date", example="1990-01-01", description="User's birth date")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User successfully updated"
     *     )
     * )
     */
    Flight::route("PUT /edit_user/@id", function ($user_id) {
        Flight::auth_middleware()->authorizeRole(Roles::USER); // Users can edit their own data
        $data = Flight::request()->data->getData();

        try {
            // Validate input on the route level (optional but helpful)
            if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                Flight::json(["error" => "Invalid email format."], 400);
                return;
            }

            if (isset($data['password']) && strlen($data['password']) < 6) {
                Flight::json(["error" => "Password must be at least 6 characters."], 400);
                return;
            }

            $user = Flight::get("userService")->updateUser($user_id, $data);
            Flight::json(["message" => "You have successfully edited user.", "data" => $user], 200);

        } catch (Exception $e) {
            Flight::json(["error" => $e->getMessage()], 400);
        }
    });

});

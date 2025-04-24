<?php
require_once __DIR__ . '/../services/ForumService.class.php';

Flight::set('forumService', new ForumService());

Flight::group("/forums", function () {
    /**
     * @OA\Get(
     *     path="/forums/all",
     *     tags={"forums"},
     *     summary="Get all forums",
     *     @OA\Response(
     *         response=200,
     *         description="List of all forum posts"
     *     )
     * )
     */
    Flight::route("GET /all", function () {
        $data = Flight::get('forumService')->getAllForums();
        Flight::json($data, 200);
    });

    /**
     * @OA\Get(
     *     path="/forums/forum/{forum_id}",
     *     tags={"forums"},
     *     summary="Get forum by ID",
     *     @OA\Parameter(
     *         name="forum_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1),
     *         description="Forum post ID"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Forum post found"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Forum not found"
     *     )
     * )
     */
    Flight::route("GET /forum/@forum_id", function ($forum_id) {
        try {
            $data = Flight::get('forumService')->getForumById($forum_id);
            Flight::json($data, 200);
        } catch (Exception $e) {
            Flight::json(['message' => 'Forum with this ID does not exist.'], 404);
        }
    });


    /**
     * @OA\Post(
     *     path="/forums/add_forum",
     *     tags={"forums"},
     *     summary="Add new forum post",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "description", "category", "user_id"},
     *             @OA\Property(property="title", type="string", example="My Car Problem", description="Forum post title"),
     *             @OA\Property(property="description", type="string", example="The engine makes a weird noise.", description="Forum post content"),
     *             @OA\Property(property="user_id", type="integer", example=1, description="ID of the user who posted")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Forum post successfully added"
     *     )
     * )
     */
    Flight::route("POST /add_forum", function () {

        $data = Flight::request()->data->getData();

        $required_fields = ["title", "description", "user_id"];
        foreach ($required_fields as $field) {
            if (!isset($data[$field]) || empty(trim($data[$field]))) {
                Flight::json(["error" => "Field '$field' is required and cannot be empty."], 400);
                return;
            }
        }

        try {

            $forum = Flight::get("forumService")->addForum($data);


            Flight::json(["message" => "Forum post successfully added.", "data" => $forum], 200);
        } catch (Exception $e) {
            Flight::json(["error" => $e->getMessage()], 500);
        }
    });


    /**
     * @OA\Delete(
     *     path="/forums/delete_forum/{forum_id}",
     *     tags={"forums"},
     *     summary="Delete forum post by ID",
     *     @OA\Parameter(
     *         name="forum_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1),
     *         description="Forum post ID"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Forum post successfully deleted"
     *     )
     * )
     */
    Flight::route("DELETE /delete_forum/@forum_id", function ($forum_id) {
        try {
            Flight::get("forumService")->deleteForum($forum_id);
            Flight::json(["message" => "You have successfully deleted"], 200);

        } catch (Exception $e) {
            Flight::json(["error" => "Forum with this ID does not exist."], 400);
        }
    });

    /**
     * @OA\Put(
     *     path="/forums/edit_forum/{forum_id}",
     *     tags={"forums"},
     *     summary="Edit a forum post",
     *     @OA\Parameter(
     *         name="forum_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1),
     *         description="Forum post ID"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Updated Title"),
     *             @OA\Property(property="description", type="string", example="Updated forum description"),
     *             @OA\Property(property="user_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Forum post successfully updated"
     *     )
     * )
     */
    Flight::route("PUT /edit_forum/@forum_id", function ($forum_id) {
        $data = Flight::request()->data->getData();
        error_log(print_r($data, true));

        try {
            $forum = Flight::get("forumService")->editForum($forum_id, $data);
            Flight::json(["message" => "Forum with ID $forum_id has been successfully updated."], 200);
        } catch (Exception $e) {
            Flight::json(["message" => "An error occurred: " . $e->getMessage()], 500);
        }
    });

});
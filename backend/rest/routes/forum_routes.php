<?php
require_once __DIR__ . '/../services/ForumService.class.php';

Flight::set('forumService', new ForumService());

Flight::group("/forums", function () {

    Flight::route("GET /all", function () {
        $data = Flight::get('forumService')->getAllForums();
        Flight::json($data, 200);
    });

    Flight::route("GET /forum/@forum_id", function ($forum_id) {
        $data = Flight::get('forumService')->getForumById($forum_id);
        if ($data) {
            Flight::json($data, 200);
        } else {
            Flight::json(['message' => 'Forum not found'], 404);
        }
    });

    Flight::route("POST /add_forum", function () {
        $data = Flight::request()->data->getData();
        $forum = Flight::get("forumService")->addForum($data);
        Flight::json(["message" => "You have successfully added", "data" => $forum, "payload" => $data], 200);
    });

    Flight::route("DELETE /delete_forum/@forum_id", function ($forum_id) {
        Flight::get("forumService")->deleteForum($forum_id);
        Flight::json(["message" => "You have successfully deleted"], 200);
    });

    Flight::route("PUT /edit_forum/@forum_id", function ($forum_id) {
        $data = Flight::request()->data->getData();
        error_log(print_r($data, true));
        $forum = Flight::get("forumService")->editForum($forum_id, $data);
        Flight::json(["message" => "You have successfully edited forum with id: ", $forum_id], 200);
    });
});
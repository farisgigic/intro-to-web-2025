var ForumService = {
    delete_forum: function (forum_id) {
        if (
            confirm(
                "Do you want to delete this forum ?"
            ) == true
        ) {
            RestClient.delete(
                "delete/" + forum_id, {}, function (data) { }
            );
        }
    }
};
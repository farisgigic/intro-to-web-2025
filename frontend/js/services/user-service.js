var UserService = {
    reload_users_datatable: function () {
        Utils.get_datatable(
            "admin_users", "http://localhost/intro-to-web-2025/backend/users/",
            [
                { data: "id" },
                { data: "first_name" },
                { data: "last_name" },
                { data: "username" },
                { data: "email" },
                { data: "password" },
                { data: "address" },
                { data: "city" },
                { data: "zip_code" },
                { data: "birth_date" },
                { data: "role" },
                { data: "actions" },
                // { data: "actions" },

            ], null, function () {
                console.log("Datatable works");
            }
        );
    }
}
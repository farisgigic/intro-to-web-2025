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
                console.log("Datatable for users works");
            }
        );
    },
    reload_cars_datatable_admin: function () {
        Utils.get_datatable(
            "admin_cars", "http://localhost/intro-to-web-2025/backend/cars/all/admin",
            [
                { data: "manufacturer" },
                { data: "model" },
                { data: "year" },
                { data: "engine" },
                { data: "user_id" },
                { data: "actions" },
            ], null, function () {
                console.log("Datatable for cars works");
            }
        );
    }
}
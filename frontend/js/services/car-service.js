var CarService = {
    reload_cars_datatable: function () {
        Utils.get_datatable(
            "tbl_cars", "",
            [
                { data: "id" },
                { data: "first_name" },
                { data: "last_name" },
                { data: "semester" },
                { data: "id_number" },
                { data: "id_user" },
                { data: "actions" },

            ], null, function () {
                console.log("avshbjdk");
            }
        );
    }
}
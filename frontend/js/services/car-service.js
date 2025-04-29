var CarService = {
    reload_cars_datatable: function () {
        Utils.get_datatable(
            "tbl_cars", "http://localhost/intro-to-web-2025/backend/cars/",
            [
                { data: "number" },
                { data: "manufacturer" },
                { data: "model" },
                { data: "year" },
                { data: "engine" },
                { data: "actions" },
                // { data: "actions" },

            ], null, function () {
                console.log("Datatable works");
            }
        );
    }
}
var CarService = {
    reload_cars_datatable: function () {
        Utils.get_datatable(
            "tbl_cars", Constants.API_BASE_URL + "cars/",
            [
                { data: "number" },
                { data: "manufacturer" },
                { data: "model" },
                { data: "year" },
                { data: "engine" },
                {
                    data: "actions",
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return data;
                    }
                }
                // { data: "actions" },

            ], null, function () {
                console.log("Datatable works");

            }
        );
    }
}
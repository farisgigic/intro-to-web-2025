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
    },

    open_edit_car_modal: function (car_id) {
        RestClient.get("cars/car/" + car_id, function (data) {
            const car = data[0];
            $("#edit-car-modal").modal("show");
            $("#edit-car-form input[name='id']").val(car.id);
            $("#edit-car-form input[name='manufacturer']").val(car.manufacturer);
            $("#edit-car-form input[name='model']").val(car.model);
            $("#edit-car-form input[name='year']").val(car.year);
            $("#edit-car-form input[name='engine']").val(car.engine);
        });

    },

    delete_car: function (car_id) {
        if (
            confirm(
                "Do you want to delete contact car?"
            ) == true
        ) {
            RestClient.delete(
                "cars/delete_car/" + car_id,
                {},
                function () {
                    CarService.reload_cars_datatable();
                }
            );
        }
    },
}
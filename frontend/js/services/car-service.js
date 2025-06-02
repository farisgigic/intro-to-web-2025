var CarService = {
    reload_cars_datatable: function () {
        Utils.get_datatable(
            "tbl_cars", Constants.get_api_base_url() + "cars/",
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

    open_info_modal: function (car_id) {
        RestClient.get("car_maintenance/" + car_id, function (data) {
            const car = data;

            if (!car) {
                toastr.warning("No maintenance data found for this car.");
                return;
            }

            $("#info-car-modal").modal("show");
            $("#info-car-form input[name='car_id']").val(car_id);
            $("#info-car-form input[name='service']").val(formatDate(car.service));
            $("#info-car-form input[name='large_service']").val(formatDate(car.large_service));
            $("#info-car-form input[name='front_disc_pads']").val(formatDate(car.front_disc_pads));
            $("#info-car-form input[name='rear_disc_pads']").val(formatDate(car.rear_disc_pads));
            $("#info-car-form input[name='air_oil_filter']").val(formatDate(car.air_oil_filter));
            $("#info-car-form input[name='transmission_oil']").val(formatDate(car.transmission_oil));
            $("#info-car-form input[name='cabin_air_filter']").val(formatDate(car.cabin_air_filter));
            $("#info-car-form input[name='inspection']").val(formatDate(car.inspection));
            $("#info-car-form input[name='deep_cleaning']").val(formatDate(car.deep_cleaning));

        });
    },

    add_maintenance: function (carId) {
        $("#car_id").val(carId);

        const today = new Date().toISOString().split('T')[0];
        // set default dates (optional)
        $("#service").val(today);
        $("#large_service").val(today);
        $("#front_disc_pads").val(today);
        $("#rear_disc_pads").val(today);
        $("#air_oil_filter").val(today);
        $("#transmission_oil").val(today);
        $("#cabin_air_filter").val(today);
        $("#inspection").val(today);
        $("#deep_cleaning").val(today);

        $("#maintenance-car-modal").modal("show");

        $("#maintenance-car-form").off("submit").submit(function (e) {
            e.preventDefault();

            const carPData = {
                car_id: $("#car_id").val(),
                service: $("#service").val(),
                large_service: $("#large_service").val(),
                front_disc_pads: $("#front_disc_pads").val(),
                rear_disc_pads: $("#rear_disc_pads").val(),
                air_oil_filter: $("#air_oil_filter").val(),
                transmission_oil: $("#transmission_oil").val(),
                cabin_air_filter: $("#cabin_air_filter").val(),
                inspection: $("#inspection").val(),
                deep_cleaning: $("#deep_cleaning").val()
            };

            console.log(carPData);

            RestClient.post("car_maintenance/add_maintenance/", carPData, function () {
                $("#maintenance-car-modal").modal("toggle");
                CarService.reload_cars_datatable();
                toastr.success("Car Maintenance added successfully");
            });
        });
    }


}

function formatDate(datetimeStr) {
    return datetimeStr ? datetimeStr.split(' ')[0] : '';
}
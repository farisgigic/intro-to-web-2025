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
                { data: "user_id" },
                { data: "actions" },
            ], null, function () {
                console.log("Datatable for cars works");
            }
        );
    },
    reload_contacts_datatable_admin: function () {
        Utils.get_datatable(
            "admin_contacts", "http://localhost/intro-to-web-2025/backend/contacts/all/admin",
            [
                { data: "id" },
                { data: "full_name" },
                { data: "email" },
                { data: "subject" },
                { data: "message" },
                { data: "actions" },
            ], null, function () {
                console.log("Datatable for contacts works");
            }
        );
    },
    delete_user_admin: function (user_id) {
        if (
            confirm(
                "Do you want to delete car?"
            ) == true
        ) {
            RestClient.delete(
                "users/delete_user/" + user_id,
                {},
                function (data) {
                    UserService.reload_users_datatable();
                }
            );
        }
    },
    open_edit_contact_modal: function (contact_id) {
        RestClient.get("contacts/contact/" + contact_id, function (data) {
            const contact = data[0];
            $("#contact-modal").modal("show");
            $("#contact-form input[name='full_name']").val(contact.full_name);
            $("#contact-form input[name='email']").val(contact.email);
            $("#contact-form input[name='subject']").val(contact.subject);
            $("#contact-form input[name='message']").val(contact.message);
        });

    },
    delete_contact_admin: function (contact_id) {
        if (
            confirm(
                "Do you want to delete contact message?"
            ) == true
        ) {
            RestClient.delete(
                "contacts/delete_contact/" + contact_id,
                {},
                function () {
                    UserService.reload_contacts_datatable_admin();
                }
            );
        }
    },
    open_edit_car_modal_admin: function (car_id) {
        RestClient.get("cars/car/" + car_id, function (data) {
            const car = data[0];
            $("#edit-car-modal").modal("show");
            $("#edit-car-form input[name='id']").val(car.id);
            $("#edit-car-form input[name='manufacturer']").val(car.manufacturer);
            $("#edit-car-form input[name='model']").val(car.model);
            $("#edit-car-form input[name='year']").val(car.year);
            $("#edit-car-form input[name='engine']").val(car.engine);
            $("#edit-car-form input[name='user_id']").val(car.user_id);
        });

    },
    delete_car_admin: function (car_id) {
        if (
            confirm(
                "Do you want to delete car?"
            ) == true
        ) {
            RestClient.delete(
                "cars/delete_car/" + car_id,
                {},
                function () {
                    UserService.reload_cars_datatable_admin();
                }
            );
        }
    },

}
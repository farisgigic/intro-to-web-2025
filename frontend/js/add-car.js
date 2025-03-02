let cars = [];

$("#carForm1").validate({
    rules: {
        "manufacturer": {
            required: true
        },
        "model": {
            required: true
        },
        "year": {
            required: true
        },
        "mileage": {
            required: true
        },
        "engine": {
            required: true
        },
        "fuel": {
            required: true
        },
        "transmission": {
            required: true
        },
        "hpower": {
            required: true
        },
        "drivetrain": {
            required: true
        },
        "tires": {
            required: true
        }

    },
    messages: {
        "manufacturer": {
            required: "Please insert manufacturer of your car !"
        },
        "model": {
            required: "Please insert model of your car !"
        },
        "year": {
            required: "Please insert year of your car !"
        },
        "mileage": {
            required: "Please insert mileage of your car !"
        },
        "engine": {
            required: "Please insert engine of your car !"
        },
        "fuel": {
            required: "Please insert fuel type of your car !"
        },
        "power": {
            required: "Please insert power of your car in KW !"
        },
        "hpower": {
            required: "Please insert horse power of your car ( KW * 1.36)."
        },
        "drivetrain": {
            required: "Please choose drivetrain of your car !"
        },
        "tires": {
            required: "Please choose tires of your car !"
        }
    },
    submitHandler: function (form, event) {
        event.preventDefault();
        let car = serializeForm(form);
        cars.push(car);
        console.log("New cars = ", cars);
        //$("#carForm1")[0].reset();
        toastr.success("You have successfully completed a first step of adding new car !");
    }

});

serializeForm = (form) => {
    let jsonResult = {};
    //console.log($(form).serializeArray());
    //serializeArray() reutrns an array of: name: [name of filed], value: [value of filed] for each field in the form
    $.each($(form).serializeArray(), function () {
        jsonResult[this.name] = this.value;
    });
    return jsonResult;
}
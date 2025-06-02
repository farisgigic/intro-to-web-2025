let contacts = [];

$("#contact_form").validate({
    rules: {
        "full_name": {
            required: true
        },
        "email": {
            required: true,
            email: true
        },
        "subject": {
            required: true
        },
        "message": {
            required: true
        }
    },
    messages: {
        "full_name": {
            required: "Please write your name :)"
        },
        "email": {
            required: "Please tell us your email in order to communicate better!"
        },
        "subject": {
            required: "Please tell us what is your message about."
        },
        "message": {
            required: "Please do not leave your message empty."
        }
    },
    submitHandler: function (form, event) {
        event.preventDefault();
        let contact = serializeForm(form);
        console.log(JSON.stringify(contact));
        contacts.push(contact);

        $.post(Constants.API_BASE_URL + "add_message.php", contact).done(function (data) {
            toastr.success("You have successfully sent your question!");
            $("#contact_form")[0].reset();
        }).fail(function (xhr, status, error) {
            console.log(xhr.error);
            toastr.error("Error ocured while contacting CarCare");
        })
        $("#contact_form")[0].reset();


    }
});

function serializeForm(form) {
    let jsonResult = {};
    $.each($(form).serializeArray(), function () {
        jsonResult[this.name] = this.value;
    });
    return jsonResult;
}
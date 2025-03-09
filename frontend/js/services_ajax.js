function updateServiceCenters() {
    $.get("json/services.json", function (data) {
        let options = `<option value="" selected disabled>Select a Service Center</option>`;

        data.forEach((instance, index) => {
            options += `<option value="${index}">${instance.service_center}</option>`;
        });

        $("#service_center").html(options); // Populate select
    });
}

// Load service centers when page is ready
$(document).ready(function () {
    updateServiceCenters();
});

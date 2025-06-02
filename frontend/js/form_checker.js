// Handle the submission of Form 1
document.getElementById("carForm1").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the default   submission

    // Check if all fields in Form 1 are filled
    let isForm1Complete = true;
    document.querySelectorAll("#carForm1 input").forEach(input => {
        if (input.value === "") {
            isForm1Complete = false;
        }
    });

    if (isForm1Complete) {
        // Hide Form 1 and show Form 2
        document.getElementById("form1").style.display = "none";
        document.getElementById("form2").style.display = "block";
    }
    else {
        toastr.error("Please fill out all fields in the form.")
    }
});

// Handle the submission of Form 2
document.getElementById("carForm2").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Check if all fields in Form 2 are filled
    let isForm2Complete = true;
    document.querySelectorAll("#carForm2 input").forEach(input => {
        if (input.value === "") {
            isForm2Complete = false;
        }
    });

    if (isForm2Complete) {
        // Hide Form 2 and show Form 3
        document.getElementById("form2").style.display = "none";
        document.getElementById("form3").style.display = "block";
    } else {
        toastr.error("Please fill out all fields in the form")
    }
});

// Handle the submission of Form 3
document.getElementById("carForm3").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Check if all fields in Form 3 are filled
    let isForm3Complete = true;
    document.querySelectorAll("#carForm3 input").forEach(input => {
        if (input.value === "") {
            isForm3Complete = false;
        }
    });

    if (isForm3Complete) {
        // Process the final form submission
        alert("All forms have been submitted!");
        // Add your form submission logic here
    } else {
        toastr.error("Please fill out all fields in the form")
    }
});


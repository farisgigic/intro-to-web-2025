//This is JS script which is used to fill data into <select> field in form using AJAX call

let dataFetched = []; // where we will store our data fetched from .json file (all manufacturer names will be here)

$(document).ready(() => {
    getManufacturers("json/car_brands.json"); // Calling function for getting manfuacturers
});

const storeId = (id) => {
    localStorage.setItem("manufacturer", id); // finding element in our add-new-car.html with id "manufacturer" and set that value to "id" which is parameter to out method
};

const getManufacturers = (dataUrl) => {
    $.get(dataUrl, (data) => { // with $.get we are accepting our data fetched from our .json file
        console.log(data); // writing to console all files that we got just to make sure everything works as a charm
        dataFetched = data; // Store fetched data in the array
        renderItems(dataFetched); // Render items to the datalist
    });
};

const renderItems = (itemsArray) => {
    const dataList = document.getElementById("manfuacturers"); // searching for datalist in our add-new-car.html with id "manfuacturers" and store it in dataList variable
    dataList.innerHTML = ""; // Clear existing options, removing if anything was inside before

    itemsArray.forEach(instance => {
        dataList.innerHTML += `<option value="${instance.car_brand}"></option>`; // using innerHTML we are inserting into our index.html files fetched one by one 
        // using this instance.city we are getting every instance of itemsArray and store it in dataList in index.html file
    });
};


// MANDATORY FILES
// 2 JS scripts named
//  jquery-1.12.4.min.js -> used for DOM manipulation, event handling, AJAX calls, ...
//  jquery-3.7.1.js -> using all methods like .ready, .get,...

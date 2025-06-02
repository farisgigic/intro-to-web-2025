let fetchedData = [];

$(document).ready(() => {
    getCars("json/cars.json");
});

storeId = (id) => {
    localStorage.setItem("carId", id);
}

getCars = (dataUrl) => {
    $.getJSON(dataUrl, (response) => {
        console.log("radi");
        fetchedData = response.cars;
        callCars(fetchedData);
        console.log(fetchedData);
    })
};

callCars = (carsArray) => {
    let allCarsContainer = document.querySelector(".all-cars");
    allCarsContainer.innerHTML = ""; // Clear previous content

    let carsHTML = "";

    carsArray.forEach((car) => {
        carsHTML += `
            <div class="car-card">
                <div class="car-header">
                    <h2>${car.name} 
                        <a href="#nestoooooo" class="edit-icon">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </h2>
                    <img src="${car.image}" alt="${car.name}">
                    <ul>
                        <li>${car.year}</li>
                        <li>${car.km} km</li>
                        <li>${car.engine}</li>
                        <li>${car.fuelType}</li>
                    </ul>                    
                </div>
                <div class="car-details">
                    <div class="car-service">
                        <table>
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Latest</th>
                                    <th>Recommended</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${car.services.map(service => `
                                    <tr>
                                        <td class="service-type ${service.statusClass}">${service.type}</td>
                                        <td>${service.latest}</td>
                                        <td>${service.recommended}</td>
                                        <td><img src="img/icons/${service.statusClass}.png" alt=""></td>
                                    </tr>
                                `).join("")}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="car-footer">
                    <button class="details-btn">Hide details <i class="fa fa-chevron-up"></i></button>
                </div>
            </div>
        `;
    });

    allCarsContainer.innerHTML = carsHTML; // Inject generated HTML
};

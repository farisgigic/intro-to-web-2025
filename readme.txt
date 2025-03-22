# CarCare Application

CarCare is a web application designed to help users manage their car maintenance efficiently while providing a forum for discussions on car-related topics. Users can add and track their vehicles, participate in community discussions, and reach out to support when needed.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Technologies Used](#technologies-used)
- [Contributing](#contributing)
- [License](#license)

## Features

- **Home Page**: Overview of the application's functionality.
- **About Us**: Learn more about the CarCare team.
- **My Cars**: Add, view, and manage your cars.
- **Forum**: Engage in discussions on car-related issues.
- **Login/Register**: User authentication and account management.
- **Contact Support**: Get assistance from the support team.

## Installation

### Prerequisites
- Ensure you have [XAMPP](https://www.apachefriends.org/index.html) installed and running.
- PHP and MySQL should be properly configured.

### Steps to Install

1. **Clone the repository**:
    ```bash
    git clone https://github.com/your-username/carcare.git
    ```

2. **Navigate to the project directory**:
    ```bash
    cd carcare
    ```

3. **Move files to the server directory**:
    - Place the project files inside the `htdocs` directory of your XAMPP installation.

4. **Set up the database**:
    - Start Apache and MySQL from XAMPP.
    - Open [phpMyAdmin](http://localhost/phpmyadmin).
    - Create a new database named `carcare`.
    - Import the provided SQL file from the project (`database/carcare.sql`).

5. **Start the application**:
    - Open your browser and navigate to:
      ```
      http://localhost/carcare
      ```

## Usage

- **Home Page**: Provides an overview of CarCare’s features.
- **About Us**: Displays information about the team behind CarCare.
- **My Cars**: Manage personal vehicle information.
- **Forum**: Participate in discussions and share experiences.
- **Login/Register**: Securely access personalized features.
- **Contact Support**: Reach out for assistance when needed.

## Technologies Used

### Frontend:
- HTML
- CSS
- JavaScript
- Bootstrap
- jQuery

### Backend:
- PHP (FlightPHP framework)
- MySQL (database)
- XAMPP (local development environment)

## Contributing

We welcome contributions from the community! To contribute:

1. **Fork the repository**.
2. **Create a new branch**:
    ```bash
    git checkout -b feature-branch
    ```
3. **Make changes and commit**:
    ```bash
    git commit -m "Add new feature"
    ```
4. **Push your changes**:
    ```bash
    git push origin feature-branch
    ```
5. **Open a pull request** to merge your changes into the main branch.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

Need help? Feel free to open an issue or contact the CarCare support team!

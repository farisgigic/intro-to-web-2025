# Web Programming Project - PHP, JS, MySQL

## 🌟 Project Overview

Welcome to the Web Programming project! This project aims to build a dynamic, interactive, and mobile-friendly web application using **PHP**, **JavaScript**, and **MySQL**. The backend will use the **FlightPHP** framework, while the frontend will rely on HTML, CSS, JavaScript, and **Bootstrap**.

### 🎯 Project Goals
- **Backend**: RESTful API using FlightPHP, with **PHP PDO** for database interactions.
- **Frontend**: Single Page Application (SPA) with HTML, CSS, and JS.
- **Authentication**: Implement **JWT** (JSON Web Tokens) for secure login and role-based authorization.
- **Database**: Use **MySQL** with at least 5 entities for basic CRUD operations.
- **Documentation**: API documentation using **OpenAPI** and **Swagger**.

The application will be deployed and hosted publicly, ensuring it meets modern standards of web development.

---

## ⚙️ Technologies

- **Frontend**:
  - HTML, CSS, JavaScript
  - Bootstrap, Highcharts, DataTables
  - AJAX for dynamic content
- **Backend**:
  - PHP, FlightPHP Framework
  - PHP PDO for database access
- **Database**: MySQL
- **Authentication**: JWT (JSON Web Tokens)
- **Documentation**: OpenAPI, Swagger
- **Version Control**: GitHub
- **Hosting**: GitHub Pages (via GitHub Education Pack), Heroku, DigitalOcean, AWS

---

## 📝 Project Requirements

### 🔹 Core Features:
- **Single Page Application (SPA)**: No full page reloads.
- **Mobile-Friendly**: Fully responsive design.
- **CRUD Operations**: Implement CRUD for at least 5 entities (e.g., Users, Products, Orders, Categories, Reviews).
- **API Documentation**: OpenAPI format with Swagger.
- **JWT Authentication**: For secure user login and authorization.
- **Role-Based Access**: Admin and regular user roles.
- **Public Hosting**: The application must be hosted and accessible via a domain.

---

## 🏁 Milestones

### 🛠️ **Milestone 1**: Initial Setup and Frontend Development  
**Deadline**: End of Week 3 (March 23, 2025)

- **Project Structure**:  
  Set up the folder structure with **frontend** and **backend** directories. Prepare basic folders for backend (routes, services, DAO) and frontend (CSS, JS, HTML templates, static assets).
  
- **Static Frontend**:  
  Prepare all necessary static pages and components. Ensure the application functions as a **Single-Page Application (SPA)** with no backend connection at this stage.
    - **Pages**: Register/Login, Dashboard, Profile, etc.
    - Use **HTML/Bootstrap** templates and customize them for the project.

- **Database Schema Planning**:  
  Identify at least 5 entities (Users, Products, Orders, Categories, Reviews) and submit a **draft ERD (Entity-Relationship Diagram)**.

---

### 🗂️ **Milestone 2**: Backend Setup and CRUD Operations for Initial Entities  
**Deadline**: End of Week 5 (April 6, 2025)

- **Database Creation**:  
  Design a relational database schema in **MySQL** with at least 5 entities. Create a **SQL script** for setting up the database.

- **DAO Layer Implementation**:  
  Implement **DAO** classes for each entity with full **CRUD** functionality (Create, Read, Update, Delete).

---

### 🔧 **Milestone 3**: Full CRUD Implementation for All Entities & Open API  
**Deadline**: End of Week 9 (May 4, 2025)

- **Business Logic Implementation**:  
  Create services to manage each entity and encapsulate application-specific logic (e.g., validation).

- **Presentation Layer**:  
  Implement dynamic rendering of content using **FlightPHP**.

- **OpenAPI Documentation**:  
  Document API endpoints using **OpenAPI** and generate a **Swagger** visual interface.

---

### 🔐 **Milestone 4**: Middleware, Authentication, and Authorization  
**Deadline**: End of Week 12 (May 25, 2025)

- **Authentication and Middleware**:  
  Implement middleware for **request validation**, **error handling**, and **logging**. Set up user authentication (registration, login) with **JWT tokens** and secure password hashing.

- **Authorization**:  
  Implement **role-based access control (RBAC)**:
    - Admin users: Full CRUD access.
    - Regular users: View-only access to certain entities.

- **Frontend Updates**:  
  Add dynamic features for authenticated users (e.g., personalized dashboard, admin panel) and adjust the UI to reflect role-based access.

---

### 🚀 **Milestone 5**: Final Deployment, API Documentation, and CI/CD  
**Deadline**: End of Week 14 (June 8, 2025)

- **Frontend MVC Implementation**:  
  Refactor the frontend to follow the **MVC pattern** for better maintainability and scalability.

- **Validation and Security Enhancements**:  
  Implement **client-side and server-side validations**. Ensure the backend is secure against **SQL injection** and **XSS** attacks.

- **Deployment**:  
  Deploy the web application to a **hosting platform** (Heroku, DigitalOcean, AWS). Ensure the database is connected to the deployed backend and the application is live.

---

## 📍 Hosting and Repository

- **GitHub Repository**: All code will be version-controlled in a public **GitHub** repository.
- **Deployment**: The application will be hosted and publicly accessible via a domain. We'll use **GitHub Education Pack** for hosting or other hosting providers as needed.

---

## 💻 Getting Started

1. Clone this repository:
    ```bash
    git clone https://github.com/your-username/your-project-name.git
    ```
2. Install required dependencies:
    - For backend: **FlightPHP** framework, **PHP PDO** for MySQL.
    - For frontend: **Bootstrap**, **Highcharts**, **DataTables**.
3. Set up the database:
    - Use the provided **SQL script** to create the necessary tables.
4. Configure environment:
    - Set up your local development environment (e.g., using XAMPP, LAMP, or any PHP-compatible server).

---

## 📚 Documentation

- **API Documentation**: Available via Swagger UI (once the backend is set up).
- **Database Schema**: Available in the database creation scripts.

---

## 🛠️ License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

### 🔗 Links

- **GitHub Repository**: [link to your repository]
- **Live Application**: [link to the deployed web app]


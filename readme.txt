# Web Programming Project - PHP, JS, MySQL

## Project Overview

This web application will be developed using PHP, JavaScript, and MySQL. The goal of this project is to build a dynamic, interactive, and mobile-friendly web application following modern development practices. The application will utilize the FlightPHP framework for the backend, PHP PDO for database access, and AJAX for dynamic interactions. The project will also implement JWT tokens for secure authentication and role-based authorization.

## Technologies

- **Frontend**: HTML, CSS, JavaScript, Bootstrap, Highcharts, DataTables, AJAX
- **Backend**: PHP, FlightPHP, PDO (for database access)
- **Database**: MySQL
- **Authentication**: JWT (JSON Web Tokens)
- **Documentation**: OpenAPI, Swagger
- **Version Control**: GitHub (repository for monitoring progress)
- **Hosting**: GitHub Pages (via GitHub Education Pack), or other hosting providers

## Project Requirements

- The application should be a single-page application (SPA).
- It must be mobile-friendly and responsive.
- At least 5 entities with basic CRUD operations (Users, Products, Orders, Categories, Reviews).
- Use of FlightPHP framework for the backend and PHP PDO for database access.
- JWT tokens for authentication and authorization.
- API must be documented using OpenAPI.
- The application should be deployed and publicly available.

## Milestones

### Milestone 1: Initial Setup and Frontend Development
**Deadline**: End of Week 3 (March 23, 2025)

- **Project Structure**: Set up the project folder structure with frontend and backend directories. Prepare basic folders for backend (routes, services, dao) and frontend (css files, js files, HTML templates - views, static assets).
- **Static Frontend**: Prepare all pages and components needed for the frontend part of the application. These pages should be static and function as a single-page application (SPA), with no backend connection at this stage. 
    - Include pages: Register/Login, Dashboard, Profile, Entities, etc.
    - Use HTML/Bootstrap templates and customize them to fit the needs of the project.
- **Database Schema (Planning Only)**: Identify at least 5 entities for the application (e.g., Users, Products, Orders, Categories, Reviews).
    - Submit a draft Entity-Relationship Diagram (ERD) showing relationships among these entities.

### Milestone 2: Backend Setup and CRUD Operations for Initial Entities
**Deadline**: End of Week 5 (April 6, 2025)

- **Database Creation**: Design and document a relational database schema in MySQL with at least 5 entities. Prepare a SQL script for creating the database and tables.
- **DAO Layer**: Implement the DAO Layer to interact with the database for at least five entities. Provide CRUD functionality (Create, Read, Update, Delete) for these entities.

### Milestone 3: Full CRUD Implementation for All Entities & Open API
**Deadline**: End of Week 9 (May 4, 2025)

- **Business Logic Implementation**: Create services for managing each database entity. Implement application-specific logic and constraints (e.g., validation rules).
- **Presentation Layer**: Implement the presentation layer to render dynamic content using FlightPHP.
- **OpenAPI Documentation**: Document available API endpoints using the OpenAPI standard and generate a visual API documentation page (Swagger).

### Milestone 4: Middleware, Authentication, and Authorization
**Deadline**: End of Week 12 (May 25, 2025)

- **Authentication and Middleware**: Add middleware to handle request validation, error handling, and logging. Implement user authentication with FlightPHP and middleware. Allow users to register and log in, ensuring password hashing for security.
- **Authorization**: Implement role-based access control (RBAC). Admins should be able to perform CRUD operations for all entities, while regular users have restricted access (view-only for certain entities).
- **Frontend Updates**: Add dynamic features for authenticated users (e.g., personalized dashboard, admin panel). Ensure UI components reflect role-based access.

### Milestone 5: Final Deployment, API Documentation, and CI/CD
**Deadline**: End of Week 14 (June 8, 2025)

- **Frontend MVC Implementation**: Refactor the frontend to follow the MVC pattern for maintainability and scalability.
- **Front End Validations and Security Enhancements**: Add client-side and server-side form validations. Ensure the backend is secure against SQL injection and XSS attacks.
- **Deployment**: Set up and deploy the web application on a hosting platform (e.g., Heroku, DigitalOcean, AWS). Ensure the database is hosted and connected to the deployed backend.


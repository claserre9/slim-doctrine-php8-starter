# Slim Doctrine PHP 8 Starter

A starter template for building PHP applications using the Slim micro-framework and Doctrine ORM, targeting PHP 8.3. This project is set up with essential configurations and best practices to help you get started quickly.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Available Scripts](#available-scripts)
- [Docker](#docker)
- [Project Structure](#project-structure)
- [License](#license)

## Features

- **Slim Framework**: Lightweight and powerful PHP micro-framework.
- **Doctrine ORM**: Powerful ORM for managing database interactions in an object-oriented manner.
- **PHP 8.3**: Latest PHP features and improvements.
- **PSR Compliance**: Follows PSR standards for better interoperability.

## Installation

1. **Clone the repository**:
    ```bash
    git clone https://github.com/yourusername/slim-doctrine-php8-starter.git
    cd slim-doctrine-php8-starter
    ```

2. **Install dependencies**:
    ```bash
    composer install
    ```

3. **Set up environment variables**:
   Copy the `.env.example` to `.env` and adjust the settings as needed.
    ```bash
    cp .env.example .env
    ```

4. **Run the application**:
    ```bash
    php -S localhost:8080 -t public
    ```

## Configuration

The application uses environment variables for configuration. Ensure you have a proper `.env` file in the root directory with the required settings. Example:

```env
APP_ENV=development
DATABASE_URL=mysql://user:password@localhost:3306/mydb
```

## Usage

### Running the Development Server

To start the development server:

```bash
php -S localhost:8080 -t public
```

### Accessing the Application

Once the server is running, you can access the application at `http://localhost:8080`.

## Available Scripts

### Doctrine Commands

The following commands are available for database management via Doctrine:

- **Create the database**:
    ```bash
    php bin/doctrine orm:schema-tool:create 
    ```

- **Drop the database**:
    ```bash
    php bin/doctrine orm:schema-tool:drop --force
    ```

## Docker

Docker is also supported to simplify the setup process.

### Running the Application with Docker

Start the Docker containers:
```bash
docker-compose up -d
```

This will start the application and its dependencies in Docker containers. The application should be accessible at `http://localhost:8080`.

### Stopping the Docker Containers

To stop the running containers:
```bash
docker-compose down
```

## Project Structure

- **public/**: The web server’s document root where the index.php file is located.
- **src/**: Contains the application’s source code.
    - **controllers/**: Define the application controllers.
    - **EntityManagerFactory.php**: Factory for creating Doctrine Entity Manager instances.
- **bin/**: Contains executable scripts, e.g., for Doctrine CLI.
- **.env**: Environment configuration file.
- **docker-compose.yml**: Docker Compose configuration file.
- **Dockerfile**: Dockerfile to build the application container.
- **composer.json**: Composer configuration file.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
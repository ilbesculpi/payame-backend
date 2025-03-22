<p align="center">
    <a href="https://github.com/ilbesculpi/payame-backend/tree/develop" target="_blank">
        <img src="https://github.com/ilbesculpi/payame-backend/blob/develop/art/logo_square.png?raw=true" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Payame

Loan Tracker: A mobile application designed to help users easily register loans, track payment schedules, and monitor outstanding balances.

## Installation

This section provides instructions on how to set up the development environment for the backend.

**Prerequisites:**

*   Docker and Docker Compose must be installed on your system.  You can find installation instructions for Docker [here](https://docs.docker.com/get-docker/).

**Steps:**

1.  **Environment Configuration:**

    *   Create a `.env` file in the root directory of the backend project.  You can start by copying the `.env.example` file:

        ```bash
        cp .env.example .env
        ```

    *   Open the `.env` file and configure the database credentials according to your local setup.  Ensure the following variables are correctly set:

        ```
        DB_HOST=your_db_host  # e.g., database (if using Docker network), localhost, 127.0.0.1
        DB_PORT=your_db_port  # e.g., 3306
        DB_DATABASE=your_db_name
        DB_USERNAME=your_db_user
        DB_PASSWORD=your_db_password
        ```

        Replace `your_db_host`, `your_db_port`, `your_db_name`, `your_db_user`, and `your_db_password` with your actual database details.

2.  **Building and Running the Docker image:**

    *   Navigate to the root directory of the backend project in your terminal.

    *   Use the following command to build the Docker image and start the containers:

        ```bash
        docker compose -f deploy/docker-compose.yaml --env-file ./.env up --build
        ```

        *   `-f deploy/docker-compose.yml`: Specifies the path to your Docker Compose file.
        *   `--env-file ./.env`: Loads environment variables from the `.env` file.
        *   `up`: Starts the containers.
        *   `--build`: Builds the Docker image if it doesn't exist or has been modified.
        *   `-d`: Runs the containers in detached mode (background).

3.  **Accessing the Application:**

    Once the containers are running, you can access the backend application at `http://localhost:8000` (or the port you've mapped in your `docker-compose.yml` file).

4.  **Running Artisan Commands:**

    To execute Artisan commands (e.g., database migrations, seeders), you can use the following command to enter the backend container:

    ```bash
    docker exec -it <container_name_or_id> bash
    ```

    Replace `<container_name_or_id>` with the actual name or ID of your backend container. You can find the container name using `docker ps`.  Once inside the container, navigate to the `/var/www/html` directory (the application root) and run your Artisan commands as usual.

    ```bash
    cd /var/www/html
    php artisan migrate
    php artisan db:seed
    ```

5.  **Stopping the Application:**

    To stop and remove the containers, use the following command in the project's root directory:

    ```bash
    docker compose -f deploy/docker-compose.yml down
    ```

6.  **Similar Apps**

    * [Expensify](https://www.expensify.com/)

    
## License

The Payame App is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

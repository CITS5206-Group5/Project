# Get Started

## Set Up Environment Config

Add a `.env` file to `\WordPress\.env`. You can find the correct config file in Teams.

## Start the Docker daemon

Start the `Docker daemon`, such as `Docker Desktop`, on your local machine or server.

## Run and Stop the Docker

Make sure you are in the /WordPress directory, then execute the following commands in the terminal:

```shell
# run docker container
docker-compose up -d

# stop docker container
docker-compose down
```

## Start the service

After running Docker:

- You can visit the website at: http://127.0.0.1:8000/
- Or access the WordPress Admin Dashboard at: http://127.0.0.1:8000/wp-admin. Find the credentials in Teams.
- Or access the phpMyAdmin Dashboard to manage the database at: http://127.0.0.1:8001. Find the credentials in Teams.

FROM php:7.4-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli


# Install MongoDB extension for PHP
RUN apt-get update && \
    pecl install mongodb && \
    docker-php-ext-enable mongodb

# Install MongoDB client
RUN apt-get update && \
    apt-get install -y gnupg && \
    curl -fsSL https://www.mongodb.org/static/pgp/server-5.0.asc | apt-key add - && \
    echo "deb http://repo.mongodb.org/apt/debian buster/mongodb-org/5.0 main" | tee /etc/apt/sources.list.d/mongodb-org-5.0.list && \
    apt-get update && \
    apt-get install -y mongodb-org-shell mongodb-org-tools

# Copy the entire src directory into the container
COPY src /usr/src/app

# Set the working directory to the app directory
WORKDIR /usr/src/app

# Set the environment variables for the MongoDB connection
ENV MONGODB_HOST mongodb://mongo:27017
ENV MONGODB_DB mydatabase

# Start the PHP script
CMD ["php", "-S", "0.0.0.0:80", "-t", "/usr/src/app"]


# car_overview

A PHP application that scrapes car advertisements from Bilweb and stores them in a MySQL database.  
The application provides an Ajax-based search form for searching cars by brand, model year, and registration number.

## Requirements

- PHP 8.3
- MySQL/MariaDB
- Composer

## Installation

Install dependencies

```Bash
    composer install
```

Create a `.env` file based on `.env.example` and add the required database credentials.


## Usage

Create the database structure:

    php sql/sql.php

Run the scraper:

    php scraper/scraper.php

Start the application:

    php -S localhost:8080
# DateTime API Testing

![Alt text](/public/images/clock.png "Clock")

## Setup

### Clone or download
https://github.com/ianfengfb/date_time_API.git

### update composer, copy .env file and set the APP_KEY value
composer update
```
cp .env.example .env
```
php artisan key:generate
```

### Running The App
php artisan serve
```
open localhost:8000

(I have created a visilized page to make it easy to call the 3 APIs)

## File structure
### API routes and controller
API routes file is in /routes/api.php
API controller is in /App/http/Controllers/API/DateTimeAPIController.php
Meanwhile using a customized Calculator class to hold calculating functions, which located in /App/Calculator/DateTimeCalculator.php

### Views
The views contain a layout file, main content index file and a timezone selector partial file.

### Unit test
The phpUnit testing file is in /tests/Unit/CalculatorTest.php

## Visilization Usage
### Days diff calculator
Use date time picker to pick two dates and times, then click "Calculate" button, it will return a result as well as the actuall API JSON result.

### Weeks diff calculator
Use date time picker to pick two dates and times, then click "Calculate" button, it will return a result as well as the actuall API JSON result.

### Timezones compare calculator
Select two timezones, then click "Calculate" button, it will return a result as well as the actuall API JSON result.

## API call Usage
### Days diff calculator
Use Postman to make a POST request with two params of "first_date" and "second_date" with any DateTime format, it will return the result of the number of days between two parameters.

### Weeks diff calculator
Use Postman to make a POST request with two params of "first_date" and "second_date" with any DateTime format, it will return the result of the number of complete weeks between two parameters.

### Timezone compare calculator
Use Postman to make a POST request with two params of "first_timezone" and "second_timezone" with the offset of the timezone to GMT (i.e. +3 hours +50 mins), it will return the result of current time for these two timezones and the difference of hours between these two timezone.

## Unit test
using commond line:
vendor/bin/phpunit
```

Test two senarios: 
1. When providing 2 same dates (even different time) to days diff calculator, it returns a result of 0.
2. When providing 2 dates in the same week to weeks diff calculator, it returns a result of 0.

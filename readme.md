# API to NeoWs - (Near Earth Object Web Service)

## Environment

- Laravel 5.4.30
- PHP 7.1.5
- PHPUnit 6.1.4
- Composer 1.4.2

## Installation

- Rename .env.example to .env
- Fill the .env file with the app_url, database info and nasa api token information
- Run `composer install` to build Laravel packages
- Give proper permissions to the folders and sub-folders 'bootstrap/cache' and 'storage'. Run `chmod -R o+w bootstrap/cache/ storage/`
- Run migrations `php artisan migrate`

For more information, visit [https://laravel.com/docs/5.4/installation]

## Command

Type `php artisan nasa:get-offers` to retrieve the information from the last 3 days.
 
 ![Command Line](https://s3-us-west-2.amazonaws.com/carnou.com/nasa/nasa_command.png)

## Endpoints

[GET] `/neo/hazardous`

Display all entries which contain potentially hazardous asteroids

Response:
```
[
    {
        "id": 8,
        "date": "2017-07-25",
        "reference": 3080636,
        "name": "(2001 PT9)",
        "speed": 42118.8384153096,
        "is_hazardous": true
    },
    
    ...
]
````

Response Status: 200

---

[GET] `/neo/fastest`

|Arguments|Default|Expects|Comment
|:---|:---:|:---:|:---|
|hazardous|false|Boolean|Returns only the hazardous asteroids or only the non hazardous asteroid|

e.g. `/neo/fastest?hazardous=true`

Return the fastest asteroid

Response:
```
{
    "id": 17,
    "date": "2017-07-27",
    "reference": 2143992,
    "name": "143992 (2004 AF)",
    "speed": 87507.2336586466,
    "is_hazardous": true
}
````

Response Status: 200

---

[GET] `/neo/best-year`

|Arguments|Default|Expects|Comment
|:---|:---:|:---:|:---|
|hazardous|false|Boolean|Count only the hazardous asteroids or only the non hazardous asteroid|

e.g. `/neo/best-year?hazardous=true`

Return a year with most asteroids

Response:
```
{
    "count": 5,
    "year": 2017
}
````

Response Status: 200

---

[GET] `/neo/best-month`

|Arguments|Default|Expects|Comment
|:---|:---:|:---:|:---|
|hazardous|false|Boolean|Count only the hazardous asteroids or only the non hazardous asteroid|

e.g. `/neo/best-month?hazardous=true`

Return a month with most asteroids (not a month in a year)

Response:
```
{
    "count": 5,
    "month": 7
}
````

Response Status: 200

## Tests

- Be sure that you url (APP_URL) are set on .env file
- You should have a table called nasa_test with same credentials are your main table. If you want to change this information, update the phpunit.xml
- Run `phpunit` on root directory

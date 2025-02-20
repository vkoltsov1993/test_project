## Before starting containers, make sure that 8080 is available, otherwise you should change port in docker-compose and .env file for APP_URL
current url is http://localhost:8080

>Start containers
>> docker-compose up -d
> 
> Service's containers:
>> - nginx
>> - php
>> - mysql
>> - mailhog: local SMTP server (url http://localhost:8025) 

## !!! Migrate the first !!!
>Run command in console after containers have been started
>> docker exec test_project_php bash -c "php artisan migrate --seed"

### Add product to subscription
>url:
>> http://localhost:8080/api/olx
>
> method
>> POST
>
> headers
>>Accept: application/json
>
Example:
```json
{
    "url": "[url]",
    "email": "test@example.com"
}
```

### Get all products
>url:
>> http://localhost:8080/api/products
>
> method
>> GET
>
> headers
>>Accept: application/json


## How to

There are commands to work with project. You don't need to interact with
queue, (like restart or starting them), everything works via supervisor in 
docker container. Also, you don't need to go to container, just copy and start
these commands in the root of project.

> ### Updated price for product by id:
>> docker exec test_project_php bash -c "php artisan product-set-price --id=1 --price=10"

> ### Starts a job for checking if product price has changed:
>> docker exec test_project_php bash -c "php artisan check-price"

> ### Database seeder seeds two users with next emails: 
> - test@example.com (verified)
> - test_non_verified@example.com (non-verified)
> #### If email isn't verified, it won't get notification about changing price.
> To send email to verify user, use command below:
>> docker exec test_project_php bash -c "php artisan verify --email=test_non_verified@example.com"
>> 
> It will make email non-verified and send verification each call





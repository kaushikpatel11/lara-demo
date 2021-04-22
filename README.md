<!-- START_SETUP -->
# Setup

1- Composer install

2- Add .env file

3- Create empty database and replace DB_DATABASE= [database name] in .env

4- Run: php artisan migrate 

5- Download and unzip Elasticsearch through https://www.elastic.co/downloads/elasticsearch

6- Run bin/elasticsearch (or bin\elasticsearch.bat on Windows)  to run elastic server

7- Run curl -X PUT "localhost:9200/demo-bands?pretty"  to create elastic index named "demo-bands"

8- Replace ELASTIC_INDEX= to ELASTIC_INDEX= demo-bands in .env

9- Run php artisan serve

<!-- END_SETUP -->
<!-- START_INFO -->
# Info

API Documentation
<!-- END_INFO -->

#About


<!-- START_604ce57fbb4fa56e5a508102af765f85 -->
## api/about/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/about/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/about/list`


<!-- END_604ce57fbb4fa56e5a508102af765f85 -->

<!-- START_1f26a7d3b191a04ab9c1bc160deb8481 -->
## api/about
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/about", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "ABOUT_CREATED",
    "user_message": "Your about has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/about`


<!-- END_1f26a7d3b191a04ab9c1bc160deb8481 -->

<!-- START_8af6af947e563afdfd1096f96f1ac74d -->
## api/about/{about}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/about/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/about/{about}`


<!-- END_8af6af947e563afdfd1096f96f1ac74d -->

<!-- START_da16f7bce00b004904ce6976947a41de -->
## api/about/{about}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/about/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "ABOUT_UPDATED",
    "user_message": "Your about has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/about/{about}`

`PATCH api/about/{about}`


<!-- END_da16f7bce00b004904ce6976947a41de -->

<!-- START_c9935bdf6a25a73ff2bfbd58dde233aa -->
## api/about/{about}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/about/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/about/{about}`


<!-- END_c9935bdf6a25a73ff2bfbd58dde233aa -->

#Address


<!-- START_957e834efac9e3a5d2ae31e5e6b61f55 -->
## Display a listing of the resource.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/address/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/address/list`


<!-- END_957e834efac9e3a5d2ae31e5e6b61f55 -->

#Band


<!-- START_831fd2eb1ddb07086831f6ff76fbc47a -->
## api/bands/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/bands/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "BAND_DETAILS",
    "user_message": "Here is your band.",
    "page": 1,
    "items_per_page": 10,
    "total_items": 54,
    "items": [
        {
            "id": 163,
            "name": "Linkin Park",
            "price_from": 200,
            "price_to": 300,
            "created_by": {
                "id": 4,
                "email": "michael.magdy1994@coformatique.com",
                "fname": "Michaelll",
                "lname": "Magdy",
                "phone_number": "01225050804",
                "role": "ADMIN",
                "created_at": 1563385356,
                "photo": {
                    "id": 25,
                    "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/che.jpg",
                    "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/che.jpg"
                }
            },
            "rating": "0.0",
            "size": 2,
            "isFavorite": false,
            "genres": [
                {
                    "id": 7,
                    "title": "Housee"
                },
                {
                    "id": 10,
                    "title": "Edmmm"
                }
            ],
            "photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "header_photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "hospitality_and_production_rider": null,
            "state": null
        },
        {
            "id": 162,
            "name": "Linkin Park",
            "price_from": 200,
            "price_to": 300,
            "created_by": {
                "id": 4,
                "email": "michael.magdy1994@coformatique.com",
                "fname": "Michaelll",
                "lname": "Magdy",
                "phone_number": "01225050804",
                "role": "ADMIN",
                "created_at": 1563385356,
                "photo": {
                    "id": 25,
                    "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/che.jpg",
                    "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/che.jpg"
                }
            },
            "rating": "0.0",
            "size": 2,
            "isFavorite": false,
            "genres": [
                {
                    "id": 1,
                    "title": "Rock"
                },
                {
                    "id": 2,
                    "title": "EDM"
                }
            ],
            "photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "header_photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "hospitality_and_production_rider": null,
            "state": null
        },
        {
            "id": 161,
            "name": "Linkin Park",
            "price_from": 200,
            "price_to": 300,
            "created_by": {
                "id": 4,
                "email": "michael.magdy1994@coformatique.com",
                "fname": "Michaelll",
                "lname": "Magdy",
                "phone_number": "01225050804",
                "role": "ADMIN",
                "created_at": 1563385356,
                "photo": {
                    "id": 25,
                    "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/che.jpg",
                    "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/che.jpg"
                }
            },
            "rating": "0.0",
            "size": 2,
            "isFavorite": false,
            "genres": [
                {
                    "id": 1,
                    "title": "Rock"
                },
                {
                    "id": 2,
                    "title": "EDM"
                }
            ],
            "photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "header_photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "hospitality_and_production_rider": null,
            "state": null
        },
        {
            "id": 160,
            "name": "Linkin Park",
            "price_from": 200,
            "price_to": 300,
            "created_by": {
                "id": 2,
                "email": "sandra.soliman@coformatique.com",
                "fname": "Sandra",
                "lname": "Soliman",
                "phone_number": "01225050",
                "role": "demo",
                "created_at": 1563383304,
                "photo": {
                    "id": 777,
                    "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/OrangeImage.jpg",
                    "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/OrangeImage.jpg"
                }
            },
            "rating": "0.0",
            "size": 2,
            "isFavorite": false,
            "genres": [
                {
                    "id": 1,
                    "title": "Rock"
                },
                {
                    "id": 2,
                    "title": "EDM"
                }
            ],
            "photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "header_photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "hospitality_and_production_rider": null,
            "state": null
        },
        {
            "id": 159,
            "name": "Linkin Park",
            "price_from": 200,
            "price_to": 300,
            "created_by": {
                "id": 4,
                "email": "michael.magdy1994@coformatique.com",
                "fname": "Michaelll",
                "lname": "Magdy",
                "phone_number": "01225050804",
                "role": "ADMIN",
                "created_at": 1563385356,
                "photo": {
                    "id": 25,
                    "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/che.jpg",
                    "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/che.jpg"
                }
            },
            "rating": "0.0",
            "size": 2,
            "isFavorite": false,
            "genres": [
                {
                    "id": 1,
                    "title": "Rock"
                },
                {
                    "id": 2,
                    "title": "EDM"
                }
            ],
            "photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "header_photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "hospitality_and_production_rider": null,
            "state": null
        },
        {
            "id": 158,
            "name": "Linkin Park",
            "price_from": 200,
            "price_to": 300,
            "created_by": {
                "id": 4,
                "email": "michael.magdy1994@coformatique.com",
                "fname": "Michaelll",
                "lname": "Magdy",
                "phone_number": "01225050804",
                "role": "ADMIN",
                "created_at": 1563385356,
                "photo": {
                    "id": 25,
                    "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/che.jpg",
                    "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/che.jpg"
                }
            },
            "rating": "0.0",
            "size": 2,
            "isFavorite": false,
            "genres": [
                {
                    "id": 1,
                    "title": "Rock"
                },
                {
                    "id": 2,
                    "title": "EDM"
                }
            ],
            "photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "header_photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "hospitality_and_production_rider": null,
            "state": null
        },
        {
            "id": 157,
            "name": "Linkin Park",
            "price_from": 200,
            "price_to": 300,
            "created_by": {
                "id": 4,
                "email": "michael.magdy1994@coformatique.com",
                "fname": "Michaelll",
                "lname": "Magdy",
                "phone_number": "01225050804",
                "role": "ADMIN",
                "created_at": 1563385356,
                "photo": {
                    "id": 25,
                    "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/che.jpg",
                    "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/che.jpg"
                }
            },
            "rating": "0.0",
            "size": 2,
            "isFavorite": false,
            "genres": [
                {
                    "id": 1,
                    "title": "Rock"
                },
                {
                    "id": 2,
                    "title": "EDM"
                }
            ],
            "photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "header_photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "hospitality_and_production_rider": null,
            "state": null
        },
        {
            "id": 156,
            "name": "Linkin Park",
            "price_from": 200,
            "price_to": 300,
            "created_by": {
                "id": 4,
                "email": "michael.magdy1994@coformatique.com",
                "fname": "Michaelll",
                "lname": "Magdy",
                "phone_number": "01225050804",
                "role": "ADMIN",
                "created_at": 1563385356,
                "photo": {
                    "id": 25,
                    "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/che.jpg",
                    "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/che.jpg"
                }
            },
            "rating": "0.0",
            "size": 2,
            "isFavorite": false,
            "genres": [
                {
                    "id": 1,
                    "title": "Rock"
                },
                {
                    "id": 2,
                    "title": "EDM"
                }
            ],
            "photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "header_photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "hospitality_and_production_rider": null,
            "state": null
        },
        {
            "id": 155,
            "name": "Linkin Park",
            "price_from": 200,
            "price_to": 300,
            "created_by": {
                "id": 4,
                "email": "michael.magdy1994@coformatique.com",
                "fname": "Michaelll",
                "lname": "Magdy",
                "phone_number": "01225050804",
                "role": "ADMIN",
                "created_at": 1563385356,
                "photo": {
                    "id": 25,
                    "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/che.jpg",
                    "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/che.jpg"
                }
            },
            "rating": "0.0",
            "size": 2,
            "isFavorite": false,
            "genres": [
                {
                    "id": 1,
                    "title": "Rock"
                },
                {
                    "id": 2,
                    "title": "EDM"
                }
            ],
            "photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "header_photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "hospitality_and_production_rider": null,
            "state": null
        },
        {
            "id": 154,
            "name": "Linkin Park",
            "price_from": 200,
            "price_to": 300,
            "created_by": {
                "id": 4,
                "email": "michael.magdy1994@coformatique.com",
                "fname": "Michaelll",
                "lname": "Magdy",
                "phone_number": "01225050804",
                "role": "ADMIN",
                "created_at": 1563385356,
                "photo": {
                    "id": 25,
                    "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/che.jpg",
                    "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/che.jpg"
                }
            },
            "rating": "0.0",
            "size": 2,
            "isFavorite": false,
            "genres": [
                {
                    "id": 1,
                    "title": "Rock"
                },
                {
                    "id": 2,
                    "title": "EDM"
                }
            ],
            "photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "header_photo": {
                "id": 23,
                "thumbnail": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/thumbnails\/armin.jpg",
                "url": "https:\/\/s3.us-east-2.amazonaws.com\/demo-dev\/armin.jpg"
            },
            "hospitality_and_production_rider": null,
            "state": null
        }
    ]
}
```

### HTTP Request
`POST api/bands/list`


<!-- END_831fd2eb1ddb07086831f6ff76fbc47a -->

<!-- START_81de2c8f7b8ce6d5994f085572e428d8 -->
## api/my-bands/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/my-bands/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/my-bands/list`


<!-- END_81de2c8f7b8ce6d5994f085572e428d8 -->

<!-- START_9815bcfa86ba0de7ea1ae4b6be0bb465 -->
## api/pending-bands/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/pending-bands/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/pending-bands/list`


<!-- END_9815bcfa86ba0de7ea1ae4b6be0bb465 -->

<!-- START_efcf830d91fa367094f091741cb37bed -->
## api/band/update-status/{band}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/band/update-status/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/band/update-status/{band}`


<!-- END_efcf830d91fa367094f091741cb37bed -->

<!-- START_1814123ab9d14219a9a96024e46e739c -->
## api/band-favorite/{band}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/band-favorite/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/band-favorite/{band}`


<!-- END_1814123ab9d14219a9a96024e46e739c -->

<!-- START_9ac73aa8169b1e89b10e9fb5bff74710 -->
## api/bands
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/bands", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "BAND_CREATED",
    "user_message": "Your band has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/bands`


<!-- END_9ac73aa8169b1e89b10e9fb5bff74710 -->

<!-- START_9cd05a7c81d3c8211b71e4b53ced5551 -->
## Display the specified resource.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/bands/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/bands/{band}`


<!-- END_9cd05a7c81d3c8211b71e4b53ced5551 -->

<!-- START_b723bb8dded5128c13a5d059db12c014 -->
## api/bands/{band}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/bands/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "BAND_UPDATED",
    "user_message": "Your band has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/bands/{band}`

`PATCH api/bands/{band}`


<!-- END_b723bb8dded5128c13a5d059db12c014 -->

<!-- START_a6fd2f651677a2b03cd7c4253723e675 -->
## Remove the specified resource from storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/bands/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/bands/{band}`


<!-- END_a6fd2f651677a2b03cd7c4253723e675 -->

<!-- START_82cd7a178fe9db5d6198991c866ae3bc -->
## api/bands/favorite
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/bands/favorite", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "FAVORITE_ADDED",
    "user_message": "Band added to favorite successfully."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/bands/favorite`


<!-- END_82cd7a178fe9db5d6198991c866ae3bc -->

<!-- START_7567101ac309564be2c7693908b4293e -->
## api/list/favorite
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/list/favorite", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/list/favorite`


<!-- END_7567101ac309564be2c7693908b4293e -->

<!-- START_d1e4d044a92ca2984ab69f6bd715d5c6 -->
## api/bands/remove-favorite
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/bands/remove-favorite", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "FAVORITE_REMOVED",
    "user_message": "Band removed from favorite successfully."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/bands/remove-favorite`


<!-- END_d1e4d044a92ca2984ab69f6bd715d5c6 -->

<!-- START_20d2bee12202f79c5e87119026963cdc -->
## api/search/find
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/search/find", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/search/find`


<!-- END_20d2bee12202f79c5e87119026963cdc -->

<!-- START_ab6e059fc24321920a9fef97a7e8d3be -->
## api/bands/featured
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/bands/featured", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/bands/featured`


<!-- END_ab6e059fc24321920a9fef97a7e8d3be -->

<!-- START_bb4839357a8de1048b363be4ec10db0a -->
## api/bands/remove-featured
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/bands/remove-featured", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/bands/remove-featured`


<!-- END_bb4839357a8de1048b363be4ec10db0a -->

<!-- START_e75396b2c86d2a8b96ab6e98d5b20469 -->
## api/search/find-guest
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/search/find-guest", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/search/find-guest`


<!-- END_e75396b2c86d2a8b96ab6e98d5b20469 -->

<!-- START_4bd993fc5b402966a3708c8485b46112 -->
## api/search/price-list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/search/price-list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/search/price-list`


<!-- END_4bd993fc5b402966a3708c8485b46112 -->

<!-- START_a42cde08a2dc70890d2b511248ce7f29 -->
## api/list/featured
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/list/featured", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/list/featured`


<!-- END_a42cde08a2dc70890d2b511248ce7f29 -->

<!-- START_f4954c582a2b0237ee3daae4655b8064 -->
## api/search/re-index
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/search/re-index", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/search/re-index`


<!-- END_f4954c582a2b0237ee3daae4655b8064 -->

#Benefit


<!-- START_8f51381bc0936bfc5771154222fe2bfd -->
## api/benefits/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/benefits/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/benefits/list`


<!-- END_8f51381bc0936bfc5771154222fe2bfd -->

<!-- START_e601c783e9d64fdb175e7809e16ae3fb -->
## api/benefits
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/benefits", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "BENEFIT_CREATED",
    "user_message": "Your benefit has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/benefits`


<!-- END_e601c783e9d64fdb175e7809e16ae3fb -->

<!-- START_65783550fae297b34acba87b1cb38809 -->
## api/benefits/{benefit}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/benefits/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/benefits/{benefit}`


<!-- END_65783550fae297b34acba87b1cb38809 -->

<!-- START_bde96a463a6fa582285accc308ad46e1 -->
## api/benefits/{benefit}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/benefits/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "BENEFIT_UPDATED",
    "user_message": "Your benefit has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/benefits/{benefit}`

`PATCH api/benefits/{benefit}`


<!-- END_bde96a463a6fa582285accc308ad46e1 -->

<!-- START_f20234610ff8fb4a11ac9df0b9898e81 -->
## api/benefits/{benefit}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/benefits/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/benefits/{benefit}`


<!-- END_f20234610ff8fb4a11ac9df0b9898e81 -->

#Booker Types


<!-- START_674f4037c67dc602c3342573c5a87609 -->
## api/booker-types/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/booker-types/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/booker-types/list`


<!-- END_674f4037c67dc602c3342573c5a87609 -->

<!-- START_a2ed66038684f0c79377e96d3a72192a -->
## api/booker-types
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/booker-types", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "BOOKER_CREATED",
    "user_message": "Your booker type has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/booker-types`


<!-- END_a2ed66038684f0c79377e96d3a72192a -->

<!-- START_5732ac8de068f5e0c1c053d590bfa80a -->
## api/booker-types/{booker_type}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/booker-types/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/booker-types/{booker_type}`


<!-- END_5732ac8de068f5e0c1c053d590bfa80a -->

<!-- START_34a35a8332ca5185627d45e00b6dd3b2 -->
## api/booker-types/{booker_type}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/booker-types/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "BOOKER_UPDATED",
    "user_message": "Your booker type has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/booker-types/{booker_type}`

`PATCH api/booker-types/{booker_type}`


<!-- END_34a35a8332ca5185627d45e00b6dd3b2 -->

<!-- START_7cae542927a852071d0cb64c173100dd -->
## api/booker-types/{booker_type}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/booker-types/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/booker-types/{booker_type}`


<!-- END_7cae542927a852071d0cb64c173100dd -->

#Events


<!-- START_46d4540afdd7ca6695ca68a5ea035e43 -->
## api/events/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/events/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/events/list`


<!-- END_46d4540afdd7ca6695ca68a5ea035e43 -->

<!-- START_9c1ecd07bbbcce53134e1b16857ad5f5 -->
## api/my-events/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/my-events/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/my-events/list`


<!-- END_9c1ecd07bbbcce53134e1b16857ad5f5 -->

<!-- START_25023302b468fdcd34aa349ae1dafc40 -->
## api/events/duplicate
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/events/duplicate", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/events/duplicate`


<!-- END_25023302b468fdcd34aa349ae1dafc40 -->

<!-- START_ad02498a71100e4a3a637b8a29be3e51 -->
## api/past-events/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/past-events/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/past-events/list`


<!-- END_ad02498a71100e4a3a637b8a29be3e51 -->

<!-- START_7bb960f8afea25778ba0d9e1323bfdc9 -->
## api/event/history/{event}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/event/history/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/event/history/{event}`


<!-- END_7bb960f8afea25778ba0d9e1323bfdc9 -->

<!-- START_d9bdaa70248a661731ed8259818b7cec -->
## api/talent-event/history/{event}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/talent-event/history/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/talent-event/history/{event}`


<!-- END_d9bdaa70248a661731ed8259818b7cec -->

<!-- START_de3413bf02c9bb71627fa96e1c1c409f -->
## api/events
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/events", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "EVENT_CREATED",
    "user_message": "Your event has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/events`


<!-- END_de3413bf02c9bb71627fa96e1c1c409f -->

<!-- START_379a3beb17bbb91528d80d8507f69655 -->
## Display the specified resource.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/events/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/events/{event}`


<!-- END_379a3beb17bbb91528d80d8507f69655 -->

<!-- START_d16967fd1d3d935666f7e8112a1a4451 -->
## api/events/{event}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/events/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "EVENT_UPDATED",
    "user_message": "Your event has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/events/{event}`

`PATCH api/events/{event}`


<!-- END_d16967fd1d3d935666f7e8112a1a4451 -->

<!-- START_379a30feb2949828b5f95efbfd7649c3 -->
## Remove the specified resource from storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/events/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/events/{event}`


<!-- END_379a30feb2949828b5f95efbfd7649c3 -->

#FAQ


<!-- START_b850ae0b9406a9b213a9d360bc0812e5 -->
## api/faqs/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/faqs/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/faqs/list`


<!-- END_b850ae0b9406a9b213a9d360bc0812e5 -->

<!-- START_bdf206106bbdc6975a4c6c99cc1640ee -->
## api/faqs
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/faqs", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "FAQ_CREATED",
    "user_message": "Your FAQ has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/faqs`


<!-- END_bdf206106bbdc6975a4c6c99cc1640ee -->

<!-- START_139501a554143ddf1d08122c6043e431 -->
## api/faqs/{faq}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/faqs/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/faqs/{faq}`


<!-- END_139501a554143ddf1d08122c6043e431 -->

<!-- START_6ae49de1fc76bfd96fc398623ca385ad -->
## api/faqs/{faq}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/faqs/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "FAQ_UPDATED",
    "user_message": "Your FAQ has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/faqs/{faq}`

`PATCH api/faqs/{faq}`


<!-- END_6ae49de1fc76bfd96fc398623ca385ad -->

<!-- START_bbb2530890ef3740181c9035e931a44b -->
## api/faqs/{faq}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/faqs/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/faqs/{faq}`


<!-- END_bbb2530890ef3740181c9035e931a44b -->

#Genre


<!-- START_83dd9e3c58a7cd0a02d3ea29a6bc8e15 -->
## api/genres/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/genres/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/genres/list`


<!-- END_83dd9e3c58a7cd0a02d3ea29a6bc8e15 -->

<!-- START_00052e6270b72656ec67de26f23b1c76 -->
## api/genres
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/genres", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "GENRE_CREATED",
    "user_message": "Your genre has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/genres`


<!-- END_00052e6270b72656ec67de26f23b1c76 -->

<!-- START_9cfd06f3f722f6e4a3a0b63ff8c0ac39 -->
## api/genres/{genre}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/genres/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/genres/{genre}`


<!-- END_9cfd06f3f722f6e4a3a0b63ff8c0ac39 -->

<!-- START_13c5109913e190d460b72e1b5d84b622 -->
## api/genres/{genre}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/genres/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "GENRE_UPDATED",
    "user_message": "Your genre has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/genres/{genre}`

`PATCH api/genres/{genre}`


<!-- END_13c5109913e190d460b72e1b5d84b622 -->

<!-- START_945557d0f4c4606c5660b30e2e6635e5 -->
## api/genres/{genre}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/genres/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/genres/{genre}`


<!-- END_945557d0f4c4606c5660b30e2e6635e5 -->

#Gig


<!-- START_da83318ae8773e8d5ee22fe2b5fab039 -->
## Display a listing of the resource.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/gigs/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/gigs/list`


<!-- END_da83318ae8773e8d5ee22fe2b5fab039 -->

<!-- START_80a0c3b1c719cb1603f428192a530dd6 -->
## api/gigs
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/gigs", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "GIG_CREATED",
    "user_message": "Your gig has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/gigs`


<!-- END_80a0c3b1c719cb1603f428192a530dd6 -->

<!-- START_b53217610e86e6b5b5502b5c79dfa72b -->
## api/gigs/{gig}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/gigs/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "GIG_UPDATED",
    "user_message": "Your gig has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/gigs/{gig}`

`PATCH api/gigs/{gig}`


<!-- END_b53217610e86e6b5b5502b5c79dfa72b -->

<!-- START_6ec21f5b654cbd6ada2f5ecf6743a8d5 -->
## Remove the specified resource from storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/gigs/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/gigs/{gig}`


<!-- END_6ec21f5b654cbd6ada2f5ecf6743a8d5 -->

#How it Works


<!-- START_9911db7ecd857bcb272077771dc2511c -->
## api/how-it-works/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/how-it-works/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/how-it-works/list`


<!-- END_9911db7ecd857bcb272077771dc2511c -->

<!-- START_3cd6862ccb492b23e741bf12939afe5b -->
## api/how-it-works
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/how-it-works", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "HOW_IT_WORKS_CREATED",
    "user_message": "Your how it works has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/how-it-works`


<!-- END_3cd6862ccb492b23e741bf12939afe5b -->

<!-- START_57a607723b972bbe0d282e70245c40c4 -->
## api/how-it-works/{how_it_work}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/how-it-works/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/how-it-works/{how_it_work}`


<!-- END_57a607723b972bbe0d282e70245c40c4 -->

<!-- START_f764990220d22f214b68b5f19b0439cd -->
## api/how-it-works/{how_it_work}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/how-it-works/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "HOW_IT_WORKS_UPDATED",
    "user_message": "Your how it work has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/how-it-works/{how_it_work}`

`PATCH api/how-it-works/{how_it_work}`


<!-- END_f764990220d22f214b68b5f19b0439cd -->

<!-- START_a9057833a4beeba33adf98daaa38253f -->
## api/how-it-works/{how_it_work}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/how-it-works/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/how-it-works/{how_it_work}`


<!-- END_a9057833a4beeba33adf98daaa38253f -->

#Media Upload


<!-- START_12478023825b53fc59502a172b258ec9 -->
## api/media/upload
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/media/upload", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "MEDIA_UPLOADED",
    "user_message": "Your media has been uploaded."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/media/upload`


<!-- END_12478023825b53fc59502a172b258ec9 -->

<!-- START_bbc11ca59bd204d0cb8ec7dcecae7eab -->
## api/media/upload-file
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/media/upload-file", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/media/upload-file`


<!-- END_bbc11ca59bd204d0cb8ec7dcecae7eab -->

#Messages


<!-- START_35df1f44031ea96b6e03eca6e38ceda7 -->
## Store a newly created resource in storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/messages", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/messages`


<!-- END_35df1f44031ea96b6e03eca6e38ceda7 -->

#Payment


<!-- START_53a4d76b6c2d61dd018c0b4542eee56d -->
## api/stripe/deposit
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/stripe/deposit", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/stripe/deposit`


<!-- END_53a4d76b6c2d61dd018c0b4542eee56d -->

<!-- START_b6aa840e9faf8acbe9e50b3f3c80a052 -->
## api/stripe/remainder
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/stripe/remainder", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/stripe/remainder`


<!-- END_b6aa840e9faf8acbe9e50b3f3c80a052 -->

<!-- START_5713e65535786d941c2693d4953e9134 -->
## api/payment/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/payment/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/payment/list`


<!-- END_5713e65535786d941c2693d4953e9134 -->

<!-- START_f3b297fbb1847f0c66cdd80ddb788934 -->
## api/payment/show/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/payment/show/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/payment/show/{id}`


<!-- END_f3b297fbb1847f0c66cdd80ddb788934 -->

#Production Equipments


<!-- START_e40a7384f7e1e435913feca8c7262c65 -->
## Display a listing of the resource.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/equipments/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/equipments/list`


<!-- END_e40a7384f7e1e435913feca8c7262c65 -->

<!-- START_cf5e1cd7fcc33486bf280d94524afd7e -->
## api/equipments
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/equipments", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "EQUIPMENT_CREATED",
    "user_message": "Your production equipment has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/equipments`


<!-- END_cf5e1cd7fcc33486bf280d94524afd7e -->

<!-- START_bd8ab0c9a24c0ccf124c0fffa6c486f3 -->
## api/equipments/{equipment}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/equipments/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "EQUIPMENT_UPDATED",
    "user_message": "Your production equipment has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/equipments/{equipment}`

`PATCH api/equipments/{equipment}`


<!-- END_bd8ab0c9a24c0ccf124c0fffa6c486f3 -->

<!-- START_d1cea57e51273b4f1a0d9920e82d6982 -->
## Remove the specified resource from storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/equipments/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/equipments/{equipment}`


<!-- END_d1cea57e51273b4f1a0d9920e82d6982 -->

#Request Bands


<!-- START_e8f18ebf8ad66470a6cc7cdafef3d2d9 -->
## api/events/requests
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/events/requests", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/events/requests`


<!-- END_e8f18ebf8ad66470a6cc7cdafef3d2d9 -->

<!-- START_74c22d29f4a6658b4e444bcefae18b3c -->
## api/events/requests/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/events/requests/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "STATUS_UPDATED",
    "user_message": "your booking status has been changed."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/events/requests/{id}`


<!-- END_74c22d29f4a6658b4e444bcefae18b3c -->

<!-- START_d03a44c4713edbddce8a59821d1afc99 -->
## api/event-request-lastseen/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/event-request-lastseen/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "LAST_SEEN_UPDATED",
    "user_message": "Your last seen time has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/event-request-lastseen/{id}`


<!-- END_d03a44c4713edbddce8a59821d1afc99 -->

<!-- START_ee785d32c3e103a8a55430ac3bba26d7 -->
## api/event-request/list/{event}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/event-request/list/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/event-request/list/{event}`


<!-- END_ee785d32c3e103a8a55430ac3bba26d7 -->

<!-- START_c217f8ff1f98202e942cdcb4f67def7f -->
## api/active/talent-request/{band}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/active/talent-request/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/active/talent-request/{band}`


<!-- END_c217f8ff1f98202e942cdcb4f67def7f -->

<!-- START_54863af68a798d5e5f12e05ed7469109 -->
## api/past/talent-request/{bandId}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/past/talent-request/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/past/talent-request/{bandId}`


<!-- END_54863af68a798d5e5f12e05ed7469109 -->

<!-- START_12a6b91af1678e64908fd82ca10fe6a8 -->
## api/all-requests/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/all-requests/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/all-requests/list`


<!-- END_12a6b91af1678e64908fd82ca10fe6a8 -->

<!-- START_7e24ed31513c1f865b645f4a73d9ca93 -->
## api/events/request-band
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/events/request-band", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "EVENT_REQUEST_CREATED",
    "user_message": "Your event request has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/events/request-band`


<!-- END_7e24ed31513c1f865b645f4a73d9ca93 -->

<!-- START_eddc72f023bd61aaa10968cfe70a27a0 -->
## Display the specified resource.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/events/request-band/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/events/request-band/{request_band}`


<!-- END_eddc72f023bd61aaa10968cfe70a27a0 -->

<!-- START_4321245bf3cc12ff2b1d55cbedca564d -->
## api/events/request-band/{request_band}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/events/request-band/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "EVENT_REQUESTS_UPDATED",
    "user_message": "Your event requests have been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/events/request-band/{request_band}`

`PATCH api/events/request-band/{request_band}`


<!-- END_4321245bf3cc12ff2b1d55cbedca564d -->

<!-- START_7eb362ace778047b7092afb94bc8e8d8 -->
## Remove the specified resource from storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/events/request-band/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/events/request-band/{request_band}`


<!-- END_7eb362ace778047b7092afb94bc8e8d8 -->

<!-- START_96c63779efdc102d33f8a01c8fdcca40 -->
## api/event/request-details/{id}/{token}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/event/request-details/1/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/event/request-details/{id}/{token}`


<!-- END_96c63779efdc102d33f8a01c8fdcca40 -->

<!-- START_2654bb74216aab4ae4f970c00364a0ac -->
## api/request/schedule
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/request/schedule", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/request/schedule`


<!-- END_2654bb74216aab4ae4f970c00364a0ac -->

<!-- START_a5925a6125f6000f4b31847bbf51e5ee -->
## api/request/remainder-schedule
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/request/remainder-schedule", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/request/remainder-schedule`


<!-- END_a5925a6125f6000f4b31847bbf51e5ee -->

<!-- START_a7a9dca804d19bfa50e1d1310cb80c59 -->
## api/report/request
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/report/request", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/report/request`


<!-- END_a7a9dca804d19bfa50e1d1310cb80c59 -->

<!-- START_97dcd77ba9bd33d9b3b15d0339bd8e30 -->
## api/requests/availableStatuses
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/requests/availableStatuses", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/requests/availableStatuses`


<!-- END_97dcd77ba9bd33d9b3b15d0339bd8e30 -->

<!-- START_ff29faa6b82d818f456c53aad1241f92 -->
## api/event/test/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/event/test/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/event/test/{id}`


<!-- END_ff29faa6b82d818f456c53aad1241f92 -->

#States


<!-- START_26d342365acb50bb45b872638798b0cb -->
## Display a listing of the resource.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/states/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/states/list`


<!-- END_26d342365acb50bb45b872638798b0cb -->

<!-- START_ffed20ac697f7f3d722da0a146ed9832 -->
## api/states
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/states", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "STATE_CREATED",
    "user_message": "Your state has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/states`


<!-- END_ffed20ac697f7f3d722da0a146ed9832 -->

<!-- START_2f43950819814042c8834b156a282645 -->
## api/states/{state}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/states/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "STATE_UPDATED",
    "user_message": "Your state has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/states/{state}`

`PATCH api/states/{state}`


<!-- END_2f43950819814042c8834b156a282645 -->

<!-- START_f37f035604a29fc931476b03b5b176e6 -->
## Remove the specified resource from storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/states/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/states/{state}`


<!-- END_f37f035604a29fc931476b03b5b176e6 -->

#Terms


<!-- START_e484724e04b5c16caab6b33c8791c57c -->
## api/term/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/term/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/term/list`


<!-- END_e484724e04b5c16caab6b33c8791c57c -->

<!-- START_13719eb8d54a4742aea4c764432ed2ab -->
## api/term
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/term", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "TERM_CREATED",
    "user_message": "Your terms has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/term`


<!-- END_13719eb8d54a4742aea4c764432ed2ab -->

<!-- START_ce901de729656d6daad15eb6c11de0d6 -->
## api/term/{term}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/term/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/term/{term}`


<!-- END_ce901de729656d6daad15eb6c11de0d6 -->

<!-- START_f47fe5e59dbbb61b0576b47a5ad20dc9 -->
## api/term/{term}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/term/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "TERM_UPDATED",
    "user_message": "Your term has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/term/{term}`

`PATCH api/term/{term}`


<!-- END_f47fe5e59dbbb61b0576b47a5ad20dc9 -->

<!-- START_9c8c53b0abb3dd73c78b24b86b059e2d -->
## api/term/{term}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/term/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/term/{term}`


<!-- END_9c8c53b0abb3dd73c78b24b86b059e2d -->

#Users


<!-- START_899aa305081befc17fbb57a72f6fb1f1 -->
## details api

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/users/details", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/users/details`


<!-- END_899aa305081befc17fbb57a72f6fb1f1 -->

<!-- START_c711a3fd03a3b31d36622798a3875893 -->
## api/users/booker
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/users/booker", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "BOOKER_PROFILE_UPDATED",
    "user_message": "Your profile has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/users/booker`


<!-- END_c711a3fd03a3b31d36622798a3875893 -->

<!-- START_a8c685ac8ab98f7b90a33bb1c01c9c55 -->
## api/users/change-password
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/users/change-password", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/users/change-password`


<!-- END_a8c685ac8ab98f7b90a33bb1c01c9c55 -->

<!-- START_5a8822cfcc11467a2fa7c3145a685d31 -->
## api/users/change-email
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/users/change-email", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/users/change-email`


<!-- END_5a8822cfcc11467a2fa7c3145a685d31 -->

<!-- START_cb0965cc8359550f58c4bc0e7eb7098e -->
## api/users/notification
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/users/notification", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/users/notification`


<!-- END_cb0965cc8359550f58c4bc0e7eb7098e -->

<!-- START_4e4642fc07b39dedf7fafaac580138b9 -->
## api/users/list-notification
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/users/list-notification", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/users/list-notification`


<!-- END_4e4642fc07b39dedf7fafaac580138b9 -->

<!-- START_65e305bcc35db2ec3dff8c94a4fb5660 -->
## api/users/signout
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/users/signout", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/users/signout`


<!-- END_65e305bcc35db2ec3dff8c94a4fb5660 -->

<!-- START_abe72f69d9518d548833af5ea992ad47 -->
## api/users/information
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/users/information", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/users/information`


<!-- END_abe72f69d9518d548833af5ea992ad47 -->

<!-- START_21ff1203a9357ffbb000ef4dd551dfd3 -->
## login api

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/users/login", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/users/login`


<!-- END_21ff1203a9357ffbb000ef4dd551dfd3 -->

<!-- START_50e88084afe5ea353f89c5feae6f146d -->
## Register api

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/users/signup", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/users/signup`


<!-- END_50e88084afe5ea353f89c5feae6f146d -->

<!-- START_8b3c4040694167042175adea2ec9fe9a -->
## api/users/forgot-password
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/users/forgot-password", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/users/forgot-password`


<!-- END_8b3c4040694167042175adea2ec9fe9a -->

<!-- START_3b142594f7633555ef73e4e96f1ae49d -->
## api/users/reset-password
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/users/reset-password", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/users/reset-password`


<!-- END_3b142594f7633555ef73e4e96f1ae49d -->

<!-- START_9743ed05105b05bb54ced3b6e88777bf -->
## api/confirm-account
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/confirm-account", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/confirm-account`


<!-- END_9743ed05105b05bb54ced3b6e88777bf -->

<!-- START_19034d178d517f778500391b60bc6650 -->
## api/users/resend-verification
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/users/resend-verification", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/users/resend-verification`


<!-- END_19034d178d517f778500391b60bc6650 -->

<!-- START_6f4b338330b86e8e7cd9d504e55a3f1d -->
## api/user/remove
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/user/remove", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/user/remove`


<!-- END_6f4b338330b86e8e7cd9d504e55a3f1d -->

<!-- START_69645e63d3c14864c8e88dbcd6d9b744 -->
## api/pending-users/details
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/pending-users/details", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/pending-users/details`


<!-- END_69645e63d3c14864c8e88dbcd6d9b744 -->

<!-- START_6b8110e8d94bdc3162b10d00ab8d3ea0 -->
## api/user/update-status/{user}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/user/update-status/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/user/update-status/{user}`


<!-- END_6b8110e8d94bdc3162b10d00ab8d3ea0 -->

<!-- START_f79fe084129b855c11c3dde33b374f5d -->
## api/users/show/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/users/show/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/users/show/{id}`


<!-- END_f79fe084129b855c11c3dde33b374f5d -->

#Venues


<!-- START_cb34ffe25e8a7c06ba3e66e54357c64e -->
## Display a listing of the resource.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/venues/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/venues/list`


<!-- END_cb34ffe25e8a7c06ba3e66e54357c64e -->

<!-- START_6e4a073638f7df5ddecc64221bfec666 -->
## api/venues
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/venues", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "VENUE_CREATED",
    "user_message": "Your venue has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/venues`


<!-- END_6e4a073638f7df5ddecc64221bfec666 -->

<!-- START_b0d3980a95ae551f2d0c89dcd21b6ab2 -->
## api/venues/{venue}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/venues/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "VENUE_UPDATED",
    "user_message": "Your venue has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/venues/{venue}`

`PATCH api/venues/{venue}`


<!-- END_b0d3980a95ae551f2d0c89dcd21b6ab2 -->

<!-- START_b046672c17274abac040f2708f8a756b -->
## Remove the specified resource from storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/venues/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/venues/{venue}`


<!-- END_b046672c17274abac040f2708f8a756b -->

#Welcome Screen


<!-- START_cb8e6e94b33056deab2187c16ddeeb2e -->
## Display a listing of the resource.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/welcome-screen/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/welcome-screen/list`


<!-- END_cb8e6e94b33056deab2187c16ddeeb2e -->

<!-- START_07cab91e6adcac3c862ff9a2f11c47ab -->
## api/welcome-screen
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/welcome-screen", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "SCREEN_CREATED",
    "user_message": "Your welcome screen has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/welcome-screen`


<!-- END_07cab91e6adcac3c862ff9a2f11c47ab -->

<!-- START_2b7a3acb6594d91c62c798d2ce4b7b37 -->
## api/welcome-screen/{welcome_screen}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/welcome-screen/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "SCREEN_UPDATED",
    "user_message": "Your welcome screen has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/welcome-screen/{welcome_screen}`

`PATCH api/welcome-screen/{welcome_screen}`


<!-- END_2b7a3acb6594d91c62c798d2ce4b7b37 -->

<!-- START_7cd57cd49987482a66ed73574bfbda1f -->
## Remove the specified resource from storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/welcome-screen/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/welcome-screen/{welcome_screen}`


<!-- END_7cd57cd49987482a66ed73574bfbda1f -->

#quote


<!-- START_85549d443ae0169ff33f65e1849bda3f -->
## api/quotes/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/quotes/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/quotes/list`


<!-- END_85549d443ae0169ff33f65e1849bda3f -->

<!-- START_26a1da690bab0a9919b2b75870728658 -->
## api/quotes
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/quotes", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "QUOTE_CREATED",
    "user_message": "Your quote has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/quotes`


<!-- END_26a1da690bab0a9919b2b75870728658 -->

<!-- START_81618ac61fbe322199edf55cc9be79d8 -->
## api/quotes/{quote}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/quotes/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/quotes/{quote}`


<!-- END_81618ac61fbe322199edf55cc9be79d8 -->

<!-- START_ccbed30888b2eab22decbbd01623fc2a -->
## api/quotes/{quote}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/quotes/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "QUOTE_UPDATED",
    "user_message": "Your quote has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/quotes/{quote}`

`PATCH api/quotes/{quote}`


<!-- END_ccbed30888b2eab22decbbd01623fc2a -->

<!-- START_fb1d7e996a3deaa44fe579cb1ab58466 -->
## api/quotes/{quote}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/quotes/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/quotes/{quote}`


<!-- END_fb1d7e996a3deaa44fe579cb1ab58466 -->

#demo


<!-- START_742d81b4598593e8f9be47bcf2017cad -->
## api/notification/push-token
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/notification/push-token", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/notification/push-token`


<!-- END_742d81b4598593e8f9be47bcf2017cad -->

<!-- START_aee4c51042d36b2a48b009eeaf37ac35 -->
## api/notification/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/notification/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/notification/list`


<!-- END_aee4c51042d36b2a48b009eeaf37ac35 -->

<!-- START_9d3950334a1bba5190a6063990253e31 -->
## api/notification
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/notification", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "NOTIFICATION_CREATED",
    "user_message": "Your notification has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/notification`


<!-- END_9d3950334a1bba5190a6063990253e31 -->

<!-- START_63462416aae5d0160cc13e2c62791858 -->
## api/notification/promotional
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/notification/promotional", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/notification/promotional`


<!-- END_63462416aae5d0160cc13e2c62791858 -->

<!-- START_4fc688f274917e579ebc8b214ceee079 -->
## api/notifications/promotional-list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/notifications/promotional-list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/notifications/promotional-list`


<!-- END_4fc688f274917e579ebc8b214ceee079 -->

<!-- START_e5bec0cd80da890ca24d66474358e1cb -->
## api/support
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/support", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/support`


<!-- END_e5bec0cd80da890ca24d66474358e1cb -->

<!-- START_e0cc7781f77aa50d54a15c7851b36d0b -->
## api/contact-us
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/contact-us", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/contact-us`


<!-- END_e0cc7781f77aa50d54a15c7851b36d0b -->

<!-- START_d0de1cb1329054901f7f87c6bfb70f04 -->
## api/notifications/promotional-show/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/notifications/promotional-show/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/notifications/promotional-show/{id}`


<!-- END_d0de1cb1329054901f7f87c6bfb70f04 -->

<!-- START_bc5aa2a754caa393fbfd43c44cb2255a -->
## api/notification/{notification}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/notification/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "NOTIFICATION_UPDATED",
    "user_message": "Your notificaton has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/notification/{notification}`

`PATCH api/notification/{notification}`


<!-- END_bc5aa2a754caa393fbfd43c44cb2255a -->

<!-- START_53ef5aced75f6c2fb6ecffb5516241ed -->
## Remove the specified resource from storage.

> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/notification/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/notification/{notification}`


<!-- END_53ef5aced75f6c2fb6ecffb5516241ed -->

<!-- START_061922b887af5021ffa13390854fd899 -->
## api/support/tickets
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/support/tickets", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/support/tickets`


<!-- END_061922b887af5021ffa13390854fd899 -->

<!-- START_1a1edf5e90516c4cf3013ed8a119137a -->
## api/support/tickets/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/support/tickets/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/support/tickets/{id}`


<!-- END_1a1edf5e90516c4cf3013ed8a119137a -->

#review


<!-- START_addef74ffb3ebdd2a128f801a9009fb7 -->
## api/reviews
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/reviews", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "REVIEW_CREATED",
    "user_message": "Your review has been created."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/reviews`


<!-- END_addef74ffb3ebdd2a128f801a9009fb7 -->

<!-- START_f28c14203b1b4d273f19fb792d2eaa33 -->
## api/reviews/{review}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->get("localhost:8000/api/reviews/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`GET api/reviews/{review}`


<!-- END_f28c14203b1b4d273f19fb792d2eaa33 -->

<!-- START_1ee0cc88ea76e084d979d0fb3b309bd2 -->
## api/reviews/list
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/reviews/list", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/reviews/list`


<!-- END_1ee0cc88ea76e084d979d0fb3b309bd2 -->

<!-- START_9c50d6aad074574a9cb1864f377a9ae3 -->
## api/band/reviews/{id}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/band/reviews/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/band/reviews/{id}`


<!-- END_9c50d6aad074574a9cb1864f377a9ae3 -->

<!-- START_98579ed10deadab06891e6d58ae77eeb -->
## api/reviews/add-to-quotes
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/reviews/add-to-quotes", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/reviews/add-to-quotes`


<!-- END_98579ed10deadab06891e6d58ae77eeb -->

<!-- START_700246d621fd56fc70cc0896c29997d7 -->
## api/reviews/mark-seen
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/reviews/mark-seen", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/reviews/mark-seen`


<!-- END_700246d621fd56fc70cc0896c29997d7 -->

<!-- START_35cf88c773a10a14eb9c02401e475561 -->
## api/reviews/list-admin-reviews
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->post("localhost:8000/api/reviews/list-admin-reviews", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`POST api/reviews/list-admin-reviews`


<!-- END_35cf88c773a10a14eb9c02401e475561 -->

<!-- START_55feaade8405effe70367323ddb75ed0 -->
## api/reviews/{review}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->put("localhost:8000/api/reviews/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "status": "SUCCESS",
    "server_message": "REVIEW_UPDATED",
    "user_message": "Your review has been updated."
}
```
> Example response (404):

```json
null
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```

### HTTP Request
`PUT api/reviews/{review}`

`PATCH api/reviews/{review}`


<!-- END_55feaade8405effe70367323ddb75ed0 -->

<!-- START_3fa0b81a7faa0bd8e3f805e8a0b3a31d -->
## api/reviews/{review}
> Example request:

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete("localhost:8000/api/reviews/1", [
    'headers' => [
            "Token" => "LZImHoMYQEean7Rr9BVNMI2LAPuWyqNbrfNUb7btVsZg6I9PWkJaqZ7mPF2q",
        ],
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```



### HTTP Request
`DELETE api/reviews/{review}`


<!-- END_3fa0b81a7faa0bd8e3f805e8a0b3a31d -->

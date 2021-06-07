# What is this simple project about.
- this is about how to search and get results from all stored suppliers / stores
# How To Run Test.
1- clone the project.
2- at first install composer to add the required libs for the project
```
composer install
```

open postman using a method type (post) and type in the body content , note to send it as a json form

e.g.
```
{
    "currency_code" : "USD",
    "products" : ["T-shirt","T-shirt","Shoes","Jacket"]
}

```

```
{
    "currency_code" : "EGP",
    "products" : ["T-shirt","Jacket"]
}

```
and then a resonse like that would be shown

```
{
    "subTotal": "66.96 USD",
    "taxes": "9.3744 USD",
    "discounts": "0.1 off Shoes : 2.499    &   0.5 off T-shirt : 9.995",
    "totalAmount": "63.84 USD"
}

```

```
{
    "subTotal": 495.67 EGP,
    "taxes": 69.3952 EGP,
    "discounts": "0.5 off T-shirt : 0",
    "totalAmount": "565.08 EGP"
}

```


***FOR using the simple unit test.***

```
php artisan test

```


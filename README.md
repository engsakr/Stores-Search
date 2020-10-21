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

## Challenge Description

***Write a program that can price a cart of products, accept multiple products, combine offers, and display a total detailed bill in different currencies (based on user selection).***

Available catalog products and their price in USD:

* T-shirt $10.99
* Pants $14.99
* Jacket $19.99
* Shoes $24.99


<p align="center">
    <img title="Flutterwave" height="200" src="https://flutterwave.com/images/logo-colored.svg" width="50%"/>
</p>

# Flutterwave Invoices #

This is an invoicing tool created by Flutterwave to assist merchants, entrepreneurs, freelancers to adequately record and send invoices for goods and services rendered.
You can add customers, create invoices, set deadlines and update them as you see fit.
Flutterwave is available in: **Nigeria, Ghana, Kenya, Uganda, Rwanda, South Africa, United States** and 90+ Countries. Sign up for an account [here](https://dashboard.flutterwave.com)


## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

What things you need to install the software and how to install them.

* PHP 7+ setup
* MySQL 5.5+ setup
* Composer installation
* NPM/Node or Yarn installation
* Quasar CLI

### Installing

A step by step series of examples that tell you how to get a development env running.

```
1. npm install
2. composer install
3. cp .env.example .env
4. cp .env.quasar.prod.example .env.quasar.prod
5. Create database and configure it in file .env
6. php artisan key:generate
7. php artisan migrate
```

Now, you need to configure virtual host in order for the project ot work properly.

On XAMPP with Windows,

1. Open "httpd-vhosts.conf" which is in: "C:\xampp\apache\conf\extra"

2. Add the following information:

```
<VirtualHost *:80>
    ServerAdmin {your_email}
    DocumentRoot "C:/xampp/htdocs/flw_invoices/public"
    ServerName flwinvoices
    ServerAlias flwinvoices.test
</VirtualHost>
```

3. Restart Apache


Modify host file in Windows

1. Run notepad as administrator.
2. Open the file hosts that is in: C:\Windows\System32\drivers\etc.
3.  Add the following values ​​and save the changes:

```
# LOCALHOST
127.0.0.1       localhost
::1             localhost

# Flutterwave Invoices
127.0.0.1       flwinvoices.test
::1             flwinvoices.test
```

### Usage
* For development, run `npm run q-spa-dev`
* For production, run `npm run q-spa-build`

### Running Tests
Run `vendor/bin/phpunit`

## Built Using

Mention the tools used in developing this package, e.g:

- [MongoDB](https://www.mongodb.com/) - Database
- [Express](https://expressjs.com/) - Server Framework
- [VueJs](https://vuejs.org/) - Web Framework
- [NodeJs](https://nodejs.org/en/) - Server Environment

## Contributors

- [Salvation Arinze](https://github.com/salvationarinze)


## Issues

For issues, suggestions and feature request, [click here](https://github.com/Flutterwave/invoices/issues).
To contribute, fork the repo, add your changes and modifications, then create a pull request.

Copyright (c) 2020, Flutterwave Developers

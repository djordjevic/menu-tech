
## Instalation steps
Locally i've used laravel sail. If you are interested in using Sail with an existing Laravel application, you may simply install Sail using the Composer package manager.
## composer require laravel/sail --dev

After Sail has been installed, you may run the sail:install Artisan command. This command will publish Sail's docker-compose.yml file to the root of your application:

## php artisan sail:install

To ensure that all containers are buildded, run:

## ./vendor/bin/sail build
Note: select options for MySQl and Redis container too. 
Note: I've used MySql on port 3307, so i've did port forwarding. 

Now, we can use sail
## ./vendor/bin/sail up -d

Run:
## docker ps

Find app container and navigate into it, then run:
## composer install
## npm install
## npm run dev
## cp .env.example .env
## php artisan cache:clear
## php artisan config:clear

After that, we have to run some commands to insert/update Currencies and Exchange Rates data from the API. Pls follow the commands order
Run: 
## php artisan migrate:fresh
Next command will populate currency list from the API.
## php artisan currencylayer:getcurrencies
## php artisan db:seed
Next command will populate Exchange rates list from the API.
## php artisan currencylayer:get_exchange_rates_data

After installation, home page on http://localhost should contain form. For the FrontEnd i've used Tailwind CSS and pure js.

Swagger anotation is available on the: 
## http://localhost/swagger

Mailtrap credentials for email check are:
https://mailtrap.io/signin
djordjevic_i@hotmail.com
uhDCm*aHq9jRAAD

Mailtrap config keys, Currencylayer API keys are published into .env file.





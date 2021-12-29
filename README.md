
#### Set up the Development Environment

The Laravel framework has a few system requirements. Of course, all of
these requirements are satisfied by the [Laravel
Homestead](https://laravel.com/docs/8.x/homestead) virtual machine, so
it's highly recommended that you use Homestead as your local Laravel
development environment.

However, if you are not using Homestead, you will need to make sure your
server meets the following requirements:

  - [PHP](https://www.php.net/) \>= 7.3
  - BCMath PHP Extension
  - Ctype PHP Extension
  - Fileinfo PHP extension
  - JSON PHP Extension
  - Mbstring PHP Extension
  - OpenSSL PHP Extension
  - PDO PHP Extension
  - Tokenizer PHP Extension
  - XML PHP Extension



#### Installation

1\. Open up command prompt and navigate to the EMall folder (where you
have extracted the folder). E.g.

`cd EMall`

2\. Next, run the following commands to install all dependencies

`composer install`

`npm install`

3\. Now rename the .env.example to .env and modify the values as per
your local environment

4\. Run the following command to generate the key

`php artisan key:generate`



#### Database

1\. modify .env the values for database in it as per your local
environment

2\. Place your database host address and port

` DB_HOST=127.0.0.1  `  
` DB_PORT=3306  `  

3\. Go to phpMyAdmin and create database named "laravel" and modified
.env file as database name

`DB_DATABASE=laravel`  
` DB_USERNAME=root  `  
` DB_PASSWORD=  `

4\. Run the following command to run database migration to create tables

`php artisan migrate`

5\. Run the following command to create personal access client for api

`php artisan passport:install`

6\. (Optional) Run the following command to insert initial data into
database

`php artisan db:seed`



#### Storage

1\. Run the following command to link storage to public

`php artisan storage:link`



#### Mail Service

1\. Go to <https://mailtrap.io/> and create new account.

2\. Create new inbox and go to inbox setting and put username and
password to .env file

`MAIL_MAILER=smtp`  
`MAIL_HOST=smtp.mailtrap.io`  
`MAIL_PORT=2525`  
`MAIL_USERNAME= {Your username}`  
`MAIL_PASSWORD= {Your password}`  
`MAIL_ENCRYPTION=tls`  
`MAIL_FROM_ADDRESS= {From email address}`  
`MAIL_FROM_NAME= {Your APP NAME}`



#### Razorpay Setup

1\. Go to <https://dashboard.razorpay.com/> and create new account.

2\. In Test mode create test key and replace this details in
'./app/Helpers/AppSetting.php'

`RAZORPAY_ID= {Here place your razorpay id}`  
`RAZORPAY_SECRET= {Here place your razorpay secret}`  



#### Paystack Setup

1\. Go to <https://dashboard.paystack.com/> and create new account.

2\. In Test mode create test key and replace this details in
'./app/Helpers/AppSetting.php'

`PAYSTACK_PUBLIC_KEY= {Here place your paystack public key}`  
`PAYSTACK_SECRET_KEY= {Here place your paystack secret key}`  


#### Stripe Setup

1\. Go to <https://dashboard.stripe.com/> and create new account.

2\. In Test mode create test key and replace this details in
'./app/Helpers/AppSetting.php'

`STRIPE_PUBLIC_KEY= {Here place your stripe public key}`  
`STRIPE_SECRET_KEY= {Here place your stripe secret key}`  


#### Photne Authentication Setup

1\. Go to
[https://console.firebase.google.com/](https://console.firebase.google.com/u/0/)
and go to project

2\. Enable phone authentication (in Sign in Method from Authentication).

3\. Add production server domain into Authorized domains.

4\. Create one web app and copy firebaseConfig and paste to this files

`resources/views/user/auth/number-verification.blade.php`  
`resources/views/manager/auth/number-verification.blade.php`  



#### Firebase Cloud Messaging

1\. Go to <https://console.firebase.google.com/> and create or login
account.

2\. Create project and go to project settings.

3\. In settings, go to cloud messaing tab and get server key and replace
this details in './app/Helpers/AppSetting.php'

`FCM_SERVER_KEY= {Place server key here}`



#### Currency setup

1\. In './app/Helpers/AppSetting.php'

`currencySign={Place currency sign}`  
`currencyCode={Place currency code}`





#### Run project

1\. Run the following command to compile all assets

`npm run dev`

2\. And Done, now you are ready to start development server

`php artisan serve`

Open <http://127.0.0.1:8000> to see it live there.

3. If you working with mobile app then start server with your host
adderess

`php artisan serve --host=HOST`

Note following commands around the compilation of assets


| Command                                                                         | Description                                                                 |
| ------------------------------------------------------------------------------- | --------------------------------------------------------------------------- |
| `npm run                                                                 watch` | For watch files and compiles assets on the fly (also auto reloads browser). |
| `npm run                                                                 dev`   | For compile assets.                                                         |
| `npm run                                                                 prod`  | For compile and prepare assets for production.                              |




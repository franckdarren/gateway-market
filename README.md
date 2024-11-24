
## Installation

`cp .env.example .env`

make the needed changes regarding name, url, database connection

`php artisan migrate`

`composer install`

`npm install`

`php artisan migrate:fresh --seed`

`php artisan serve` and `npm run dev`

Pour créer un serveur SMTP pour les mails sur linux.
`sudo docker run -p 1080:1080 -p 1025:1025 maildev/maildev`

Dans le fichier .env modifier comme suit :
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=no-reply@gateway-market.com
MAIL_FROM_NAME="${APP_NAME}"



Startup existante
identifiant : startup@startup.com
password : password

Investiseur existante
identifiant : investiseur@investiseur.com
password : password

Admin existante
identifiant : admin@admin.com
password : password


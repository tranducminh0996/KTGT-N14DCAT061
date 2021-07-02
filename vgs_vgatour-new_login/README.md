## VGA tour
- VGAtour

## Server Requirements

- PHP >= 7.3.11
- OpenSSL PHP Extension
- PDO PHP Extension
- BCMath PHP Extension
- Composer install
- Nodejs install

## Installing Project

1. Clone project git: `git clone https://github.com/DevStorevn/vgs_vgatour.git`
2. Go to folder: `cd ./vgatour`
3. Run command: `cp .env.example .env` (change config connect database)
4. Run command: `php artisan key:gener`
5. Run command: `php artisan jwt:secret` (generate a key for project)
3. Run command: `composer install`
4. Run command: `npm install`
5. Run command: `npm run prod`
6. Run command: `php artisan serv`


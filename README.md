### deploy with Docker

- git clone https://github.com/MechanicSCB/btn
- cd btn
- cp .env.example .env
- composer update
- alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
- sail up -d
- sail npm i
- sail npm run build
- sail artisan migrate:fresh --seed
- sail artisan queue:work

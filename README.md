### deploy with Docker
```
git clone https://github.com/MechanicSCB/btn <project-name>
```
```
cd <project-name>
```
```
composer update
```
```
cp .env.example .env
```
```
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```
```
sail up -d
```
```
sail artisan key:generate
```
```
sail npm i
```
```
sail npm run build
```
```
sail artisan migrate:fresh --seed
```
```
sail artisan queue:work
```

- Visit `http://localhost`
- Mailpit `http://localhost:8025` for testing email notification

### Articles

```
git clone git@github.com:dralexsand/articles.git

root application: articles
cd articles

from root application:
cd backend 
copy .env.example .env

from root application:
cd app
copy .env.example .env
docker-compose up --build -d
docker exec -it articles_backend bash
composer install
php artisan migrate:fresh --seed

from root application:
cd frontend 
npm run dev -- --host --port=3000

```

App running on:
http://127.0.0.1:3000/

Adminer
http://127.0.0.1:8997/

Options:
```
PostgeSQL
articles_db
root,root
```

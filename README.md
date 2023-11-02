# Welcome to blackbird
A fast-ish chat app with a global chat and friends and in the future servers and profile custimization

### Buildt with 
- laravel
- VueJs
- laravel echo
- soketi (websockets server)

### How to run
General requirements
- node 18 lts (codename hydrogen)
- composer
- npm
- a mariadb /MySQL server

To run Blackbird as dev
1. clone the repository 
2. run ``` composer install ```
3. run ``` npm install ```
4. copy and make your own adjustments to .env
5. setup database with ``` php artisan migrate ```
6. start the servers
```
npm run dev
php artisan serve 
soketi start
```

To run Blackbird in production
1. Follow steps 1-5 of dev setup
2. use nginx or apache to host the files
3. point the .htaccess file to public/index.pho
4 run these commands
``` 
soketi start
npm run build 
```


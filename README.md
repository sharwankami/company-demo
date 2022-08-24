# Company Demo

---

- Clear the unwanted models, controllers etc
- Create database  


```shell
mysql -uroot -p
mysql> create database digitive;
```

Create migration
```shell
php artisan make:migration create_company_table
php artisan migrate
```

Create model
```shell
php artisan make:model Company
```

Create seeder for testing
```shell
php artisan make:seeder CompanySeeder
php artisan db:seed --class=CompanySeeder
```

>NOTE: Before running the application, 
>please make sure database credentials are updated in `.env` file 
>and migration/seeding is done, also need to install the npm components and transpile assets

Create routes for both web and api


Create middlewares 
```shell
php artisan make:middleware EnsureCompanyExists
```

Create controller 

```shell
php artisan make:controller CompanyController --resource --model=Company
```

Create views

Create input component
```shell
php artisan make:component Forms/Input
```
also add `Blade::component('form-input', Input::class);` in boot() method of AppServiceProvider

run npm
```shell
npm i bootstrap -S
npm i
```

add utils functions for country and 

setup vue
```shell
composer require laravel/ui
php artisan ui vue
npm i
npm run dev
```

Create vue components in `resources/js/components`

Register the view component by adding 
```shell
Vue.component('companylist', require('./components/CompanyList.vue').default);
```
in `resources/js/app.js`

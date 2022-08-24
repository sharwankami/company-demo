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
```

Before running the application, please make sure database credentials are updated in `.env` file and migration is `run`

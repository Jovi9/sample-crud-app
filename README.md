# Sample CRUD App Using Simple MVC

Sample application using PHP and MySQL.

## Get Started

### Prerequisite

-    Apache Web Server || PHP Built-in Web Server
-    PHP >= 8.1
-    MySQL
-    Composer

### Clone the repository

```bash
git clone https://github.com/Jovi9/sample-crud-app.git && cd sample-crud-app
```

### Run the following command to enable composer class autoloader

```bash
composer dump-autoload
```

### Configure environment

```bash
cp .env.example .env
```

Configure .env variables (i.e. app name, url, database). For starters, you may use the crud_database.sql located in the src directory.

### Serve the project

-    Using the built-in php web server

```bash
php -S localhost:8000 -t public
```

-    Using apache web server, configure the apache virtual host to point to the project's public directory.
     For example, the project is located in the www folder.

```
<VirtualHost *:80>
        ServerAdmin web@sample-crud-app.local.com
        DocumentRoot "/var/www/sample-crud-app/public"

        ServerName sample-crud-app.local.com
        ServerAlias sample-crud-app.local.com

        <Directory "/var/www/sample-crud-app/public">
            Options Indexes FollowSymLinks
            AllowOverride All
            Require all granted
        </Directory>

        ErrorLog "logs/sample-crud-app.local.com-error.log"
        CustomLog "logs/sample-crud-app.local.com-access.log" combined

        <IfModule mod_dir.c>
            DirectoryIndex index.php>
        </IfModule>
</VirtualHost>
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

### [Additional Usage Docs](/docs/README.md)

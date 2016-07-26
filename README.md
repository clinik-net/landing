Medivo API
=======================

In this document you will find following information

- Server Configuration
- 
# SERVER CONFIGURATION
------------------------------

## Apache vHost

```
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    ServerName clinik.net

    SetEnv APPLICATION_ENV "development"

    DocumentRoot /var/www/cliniknet/public

    <Directory /var/www/cliniknet/public/ >
        RewriteEngine On
        DirectoryIndex index.php
        Options Indexes FollowSymLinks MultiViews
        AllowOverride None
        Order allow,deny
        allow from all
        require all granted

        RewriteCond %{REQUEST_FILENAME} -s [OR]
        RewriteCond %{REQUEST_FILENAME} -l [OR]
        RewriteCond %{REQUEST_FILENAME} -d
        RewriteRule ^.*$ - [NC,L]
        RewriteRule ^.*$ /index.php [NC,L]
    </Directory>

    ErrorLog /var/www/logs/cliniknet_landing-error.log
    LogLevel warn
    CustomLog /var/www/logs/cliniknet_landing-access.log combined
</VirtualHost>
```
# Silex/Doctrine/AngularJS Skeleton

## Steps
### Apache2 side
- Create a site configuration file in /etc/apache2/sites-available :
`
<VirtualHost *:80>
    ServerName sda-skeleton.com
    DocumentRoot /var/www/silex-doctrine-angularjs-skeleton/public
    <Directory /var/www/silex-doctrine-angularjs-skeleton/public>
        DirectoryIndex index.html
	AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
`
- Create another site configuration file in /etc/apache2/sites-available :
`
<VirtualHost *:80>
    ServerName api.sda-skeleton.com
    DocumentRoot /var/www/silex-doctrine-angularjs-skeleton/server
    SetEnv APPLICATION_ENV "developement"
    <Directory /var/www/silex-doctrine-angularjs-skeleton/server>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
`
- Add into your /etc/hosts :
`
127.0.0.1       sda-skeleton.com
127.0.0.1       api.sda-skeleton.com
`

### Server side
- Make sure your PHP Rewrite module is enabled
- Execute in server's directory : 'php /here/the/composer/path/composer.phar install'
- Copy server/config/config.ini.default in config/config.ini and fill the fields
- Create your MySQL database as inquired in config.ini file
- Execute in server's directory : 'php vendor/bin/doctrine orm:schema-tool:update --force'
- Add a line in your table in order to test the API

### Public side
- Execute in public's directory : 'grunt compile'

##Information
- After each entity edit or add, execute in root project : "php vendor/bin/doctrine orm:schema-tool:update --force"
- In order to generate entity's getter/setter, execute in root project : "php vendor/bin/doctrine orm:generate:entities ."
- In order to generate entity's repository, execute in root project : "php vendor/bin/doctrine orm:generate:repositories ."

## Build Javascript and SASS files
- Add npm packages : "sudo npm i grunt grunt-cli grunt-contrib-watch grunt-contrib-compass grunt-contrib-uglify grunt-contrib-concat"
- Watch and compile your Javascript/Sass code : "grunt watch"

## Technologies
- [AngularJS (JavaScript Framework](https://getcomposer.org/)
- [Composer (Dependency Manager)](https://getcomposer.org/)
- [Silex (PHP Micro Framework)](https://packagist.org/packages/silex/silex)
- [Doctrine (ORM)](http://www.doctrine-project.org/)
- [Grunt (JavaScript Task Runner)](http://gruntjs.com/)
# Silex/Doctrine/AngularJS Skeleton

## Information
- Make sure your PHP Rewrite module is enabled
- Copy config/config.ini.default in config/config.ini and fill the fields
- Create your MySQL database as inquired in config.ini file
- After each entity edit or add, execute in root project : "php vendor/bin/doctrine orm:schema-tool:update --force"
- In order to generate entity's getter/setter, execute in root project : "php vendor/bin/doctrine orm:generate:entities ."
- In order to generate entity's repository, execute in root project : "php vendor/bin/doctrine orm:generate:repositories ."

## Build Javascript and SASS files
- Add npm packages : "sudo npm i grunt grunt-cli grunt-contrib-watch grunt-contrib-compass grunt-contrib-uglify grunt-contrib-concat"
- Execute command : "grunt watch"

## Technologies
- [AngularJS (JavaScript Framework](https://getcomposer.org/)
- [Composer (Dependency Manager)](https://getcomposer.org/)
- [Silex (PHP Micro Framework)](https://packagist.org/packages/silex/silex)
- [Twig (PHP Template engine)](https://packagist.org/packages/twig/twig)
- [Doctrine (ORM)](http://www.doctrine-project.org/)
- [Grunt (JavaScript Task Runner)](http://gruntjs.com/)
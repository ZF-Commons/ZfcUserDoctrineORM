ZfcUserDoctrineORM
==================
Version 0.1.1 Created by Kyle Spraggs and the ZF-Commons team

Introduction
------------
ZfcUserDoctrineORM is a Doctrine2 ORM storage adapter for [ZfcUser](https://github.com/ZF-Commons/ZfcUser).

Dependencies
------------

- [ZfcUser](https://github.com/ZF-Commons/ZfcUser)
- [DoctrineModule](https://github.com/doctrine/DoctrineModule)
- [DoctrineORMModule](https://github.com/doctrine/DoctrineORMModule)

Installation
------------
If you haven't yet, install Doctrine: ([note on using fixed versioning in composer][4])

    php composer.phar require doctrine/doctrine-orm-module:~0.7

Set up Database Connection Settings for Doctrine ORM:

Namely, go to [Doctrine Connection Settings][5], and copy/paste/modify the example configuration file content into your `config/autoload/doctrine.orm.local.php` file within `MyApp` folder, where `MyApp` is the name of your application.  

Install Zfc Components:

    php composer.phar require zf-commons/zfc-user:~0.1
    php composer.phar require zf-commons/zfc-user-doctrine-orm:~0.1

For just the basics, you do not need to create custom configuration files for the above two modules to work ([ref][6]).

Set up your Modules in `config/application/application.config.php`, something like

    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'ZfcBase',
        'ZfcUser',
        'ZfcUserDoctrineORM',
        'Application',
    ),

Using `doctrine-module` you can set up your schema:

    vendor/bin/doctrine-module orm:schema-tool:update --dump-sql

If SQL looks okay, do: 

    vendor/bin/doctrine-module orm:schema-tool:update --force

You can now navigate to `http://localhost/MyApp/user` and it should work.

  [4]: http://stackoverflow.com/a/14816988/2883328 "composer versioning"
  [5]: https://github.com/doctrine/DoctrineORMModule#connection-settings
  [6]: http://stackoverflow.com/a/14781304/2883328

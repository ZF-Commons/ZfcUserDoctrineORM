ZfcUserDoctrineORM
==================
Version 0.1.1 Created by Kyle Spraggs and the ZF-Commons team

Introduction
------------
ZfcUserDoctrineORM is a Doctrine2 ORM storage adapter for [ZfcUser](https://github.com/ZF-Commons/ZfcUser).

Options
-------

The following options are available:

- **enable_default_entities** - Boolean value, determines if the default User entity should be enabled. Set it to false in order to extend ZfcUser\Entity\User with your own entity. Default is true.

Dependencies
------------

- [ZfcUser](https://github.com/ZF-Commons/ZfcUser)
- [DoctrineModule](https://github.com/doctrine/DoctrineModule)
- [DoctrineORMModule](https://github.com/doctrine/DoctrineORMModule)

Installation
------------
Set up Database Connection Settings for Doctrine ORM:

Namely, go to [Doctrine Connection Settings](https://github.com/doctrine/DoctrineORMModule#connection-settings), and copy/paste/modify the example configuration file content into your `config/autoload/doctrine.orm.local.php`.  

Install Zfc Components:

    php composer.phar require zf-commons/zfc-user-doctrine-orm

Set up your Modules in `config/application/application.config.php`, something like

    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'ZfcBase',
        'ZfcUser',
        'ZfcUserDoctrineORM',
        'Application',
    ),

Now, you can use [ZfcUser SQL schema](https://github.com/ZF-Commons/ZfcUser/tree/master/data) to set up your database tables.

Alternatively, you can use `doctrine-module` to do this work for you:

    vendor/bin/doctrine-module orm:schema-tool:update --dump-sql

If SQL looks okay, do: 

    vendor/bin/doctrine-module orm:schema-tool:update --force

You can now navigate to `/user` and it should work.

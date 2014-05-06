AjglDoctrineDbalPgsqlTypes
==========================

This component allows you to manage some native [PostgreSQL](http://www.postgresql.org)
data types with the Doctrine [DBAL](http://www.doctrine-project.org/projects/dbal.html) component.


Usage
-----

To use the new types you shoud register them using the [Custom Mapping Types](https://doctrine-dbal.readthedocs.org/en/latest/reference/types.html#custom-mapping-types) feature.
```php
\Doctrine\DBAL\Types\Type::addType('integer[]', 'Ajgl\Doctrine\DBAL\Types\IntegerArrayType');
/* @var $connection \Doctrine\DBAL\Connection */
$connection->getDatabasePlatform()->registerDoctrineTypeMapping('_int4', 'integer[]');
```


### Usage with Symfony Standard Edition
If you want to use this with a Symfony Standard Edition application, you can [register the
new types](http://symfony.com/doc/current/cookbook/doctrine/dbal.html#registering-custom-mapping-types) in the `config.yml` file.
```yml
doctrine:
    dbal:
        types:
            integer[]: Ajgl\Doctrine\DBAL\Types\IntegerArrayType
        mapping_types:
            _int4: integer[]
```


License
-------

This component is under the MIT license. See the complete license in the LICENSE file.


Badges
------

* **Travis CI**: [![Build Status](https://travis-ci.org/ajgarlag/AjglDoctrineDbalPgsqlTypes.png?branch=master)](https://travis-ci.org/ajgarlag/AjglDoctrineDbalPgsqlTypes)
* **Poser Latest Stable Version:** [![Latest Stable Version](https://poser.pugx.org/ajgl/doctrine-dbal-pgsql-types/v/stable.png)](https://packagist.org/packages/ajgl/doctrine-dbal-pgsql-types)
* **Poser Latest Unstable Version** [![Latest Unstable Version](https://poser.pugx.org/ajgl/doctrine-dbal-pgsql-types/v/unstable.png)](https://packagist.org/packages/ajgl/doctrine-dbal-pgsql-types)
* **Poser Total Downloads** [![Total Downloads](https://poser.pugx.org/ajgl/doctrine-dbal-pgsql-types/downloads.png)](https://packagist.org/packages/ajgl/doctrine-dbal-pgsql-types)
* **Poser Monthly Downloads** [![Montly Downloads](https://poser.pugx.org/ajgl/doctrine-dbal-pgsql-types/d/monthly.png)](https://packagist.org/packages/ajgl/doctrine-dbal-pgsql-types)
* **Poser Daily Downloads** [![Daily Downloads](https://poser.pugx.org/ajgl/doctrine-dbal-pgsql-types/d/daily.png)](https://packagist.org/packages/ajgl/doctrine-dbal-pgsql-types)
* **Poser License** [![License](https://poser.pugx.org/ajgl/csv/license.png)](https://packagist.org/packages/ajgl/doctrine-dbal-pgsql-types)
* **Scrutinizer Quality** [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ajgarlag/AjglDoctrineDbalPgsqlTypes/badges/quality-score.png?s=c478fd01c94da920088dbfb9bb76a1798796b746)](https://scrutinizer-ci.com/g/ajgarlag/AjglDoctrineDbalPgsqlTypes/)
* **Scrutinizer Code Coverage** [![Code Coverage](https://scrutinizer-ci.com/g/ajgarlag/AjglDoctrineDbalPgsqlTypes/badges/coverage.png?s=aa6f47bd47d03ff979d50428201309656703ec56)](https://scrutinizer-ci.com/g/ajgarlag/AjglDoctrineDbalPgsqlTypes/)
* **SensionLabs Insight Quality** [![SensioLabsInsight](https://insight.sensiolabs.com/projects/4394a7cb-4066-4329-80fe-b74ed571c411/mini.png)](https://insight.sensiolabs.com/projects/4394a7cb-4066-4329-80fe-b74ed571c411)
* **VersionEye Dependency Status** [![Dependency Status](https://www.versioneye.com/php/ajgl:doctrine-dbal-pgsql-types/dev-master/badge.png)](https://www.versioneye.com/php/ajgl:doctrine-dbal-pgsql-types/dev-master)


About
-----

AjglDoctrineDbalPgsqlTypes is an [ajgarlag](http://aj.garcialagar.es) initiative.


Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/ajgarlag/AjglDoctrineDbalPgsqlTypes/issues).
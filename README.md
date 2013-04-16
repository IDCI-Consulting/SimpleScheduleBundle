SimpleScheduleBundle
====================

A simple Schedule Bundle for Symfony2


Instalation
===========

To install this bundle please follow the next steps:

First add the dependencies to your `composer.json` file:

```json
"require": {
    ...
    "pagerfanta/pagerfanta": "dev-master",
    "white-october/pagerfanta-bundle": "dev-master",
    "idci/exporter-bundle": "dev-master",
    "idci/simple-schedule-bundle": "dev-master"
},
```

Then install the bundle with the command:

```php
php composer update
```

Enable the bundle in your application kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
        new IDCI\Bundle\ExporterBundle\IDCIExporterBundle(),
        new IDCI\Bundle\SimpleScheduleBundle\IDCISimpleScheduleBundle(),
    );
}
```

Now the Bundle is installed.

Configure your database parameters in the `app/config/parameters.yml` then run

```php
php app/console doctrine:schema:update --force
```

Add the following lines in the `routing.yml`:

```yml
idci_simple_schedule:
    resource: "../../vendor/idci/simple-schedule-bundle/IDCI/Bundle/SimpleScheduleBundle/Controller"
    type:     annotation
    prefix:   /admin
```

Add the following lines in the `config.yml`:

```yml
twig:
    form:
        resources:
            - 'IDCISimpleScheduleBundle:Form:duration_widget.html.twig'
```


The administration area
=======================

This bundle provides an administration section in order to use it quickly.
If you would like to use it, simply point your browser at `/admin/schedule`.
To paginate element lists, this bundle uses the well known [WhiteOctoberPagerfantaBundle](https://github.com/whiteoctober/WhiteOctoberPagerfantaBundle)
You need to configure the `max_per_page` parameter in your `app/config/parameter.yml` file as follows:

```yml
parameters:
    ...
    # Pager Fanta
    max_per_page:      20
```

In order to secure this area, you need to edit `app/config/security.yml` as described in the [Symfony2 documentation](http://symfony.com/doc/master/book/security.html)
This is not required for testing though it is really recommanded as a production setting.

Here's a simple but effective configuration example which uses a basic in-memory user security model:

```yml
security:
    encoders:
        Symfony\Component\Security\Core\User\User: plaintext

    role_hierarchy:
        ROLE_ADMIN:       ROLE_USER
        ROLE_SUPER_ADMIN: [ROLE_USER, ROLE_ADMIN, ROLE_ALLOWED_TO_SWITCH]

    providers:
        in_memory:
            memory:
                users:
                    admin: { password: userpass, roles: [ 'ROLE_ADMIN' ] }

    firewalls:
        dev:
            pattern:  ^/(_(profiler|wdt)|css|images|js)/
            security: false

        secured_area:
            pattern:    ^/admin/
            anonymous: ~
            http_basic:
                realm: "Secured Admin Area"

    access_control:
        - { path: ^/admin, roles: ROLE_ADMIN }
```


Web service (REST)
==================

This bundle can be use through a web API.

For this you have to install [IDCIExporterBundle](https://github.com/IDCI-Consulting/ExporterBundle)
and add the following lines in the `config.yml`:

```yml
imports:
    ...
    - { resource: @IDCISimpleScheduleBundle/Resources/config/config.yml }
```

To query this api simply use this url `/api/query?[params]`

The main parameters are:

 * format: xml (default), json, jsonp, csv, ics (for event entity)
 * entity: Event (default), Location, Category

Exemples:

To query all the locations in the json format: `/api/query?entity=Location&format=json`  
To query all the events in the ics format: `/api/query?entity=Event&format=ics`  
To query all the category in the xml format: `/api/query?entity=Category&format=xml` or `/api/query?entity=Category`  

You can also use more specific query parameters for each entity as folow:

Location:

 * id => id=x
 * ids => ids[]=x&ids[]=y

Category:

 * id => id=x
 * ids => ids[]=x&ids[]=y
 * level => level=0
 * parent_category_id
 * parent_category_ids
 * ancestor_category_id
 * ancestor_category_ids
 * location_id
 * all_in_location_id

Event:

 * id => id=x
 * ids => ids[]=x&ids[]=y
 * category_id
 * category_ids
 * parent_category_id
 * parent_category_ids
 * ancestor_category_id
 * ancestor_category_ids
 * location_id
 * location_ids

Todo ~ TER ;)

 * xproperty_namespace
 * xproperty_key
 * xproperty_value


TODO
====

 * How to override this bundle

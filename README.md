SimpleScheduleBundle
====================

A simple Schedule Bundle for Symfony2


Instalation
===========

To install this bundle please follow the next steps:

First add the dependency to your `composer.json` file:

    "require": {
        ...
        "pagerfanta/pagerfanta":           "dev-master",
        "white-october/pagerfanta-bundle": "dev-master",
        "idci/exporter-bundle":            "dev-master",
        "idci/simple-schedule-bundle":     "dev-master"
    },

Then install the bundle with the command:

    php composer update

Enable the bundle in your application kernel:

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            new IDCI\Bundle\ExporterBundle\IDCIExporterBundle(),
            new IDCI\Bundle\SimpleScheduleBundle\IDCISimpleScheduleBundle()
        );
    }

Now the Bundle is installed.

Configure your database parameters in the `app/config/parameters.yml` then run

    php app/console doctrine:schema:update --force

Add the following lines in the `routing.yml`:

For the query interfaces:

    idci_simple_schedule:
        resource: "@IDCISimpleScheduleBundle/Controller/QueryController.php"
        type:     annotation

Add the following lines in the `config.yml`:

    imports:
        - { resource: @IDCISimpleScheduleBundle/Resources/config/config.yml }

    ...

    twig:
        form:
            resources:
                - 'IDCISimpleScheduleBundle:Form:meta_widget.html.twig'

TODO:

 * How to use the admin provided with the bundle:
 * How to override this bundle

Query parameter:

This bundle can be use through a web API.
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

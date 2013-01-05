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

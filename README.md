SimpleScheduleBundle
====================

A simple Schedule Bundle for Symfony2


Instalation
===========

To install this bundle please follow the next steps:

First add the dependencie to your `composer.json` file:

    "require": {
        ...
        "idci/simple-schedule-bundle": "dev-master"
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
            new IDCI\Bundle\SimpleScheduleBundle\IDCISimpleScheduleBundle(),
        );
    }

Now the Bundle is installed.

You can add a demo route in your 'routing_dev' to get an exemple on how
this bundle work for exemple:

    _idci_simpleschedule:
        resource: "@IDCISimpleScheduleBundle/Controller/DemoController.php"
        type:     annotation
        prefix:   /demo

Get a lookup at /demo/simpleschedule

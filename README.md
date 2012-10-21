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

Add the following lines in you routing.yml to use the default admin interfaces
provide with this bundle.

    idci_simple_schedule:
        resource: "@IDCISimpleScheduleBundle/Controller"
        type:     annotations


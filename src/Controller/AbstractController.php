<?php

namespace Application\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractController
{

    public $request;

    function __construct(Request $request, Application $app)
    {
        $this->request = $request;
        $this->app = $app;
        $this->em = $this->createEntityManager($app);
    }

    private function createEntityManager()
    {
        $path = array('src/Entity');
        $devMode = true;
        $config = Setup::createAnnotationMetadataConfiguration($path, $devMode);
        $config->addFilter('soft-deleteable', 'Gedmo\SoftDeleteable\Filter\SoftDeleteableFilter');

        $connectionOptions = parse_ini_file("config/config.ini");

        $em = EntityManager::create($connectionOptions, $config);
        $em->getFilters()->enable('soft-deleteable');
        $em->getEventManager()->addEventSubscriber(new \Gedmo\SoftDeleteable\SoftDeleteableListener());

        return $em;
    }
}
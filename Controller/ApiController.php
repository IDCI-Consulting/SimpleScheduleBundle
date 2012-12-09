<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Api controller.
 *
 * @Route("/api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/query", name="simple_schedule_api")
     */
    public function queryAction(Request $request)
    {
        $result = $this->get('idci_simpleschedule.manager')->query($request->query->all());

        var_dump($result);
        $response = new Response();
        $response->setContent($result->getContent());
        $response->headers->set('Content-Type', $result->getContentType());

        return $response;
    }
}

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
     * @Template()
     */
    public function queryAction(Request $request)
    {
        $events = $this->get('idci_simpleschedule.manager')->getAll();

        return array('events' => $events);
    }
}

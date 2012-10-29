<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class QueryController extends Controller
{
    /**
     * @Route("/query", name="simple_schedule_query")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}

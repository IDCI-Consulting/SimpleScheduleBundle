<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Admin controller.
 *
 * @Route("/admin/schedule")
 */
class AdminController extends Controller
{
    /**
     * Admin home action
     *
     * @Route("/", name="admin_schedule")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}

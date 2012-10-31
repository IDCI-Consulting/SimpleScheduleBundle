<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class QueryController extends Controller
{
    /**
     * @Route("/query.{_format}", requirements={"_format" = "xml|json"}, name="simple_schedule_query")
     * @Template()
     */
    public function queryAction(Request $request)
    {
        $format = $request->getRequestFormat();
        $contentTypes = array(
            'json'  => 'application/json; charset=UTF-8',
            'xml'   => 'text/xml; charset=UTF-8'
        );

        $tasks = $this->getDoctrine()
            ->getEntityManager()
            ->getRepository('IDCISimpleScheduleBundle:Task')
            ->findAll()
        ;

        if(!$tasks)
            $this->createNotFoundException("No results found");

        $response = $this->render(
            sprintf('IDCISimpleScheduleBundle:Query:tasks.%s.twig', $format),
            array('tasks' => $tasks)
        );

        $response->headers->set('Content-Type', $contentTypes[$format]);

        return $response;
    }
}

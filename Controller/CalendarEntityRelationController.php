<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @licence: GPL
 *
 */

namespace IDCI\Bundle\SimpleScheduleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntityRelation;
use IDCI\Bundle\SimpleScheduleBundle\Form\CalendarEntityRelationType;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Event controller.
 *
 * @Route("/schedule/relation")
 */
class CalendarEntityRelationController extends Controller
{
    /**
     * Add a CalendarEntityRelation
     *
     * @Route("/{calendar_entity_id}/add", name="admin_schedule_relation_add")
     */
    public function addCalendarEntityRelationAction(Request $request, $calendar_entity_id)
    {
        $em = $this->getDoctrine()->getManager();
        $calendarEntity = $em->getRepository('IDCISimpleScheduleBundle:CalendarEntity')->find($calendar_entity_id);

        if (!$calendarEntity) {
            throw $this->createNotFoundException('Unable to find Calendar entity.');
        }

        $entity = new CalendarEntityRelation();
        $form = $this->createForm(new CalendarEntityRelationType, $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
        } else {
            die('todo: flash message');
        }

        return $this->redirect($this->generateUrl(
            'admin_event_edit',
            array('id' => $calendarEntity->getId())
        ));
    }
}

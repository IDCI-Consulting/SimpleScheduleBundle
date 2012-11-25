<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IDCI\Bundle\SimpleScheduleBundle\Entity\CalendarEntity;
use IDCI\Bundle\SimpleScheduleBundle\Form\RecurChoiceType;
use IDCI\Bundle\SimpleScheduleBundle\Entity\Recur;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Event controller.
 *
 * @Route("/admin/recur")
 */
class RecurController extends Controller
{
    /**
     * Display a Recur form following to a given frequency 
     *
     * @Route("/{calendar_entity_id}/recur/add", name="admin_recur_add")
     * @Template()
     */
    public function addRecurAction(Request $request, $calendar_entity_id)
    {
        $em = $this->getDoctrine()->getManager();

        $calendarEntity = $em->getRepository('IDCISimpleScheduleBundle:CalendarEntity')->find($calendar_entity_id);
        if (!$calendarEntity) {
            throw $this->createNotFoundException('Unable to find Calendar entity.');
        }

        $recurChoiceForm = $this->createForm(new RecurChoiceType());
        $recurChoiceForm->bind($request);
        if (!$recurChoiceForm->isValid()) {
            throw $this->createNotFoundException('Unavailable Recur choice.');
        }
        $data = $recurChoiceForm->getData();

        $frequency = $data['frequency'];
        $entity = new Recur();
        $entity->setFrequency($frequency);
        $recurForm = $this->createForm(
            self::createRecurType($frequency),
            $entity
        );

        return array(
            'entity'          => $entity,
            'calendar_entity' => $calendarEntity,
            'frequency'       => $frequency,
            'recur_form'      => $recurForm->createView()
        );
    }

    /**
     * Create a Recur
     *
     * @Route("/{calendar_entity_id}/recur/create/{frequency}", name="admin_recur_create")
     * @Template("IDCISimpleScheduleBundle:Recur:addRecur.html.twig")
     */
    public function createRecurAction(Request $request, $calendar_entity_id, $frequency)
    {
        $em = $this->getDoctrine()->getManager();

        $calendarEntity = $em->getRepository('IDCISimpleScheduleBundle:Event')->find($calendar_entity_id);

        if (!$calendarEntity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $entity = new Recur();
        $recurForm = $this->createForm(self::createRecurType($frequency), $entity);
        $recurForm->bind($request);

        if ($recurForm->isValid()) {
            var_dump($entity); die('todo');
        }

        return array(
            'entity'          => $entity,
            'calendar_entity' => $calendarEntity,
            'frequency'       => $frequency,
            'recur_form'      => $recurForm->createView()
        );
    }

    /**
     * Create a RecurType based on a given frequency
     *
     * @return FormType
     */
    static public function createRecurType($freq)
    {
        $formTypeName = sprintf(
            'IDCI\Bundle\SimpleScheduleBundle\Form\Recur\%sRecurType',
            ucfirst(strtolower($freq))
        );

        return new $formTypeName;
    }
}

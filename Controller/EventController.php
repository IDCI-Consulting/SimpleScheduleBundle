<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IDCI\Bundle\SimpleScheduleBundle\Entity\Event;
use IDCI\Bundle\SimpleScheduleBundle\Form\EventType;
use IDCI\Bundle\SimpleScheduleBundle\Form\RecurChoiceType;

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Event controller.
 *
 * @Route("/admin/event")
 */
class EventController extends Controller
{
    /**
     * Lists all Event entities.
     *
     * @Route("/", name="admin_event")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IDCISimpleScheduleBundle:Event')->findAll();

        $adapter = new ArrayAdapter($entities);
        $pager = new PagerFanta($adapter);
        $pager->setMaxPerPage($this->container->getParameter('max_per_page'));
        
        try {
            $pager->setCurrentPage($request->query->get('page', 1)); 
        } 
        catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException(); 
        }
        
        return array(
            'pager' => $pager,
        );
    }

    /**
     * Finds and displays a Event entity.
     *
     * @Route("/{id}/show", name="admin_event_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCISimpleScheduleBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Event entity.
     *
     * @Route("/new", name="admin_event_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Event();
        $form   = $this->createForm(new EventType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Event entity.
     *
     * @Route("/create", name="admin_event_create")
     * @Method("POST")
     * @Template("IDCISimpleScheduleBundle:Event:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Event();
        $form = $this->createForm(new EventType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been created', array(
                    '%entity%' => 'Event',
                    '%id%'     => $entity->getId()
                ))
            );

            return $this->redirect($this->generateUrl('admin_event_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Event entity.
     *
     * @Route("/{id}/edit", name="admin_event_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCISimpleScheduleBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $editForm = $this->createForm(new EventType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        $recurChoiceForm = $this->createForm(new RecurChoiceType());

        return array(
            'entity'            => $entity,
            'edit_form'         => $editForm->createView(),
            'delete_form'       => $deleteForm->createView(),
            'recur_choice_form' => $recurChoiceForm->createView()
        );
    }

    /**
     * Edits an existing Event entity.
     *
     * @Route("/{id}/update", name="admin_event_update")
     * @Method("POST")
     * @Template("IDCISimpleScheduleBundle:Event:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCISimpleScheduleBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EventType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

        $this->get('session')->getFlashBag()->add(
            'info',
            $this->get('translator')->trans('%entity%[%id%] has been updated', array(
                '%entity%' => 'Event',
                '%id%'     => $entity->getId()
            ))
        );

        return $this->redirect($this->generateUrl('admin_event_edit', array('id' => $id)));
        
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Event entity.
     *
     * @Route("/{id}/delete", name="admin_event_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IDCISimpleScheduleBundle:Event')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Event entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been deleted', array(
                    '%entity%' => 'Event',
                    '%id%'     => $id
                ))
            );
        }

        return $this->redirect($this->generateUrl('admin_event'));
    }
    
    /**
     * Display Event deleteForm.
     *
     * @Template()
     */
    public function deleteFormAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCISimpleScheduleBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}

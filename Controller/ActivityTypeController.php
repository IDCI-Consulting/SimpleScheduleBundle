<?php

namespace IDCI\Bundle\SimpleScheduleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use IDCI\Bundle\SimpleScheduleBundle\Entity\ActivityType;
use IDCI\Bundle\SimpleScheduleBundle\Form\ActivityTypeType;

/**
 * ActivityType controller.
 *
 * @Route("/activitytype")
 */
class ActivityTypeController extends Controller
{
    /**
     * Lists all ActivityType entities.
     *
     * @Route("/", name="activitytype")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IDCISimpleScheduleBundle:ActivityType')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a ActivityType entity.
     *
     * @Route("/{id}/show", name="activitytype_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCISimpleScheduleBundle:ActivityType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActivityType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new ActivityType entity.
     *
     * @Route("/new", name="activitytype_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ActivityType();
        $form   = $this->createForm(new ActivityTypeType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new ActivityType entity.
     *
     * @Route("/create", name="activitytype_create")
     * @Method("POST")
     * @Template("IDCISimpleScheduleBundle:ActivityType:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new ActivityType();
        $form = $this->createForm(new ActivityTypeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been created', array(
                    '%entity%' => 'ActivityType',
                    '%id%'     => $entity->getId()
                ))
            );

            return $this->redirect($this->generateUrl('activitytype_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ActivityType entity.
     *
     * @Route("/{id}/edit", name="activitytype_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCISimpleScheduleBundle:ActivityType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActivityType entity.');
        }

        $editForm = $this->createForm(new ActivityTypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ActivityType entity.
     *
     * @Route("/{id}/update", name="activitytype_update")
     * @Method("POST")
     * @Template("IDCISimpleScheduleBundle:ActivityType:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCISimpleScheduleBundle:ActivityType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActivityType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ActivityTypeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

        $this->get('session')->getFlashBag()->add(
            'info',
            $this->get('translator')->trans('%entity%[%id%] has been updated', array(
                '%entity%' => 'ActivityType',
                '%id%'     => $entity->getId()
            ))
        );

        return $this->redirect($this->generateUrl('activitytype_edit', array('id' => $id)));
        
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a ActivityType entity.
     *
     * @Route("/{id}/delete", name="activitytype_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IDCISimpleScheduleBundle:ActivityType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ActivityType entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add(
                'info',
                $this->get('translator')->trans('%entity%[%id%] has been deleted', array(
                    '%entity%' => 'ActivityType',
                    '%id%'     => $id
                ))
            );
        }

        return $this->redirect($this->generateUrl('activitytype'));
    }
    
    /**
     * Display ActivityType deleteForm.
     *
     * @Template()
     */
    public function deleteFormAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IDCISimpleScheduleBundle:ActivityType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActivityType entity.');
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

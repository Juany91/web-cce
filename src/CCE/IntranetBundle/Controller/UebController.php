<?php

namespace CCE\IntranetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CCE\IntranetBundle\Entity\Ueb;
use CCE\IntranetBundle\Form\UebType;

/**
 * Ueb controller.
 *
 */
class UebController extends Controller
{

    /**
     * Lists all Ueb entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IntranetBundle:Ueb')->findAll();

        return $this->render('IntranetBundle:Ueb:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Ueb entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Ueb();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->subirFoto();
            $em->persist($entity);
            $em->flush();

            $entities = $em->getRepository('IntranetBundle:Ueb')->findAll();

            return $this->render('IntranetBundle:Ueb:index.html.twig', array(
                'entities' => $entities,
            ));  }

        return $this->render('IntranetBundle:Ueb:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Ueb entity.
     *
     * @param Ueb $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Ueb $entity)
    {
        $form = $this->createForm(new UebType(), $entity, array(
            'action' => $this->generateUrl('ueb_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Ueb entity.
     *
     */
    public function newAction()
    {
        $entity = new Ueb();
        $form   = $this->createCreateForm($entity);

        return $this->render('IntranetBundle:Ueb:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    
    
    /**
     * Finds and displays a Ueb entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntranetBundle:Ueb')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ueb entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntranetBundle:Ueb:show.html.twig', array(
            'entity'      => $entity,

            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Ueb entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntranetBundle:Ueb')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ueb entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntranetBundle:Ueb:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Ueb entity.
    *
    * @param Ueb $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Ueb $entity)
    {
        $form = $this->createForm(new UebType(), $entity, array(
            'action' => $this->generateUrl('ueb_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Ueb entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntranetBundle:Ueb')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ueb entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ueb_edit', array('id' => $id)));
        }

        return $this->render('IntranetBundle:Ueb:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Ueb entity.
     *
     */
    public function deleteAction( $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IntranetBundle:Ueb')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ueb entity.');
        }
        $em->remove($entity);
        unlink(__DIR__.'/../../../../web/uploads/images/'.$entity->getRutaFoto());
        $em->flush();

        return $this->redirect($this->generateUrl('ueb'));
    }

    /**
     * Creates a form to delete a Ueb entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ueb_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

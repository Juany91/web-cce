<?php

namespace CCE\IntranetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CCE\IntranetBundle\Entity\Galeria;
use CCE\IntranetBundle\Form\GaleriaType;

/**
 * Galeria controller.
 *
 */
class GaleriaController extends Controller
{

    /**
     * Lists all Galeria entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IntranetBundle:Galeria')->findAll();

        return $this->render('IntranetBundle:Galeria:index.html.twig', array(
            'entities' => $entities,

        ));
    }
    /**
     * Creates a new Galeria entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Galeria();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->subirFoto();
            $em->persist($entity);
            $em->flush();

            $entities = $em->getRepository('IntranetBundle:Galeria')->findAll();

            return $this->render('IntranetBundle:Galeria:index.html.twig', array(
                'entities' => $entities,
            ));  }

        return $this->render('IntranetBundle:Galeria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Galeria entity.
     *
     * @param Galeria $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Galeria $entity)
    {
        $form = $this->createForm(new GaleriaType(), $entity, array(
            'action' => $this->generateUrl('galeria_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Adicionar'));

        return $form;
    }

    /**
     * Displays a form to create a new Galeria entity.
     *
     */
    public function newAction()
    {
        $entity = new Galeria();
        $form   = $this->createCreateForm($entity);

        return $this->render('IntranetBundle:Galeria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Galeria entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntranetBundle:Galeria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Galeria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntranetBundle:Galeria:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Galeria entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntranetBundle:Galeria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Galeria entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntranetBundle:Galeria:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Galeria entity.
     *
     * @param Galeria $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Galeria $entity)
    {
        $form = $this->createForm(new GaleriaType(), $entity, array(
            'action' => $this->generateUrl('galeria_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modificar'));

        return $form;
    }
    /**
     * Edits an existing Galeria entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntranetBundle:Galeria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Galeria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('galeria_edit', array('id' => $id)));
        }

        return $this->render('IntranetBundle:Galeria:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Galeria entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IntranetBundle:Galeria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Galeria entity.');
        }
        $em->remove($entity);
        unlink(__DIR__.'/../../../../web/uploads/images/'.$entity->getRutaFoto());
        $em->flush();

        return $this->redirect($this->generateUrl('galeria'));
    }

    /**
     * Creates a form to delete a Galeria entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('galeria_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
            ;
    }
}

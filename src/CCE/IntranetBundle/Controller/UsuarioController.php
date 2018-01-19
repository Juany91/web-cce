<?php

namespace CCE\IntranetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CCE\IntranetBundle\Entity\Usuario;
use CCE\IntranetBundle\Form\UsuarioType;

/**
 * Usuario controller.
 *
 */
class UsuarioController extends Controller
{

    /**
     * Lists all Usuario entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IntranetBundle:Usuario')->findAll();

        return $this->render('IntranetBundle:Usuario:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Usuario entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Usuario();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $entity->setEnabled($form->get("enabled")->getData());
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('usuario_show', array('id' => $entity->getId())));
        }

        return $this->render('IntranetBundle:Usuario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Usuario entity.
     *
     * @param Usuario $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Usuario $entity)
    {
        $form = $this->createForm(new UsuarioType('proyecto_empresabundle_registertype'), $entity, array(
            'action' => $this->generateUrl('usuario_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Usuario entity.
     *
     */
    public function newAction()
    {
        $entity = new Usuario();

        $form = $this->createForm(new UsuarioType('proyecto_empresabundle_registertype'), $entity, array(
            'action' => $this->generateUrl('usuario_create'),
            'method' => 'POST',
        ));


        $form->add('submit', 'submit', array('label' => 'Adicionar'));

        return $this->render('IntranetBundle:Usuario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function getExistingRoles()
    {
        $roleHierarchy = $this->container->getParameter('security.role_hierarchy.roles');
        $roles = array_keys($roleHierarchy);

        foreach ($roles as $role) {
            $theRoles[$role] = $role;
        }
        return $theRoles;
    }

    /**
     * Finds and displays a Usuario entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntranetBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntranetBundle:Usuario:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Usuario entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntranetBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }
        $editForm = $this->createEditForm($entity);
        $editForm->get('enabled')->setData($entity->getEnabled()[0]);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('IntranetBundle:Usuario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Usuario entity.
     *
     * @param Usuario $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Usuario $entity)
    {
        $form = $this->createForm(new UsuarioType('proyecto_empresabundle_registertype'), $entity, array(
            'action' => $this->generateUrl('usuario_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modificar'));

        return $form;
    }
    /**
     * Edits an existing Usuario entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IntranetBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        $entity->setEnabled($editForm->get("enabled")->getData());
        if ($editForm->isValid()) {
            $em->flush();
            $this->addFlash(
                'notice',
                'Se ha modificado correctamente.'
            );
            return $this->redirect($this->generateUrl('usuario_edit', array('id' => $id)));
        }

        return $this->render('IntranetBundle:Usuario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Usuario entity.
     *
     */
    public function deleteAction( $id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IntranetBundle:Usuario')->find($id);


        $em->remove($entity);
        $em->flush();
        $this->addFlash(
            'notice',
            'Se ha eliminado correctamente.'
        );


        return $this->redirect($this->generateUrl('usuario'));
    }

    /**
     * Creates a form to delete a Usuario entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usuario_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
            ;
    }
}

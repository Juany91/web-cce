<?php

namespace CCE\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('IntranetBundle:Default:index.html.twig', array('name' => $name));
    }
    public function intranetaAction()
    {
        return $this->render('IntranetBundle:Default:intranet.html.twig', array());
    }

   

    public function intranetAction()
    {


        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('IntranetBundle:Ueb')->findAll();

        return $this->render('IntranetBundle:Default:intranet.html.twig', array(
            'entities' => $entities,
        ));

    }

   

}

<?php

namespace CCE\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MetasController extends Controller{

    public function metasAction() {


        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('IntranetBundle:Ueb')->findAll();
        return $entities;

    }

}

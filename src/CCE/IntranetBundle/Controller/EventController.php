<?php
/**
 * Created by PhpStorm.
 * User: jmanuel
 * Date: 18/12/2017
 * Time: 9:48
 */

namespace CCE\IntranetBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    public function UebProdAction($max = 3)
    {
        // hacer una llamada a la base de datos u otra lógica
        // obtener un número "$max" de artículos recientes
        $em = $this->getDoctrine()->getEntityManager();
        $articles=$em->createQuery('SELECT u FROM IntranetBundle:Ueb u WHERE u.tipo=:tipo');
        $articles->setParameter('tipo', 'Unidades Productivas');

        return $this->render(
            'IntranetBundle:Default:recent_list.html.twig',
            array('articles' => $articles->getResult())
        );
    }

    public function UebApoyoAction($max = 3)
    {
        // hacer una llamada a la base de datos u otra lógica
        // obtener un número "$max" de artículos recientes
        $em = $this->getDoctrine()->getEntityManager();
       // $type="Unidades de Apoyo";
        $articles=$em->createQuery('SELECT u FROM IntranetBundle:Ueb u WHERE u.tipo=:tipo');
        $articles->setParameter('tipo', 'Unidades de Apoyo');
        return $this->render(
            'IntranetBundle:Default:recent_list.html.twig',
            array('articles' => $articles->getResult())
        );
    }

    public function NoticiasAction($max = 3)
    {
        // hacer una llamada a la base de datos u otra lógica
        // obtener un número "$max" de artículos recientes
        $em = $this->getDoctrine()->getEntityManager();
      //  $articles = $em->getRepository('IntranetBundle:Noticias')->findAll();
        $articles=$em->createQuery('SELECT n FROM IntranetBundle:Noticias n ORDER BY n.id DESC ');

        return $this->render(
            'IntranetBundle:Default:noticias_list.html.twig',
            array('articles' => $articles->getResult())
        );
    }
    

    public function ProductoAction($max = 3)
    {
        // hacer una llamada a la base de datos u otra lógica
        // obtener un número "$max" de artículos recientes
        $em = $this->getDoctrine()->getEntityManager();
      //  $articles = $em->getRepository('IntranetBundle:Producto')->findAll();

        $articles = $em->getRepository('IntranetBundle:Ueb')->findAll();
        //$articles=$em->createQuery('SELECT p FROM IntranetBundle:Producto p Order By p.idueb ');
        $productos = $em->getRepository('IntranetBundle:Producto')->findAll();

        return $this->render(
            'IntranetBundle:Default:prod_list.html.twig',
            array('articles' => $articles,
                'productos' => $productos)
        );
    }

    public function ProyectoAction($max = 3)
    {
        // hacer una llamada a la base de datos u otra lógica
        // obtener un número "$max" de artículos recientes
        $em = $this->getDoctrine()->getEntityManager();
        $articles = $em->getRepository('IntranetBundle:Proyecto')->findAll();

        return $this->render(
            'IntranetBundle:Default:proyect_list.html.twig',
            array('articles' => $articles)
        );
    }
    

    public function ProductoUebAction($max = 3)
    {
        // hacer una llamada a la base de datos u otra lógica
        // obtener un número "$max" de artículos recientes
        $em = $this->getDoctrine()->getEntityManager();
      //  $articles = $em->getRepository('IntranetBundle:Producto')->findAll();

        $articless=$em->createQuery('SELECT p FROM IntranetBundle:Producto p Order By p.idueb ');

        return $this->render(
            'IntranetBundle:Default:produeb_list.html.twig',
            array('articless' => $articless->getResult())
        );
    }



    public function ProductoPorNombreUebAction($max = 3)
    {
        // hacer una llamada a la base de datos u otra lógica
        // obtener un número "$max" de artículos recientes
        $em = $this->getDoctrine()->getEntityManager();
        //  $articles = $em->getRepository('IntranetBundle:Producto')->findAll();

        $articless=$em->createQuery('SELECT p FROM IntranetBundle:Producto p Order By p.idueb ');

        return $this->render(
            'IntranetBundle:Default:produeb_list.html.twig',
            array('articless' => $articless->getResult())
        );
    }


}
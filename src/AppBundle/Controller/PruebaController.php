<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Curso;

class PruebaController extends Controller
{
    
    public function verAction(Request $request)
    {
     return $this->redirect($this->container->get("router")->getContext()->getBaseUrl()."/prueba/es/safasd/3"); /* CARGAR UNA RUTA DE MANERA DIRECTA EL CODIGO HASTA BASE URL ES PARA ESO PARA COGER LA BASE URL */
     return $this->redirect($this->generateUrl("rutaparametro"));/* CARGAR UNA RUTA CON UN NOMBRE CONOCIDO*/
    /* otra opcion para  cargar LA BASE URL MAS SIMPLE ES $request->getBaseUrl()*/

        echo __DIR__;
        die();
        
    }

      public function nameAction(Request $request,$name,$page)
    {
        return $this->render('AppBundle:Prueba:name.html.twig', array('nombre' => $name,'page' => $page ));
    }


    public function variablesgetypostAction(Request $request,$name,$page)
    {
    	var_dump($request->query->get("hola")); /* esto solo recoge get */
    	var_dump($request->get("holapost"));    /* esto recoge get y post*/
    	die();
    }

    public function enviarproductosAction(Request $request)
    {
        $productos= array( array("producto"=>"Consola","precio"=>50),
        array("producto"=>"Consola2","precio"=>60),
        array("producto"=>"Consola3","precio"=>70),
        array("producto"=>"Consola4","precio"=>770)
       );

        $fruta=array("manzana"=>"dulce","platano"=>"suave");



        return $this->render('AppBundle:Prueba:array.html.twig', array('productos'=>$productos,'fruta'=>$fruta));
    }


    public function createAction(){

        $curso = new Curso() ;
        $curso->setTitulo("curso symfony");
        $curso->setDescripcion("descripcion del curso");
        $curso->setPrecio("83");


        $em =$this->getDoctrine()->getManager();
        $em->persist($curso);
        $flush=$em->flush();


        if ($flush != null) {
            echo "el curso no se ha creado bien";
        }
        else{
            echo "Curso añadido correctamente";
        }

        die();
    }


    public function readAction(){

        $em =$this->getDoctrine()->getManager();
        $cursos_repositorio = $em->getRepository("AppBundle:Curso");
        $cursos=$cursos_repositorio->findAll();

        foreach ($cursos as $curso) {

            echo $curso->getTitulo()."<br>";
            echo $curso->getDescripcion()."<br>";
            echo $curso->getPrecio()."<br><hr>";
            
        }
        die();

  

        
    }
}


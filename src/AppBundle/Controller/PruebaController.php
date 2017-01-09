<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Curso;
use AppBundle\Form\CursoType;

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
        $curso->setPrecio("85");


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

       // Con la funcion findBy podemos hacer un where con arrays DEVUELVE ARRRAY
       // $cursos=$cursos_repositorio->findBy(array('precio'=>83));


       // Con la funcion findOneBy podemos hacer un where pero nos devuelve UN SOLO VALOR
       // $cursos=$cursos_repositorio->findOneBy(array('precio'=>85));

       



       foreach ($cursos as $curso) {

            echo $curso->getTitulo()."<br>";
            echo $curso->getDescripcion()."<br>";
            echo $curso->getPrecio()."<br><hr>";
            
        }
        die();

  

        
    }

    public function updateAction($id,$titulo,$descripcion,$precio){
        $em= $this->getDoctrine()->getManager();
        $cursos_repositorio=$em->getRepository("AppBundle:Curso");

        $curso = $cursos_repositorio->find($id);
        $curso->setTitulo($titulo);
        $curso->setDescripcion($descripcion);
        $curso->setPrecio($precio);

        $em->persist($curso);
        $flush=$em->flush();

        if ($flush != null) {
            echo "el curso no se ha actualizado bien";
        }
        else{
            echo "Curso actualizado correctamente";
        }

        die();


    }

      public function deleteAction($id){
        $em= $this->getDoctrine()->getManager();
        $cursos_repositorio=$em->getRepository("AppBundle:Curso");

        $curso = $cursos_repositorio->find($id);

        $em->remove($curso);
        $flush=$em->flush();

        if ($flush != null) {
            echo "el curso no se ha eliminado bien";
        }
        else{
            echo "Curso eliminado correctamente";
        }

        die();


    }


    public function sqlnativoAction(){

     $em= $this->getDoctrine()->getManager();

     $db = $em->getConnection();

     $query="SELECT * FROM cursos";

     $stmt = $db->prepare($query);

     $params = array();

     $stmt->execute($params);

     $cursos= $stmt->fetchAll();

     foreach ($cursos as $curso) {
        echo $curso["titulo"]."<br/>";
        echo $curso["descripcion"]."<br/>";
        echo $curso["precio"]."<br/>";
     }
     die();
    }


    public function dqlAction(){

     $em= $this->getDoctrine()->getManager();

     $query=$em->createQuery("SELECT c FROM AppBundle:Curso c WHERE c.precio >= :precio")->setParameter("precio","83");

     $cursos=$query->getResult();

     foreach ($cursos as $curso) {

        echo $curso->getTitulo()."<br/>";
         echo $curso->getDescripcion()."<br/>";
          echo $curso->getPrecio()."<br/>";
       
       
     }

     die();

    }


    public function querybuilderAction(){

    $em= $this->getDoctrine()->getManager();

    $cursos_repositorio=$em->getRepository("AppBundle:Curso");

    $query=$cursos_repositorio->createQueryBuilder("c")->where("c.precio >= :precio")->setParameter("precio","83")->getQuery();


    $cursos=$query->getResult();



        foreach ($cursos as $curso) {

        echo $curso->getTitulo()."<br/>";
         echo $curso->getDescripcion()."<br/>";
          echo $curso->getPrecio()."<br/>";
       
       
       }

     die();


    }


public function repositorioAction(){

$em=$this->getDoctrine()->getManager();

$cursos_repositorio=$em->getRepository("AppBundle:Curso");

$cursos=$cursos_repositorio->getCursos();

        foreach ($cursos as $curso) {

        echo $curso->getTitulo()."<br/>";
        echo $curso->getDescripcion()."<br/>";
        echo $curso->getPrecio()."<br/>";
       
       
       }

     die();

}

public function formulariocursoAction(Request $request){

    $curso = new Curso();

    $form=$this->createForm(CursoType::class,$curso);

    $form->handleRequest($request);

    if($form->isValid()){

        $status=" Formulario válido";
        $data=array(
            "titulo"=> $form->get("titulo")->getData(),
            "descripcion"=> $form->get("descripcion")->getData(),
            "precio"=>$form->get("precio")->getData()

            );
    }

    else{
       $status=null;
       $data=null;

    }

    return $this->render('AppBundle:Prueba:form.html.twig', array('form' => $form->createView(),"status"=>$status,"data"=>$data));


}








}


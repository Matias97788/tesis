<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Servicio;
use App\Entity\Codigo;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Twilio\Rest\Client;
/**
     * @Route("/inicio")
     */
class BlogController extends AbstractController
{

    

  
/**
     * @Route("/",name="inicio" ,methods={"GET"})
     */
 public function inicio()
    {
        
        return $this->render('inicio.html.twig');
            
        
    }
  /**
     * @Route("/registro",name="registro" ,methods={"GET"})
     */
 public function registro()
 {
     
     return $this->render('registration/register.html.twig');
         
     
 }

    /**
     * @Route("/categoria",name="categoria" ,methods={"GET"}) 
     */
 public function categoria()
    {
        
        return $this->render('categoria.html.twig');
            
        
    }

    /**
     * @Route("/perfil",name="perfil" , methods={"GET"})
     */
 public function perfil()
    {
        
        return $this->render('perfil.html.twig');
            
        
    }

    /**
     * @Route("/error",name="error",methods={"GET"})
     */
 public function error()
    {
        
        return $this->render('error.html.twig');
            
        
    }
    
    /**
     * @Route("/funerarias",name="funerarias",methods={"GET"})
     */
 public function funerarias()
    {
        
        $em = $this->getDoctrine()->getManager();
        $funerary = $em->getRepository(Servicio::class)->findBy(['idCategoria'=>1]);
        return $this->render('funerarias.html.twig',array(
           'vista'=>$funerary
   
   
        ));
        
    }
    
    /**
     * @Route("/florerias",name="florerias",methods={"GET"})
     */
 public function florerias()
    {
        $em = $this->getDoctrine()->getManager();
        $flor = $em->getRepository(Servicio::class)->findBy(['idCategoria'=>2]);
        return $this->render('florerias.html.twig',array(
           'vista'=>$flor
   
   
        ));
        
            
        
    }
    /**
     * @Route("/cementerios",name="cementerios",methods={"GET"})
     */
 public function cementerios()
    {
        $em = $this->getDoctrine()->getManager();
        $cementery = $em->getRepository(Servicio::class)->findBy(['idCategoria'=>3]);
        return $this->render('cementerios.html.twig',array(
           'vista'=>$cementery
   
   
        ));
        
       
            
        
    }
    /**
     * @Route("/parques",name="parques",methods={"GET"})
     */
 public function parques()
    {
        $em = $this->getDoctrine()->getManager();
        $park = $em->getRepository(Servicio::class)->findBy(['idCategoria'=>4]);
        return $this->render('parques.html.twig',array(
           'vista'=>$park
   
   
        ));
        
        
            
        
    }
    /**
     * @Route("/crematorios",name="crematorios",methods={"GET"})
     */
 public function crematorios()
    {
        $em = $this->getDoctrine()->getManager();
        $crma = $em->getRepository(Servicio::class)->findBy(['idCategoria'=>5]);
        return $this->render('crematorios.html.twig',array(
           'vista'=>$crma
   
   
        ));
        
            
        
    }
    /**
     * @Route("/otros",name="otros",methods={"GET"})
     */
 public function otros()
    {
        
        return $this->render('otros.html.twig');
            
        
    }
    
    /**
     * @Route("/tramitess",name="tramites_index" ,methods={"GET"})
     */
 public function tramites_index()
    {
        
        return $this->render('tramites/index.html.twig');
            
        
    }
    /**
     * @Route("/tramites",name="tramites" ,methods={"GET"})
     */
 public function tramites()
    {
        
        return $this->render('tramites.html.twig');
            
        
    }

    /**
     * @Route("/new",name="multimedia_new" ,methods={"GET"})
     */
 public function multimedia_index()
    {
        
        return $this->render('multimedia/multimedia.html.twig');
            
        
    }
    
    
    /**
     * @Route("/new",name="obituario_index" ,methods={"GET"})
     */
 public function obituario_index()
    {
        
        return $this->render('obituario/index.html.twig');
            
        
    }
    /**
     * @Route("/obituarios",name="obituarios" ,methods={"GET"})
     */
 public function obituarios()
    {
        
        return $this->render('obituarios.html.twig');
            
        
    }
    
    /**
     * @Route("/new",name="otros_index" ,methods={"GET"})
     */
 public function otros_index()
 {
     
     return $this->render('otros/index.html.twig');
         
     
 }

 /**
     * @Route("/recuperar",name="recuperar" ,methods={"GET"})
     */
    public function recuperar()
    {
        
        return $this->render('recuperar.html.twig');
            
        
    }
   

    /**
     * @Route("/clavenueva",name="clavenueva" ,methods={"GET"})
     */
    public function clavenueva()
    {
        
        return $this->render('nuevaclave.html.twig');
            
        
    }
    /**
     * @Route("/grafico",name="grafico" ,methods={"GET"})
     */
    public function grafico()
    {
        
        return $this->render('graficos.html.twig');
            
        
    }
       /**
     * @Route("/numero", name="numero" ,methods={"GET"})
     */
    public function numero(Request $request)
    {
        $correo= $request->get('correo');
        $telefono= $request->get('telefono');  


            //hacemos la validacion

            $repositorio =  $this->getDoctrine()->getRepository(User::Class);
            $usuario = $repositorio->findOneBy(['email'=> $correo]);
            $telefono='+56979428207';
            //Genera numero random y numero unico
            $random= rand(1,10000);
            $secure_number = uniqid();
            //guardar en BD
            if($usuario){
            $codigo=new Codigo();
            $codigo->setCodigounico($secure_number);
            $codigo->setCodigorandom($random);
            $codigo->setIdUser($usuario);
            $em=$this->getDoctrine()->getManager();
            $em->persist($codigo);
            $em->flush();
            


         
            
            $sid = 'ACab8cf5ea0d9fda8fe3e278aa42971964';
            $token = '3bd525c6d89216887b4b7a44e74e53f4';
            $client = new Client($sid, $token);
            
            // Use the client to do fun stuff like send text messages!
            $client->messages->create(
                // the number you'd like to send the message to
                $telefono,
                array(
                    // A Twilio phone number you purchased at twilio.com/console
                    'from' => '+12029182913',
                    // the body of the text message you'd like to send
                    'body' =>'tu numero es : '.($random),
                )
            );
            return $this->render('codigo.html.twig',array('token'=>$secure_number));
          }else{
            echo '<script type="text/javascript">alert("Correo invalido");</script>';
            return $this->render('recuperar.html.twig');
          }
        
      
            
        
    }
       
   

/**
     * @Route("/p",name="codigo" ,methods={"GET"})
     */
    public function procesarcodigo(Request $request)
    {
        $random = $request->get('codigo');
        $secure_number= $request->get('token');  


            //hacemos la validacion

            $repositorio =  $this->getDoctrine()->getRepository(Codigo::Class);
            $codigo = $repositorio->findOneBy(['codigorandom'=> $random]);
            $token = $repositorio->findOneBy(['codigounico'=> $secure_number]);
            if(!$codigo){
                echo '<script type="text/javascript">alert("Bien!");</script>';
              if(!$token){
                echo '<script type="text/javascript">alert("Bien echo!");</script>';
                return $this->render('nuevaclave.html.twig');
              }else{
                echo '<script type="text/javascript">alert("Mal!");</script>';
              }
            }else{
                echo '<script type="text/javascript">alert("Codigo erroneo!");</script>';
            }
      
            
        
    }

    

   
}






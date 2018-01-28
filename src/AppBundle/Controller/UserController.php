<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{
    /**
     * @Route("/user/register" , name="register")
     */
     public function register(Request $request){
        return $this->render('@App/user/register.html.twig');
     }

     /**
      * @Route("/user/addUser" , name="addUser")
      * @Method({"POST"})
      */
      public function addUser(Request $request,UserPasswordEncoderInterface $encoder){

          $user = new User();
          $user->setUsername($request->request->get('username'));
          $user->setPassword($request->request->get('password'), $encoder);
          $user->setEmail($request->request->get('email'));
          $user->setAge($request->request->get('age'));

          $em  = $this->getDoctrine()->getManager();
          $em->persist($user);
          $em->flush();

         return $this->redirectToRoute('login');
      }
}

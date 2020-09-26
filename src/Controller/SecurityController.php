<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils,Request $request,RouterInterface $router): Response
    {

        if($request->getSession()->get('intento') &&  $request->getSession()->get('intento') >= 3){
            $request->getSession()->set('intento',1);
           return new RedirectResponse($router->generate('error'));
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login.html.twig',  [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/login/redirect", name="app_login_redirect")
     */
    public function loginredirect(Request $request)
    {
        return $this->render('security/[plantilla].html.twig',  ['intento' => $request->getSession()->get('intento',false)]);
    }

    /**
     * @Route("/login/recuperar/password", name="app_login_recuperar_password")
     */
    public function loginrecuperarpassword(Request $request)
    {
        return $this->render('security/[plantilla].html.twig',  ['intento' => $request->getSession()->get('intento',false)]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(Request $request)
    {
      return $this->render('inicio.html.twig');
    }
}

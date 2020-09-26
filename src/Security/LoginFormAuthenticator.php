<?php

namespace App\Security;

use App\Repository\UserRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{

    private $userRepository;
    private $router;
    private $csrfTokenManager;
    private $passwordEncoder;
    private $request;
    


    public function __construct(UserRepository $userRepository,RouterInterface $router,CsrfTokenManagerInterface $csrfTokenManager,UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->router = $router;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    //primer metedo que se ejecuta
    public function supports(Request $request)
    {
        return $request->attributes->get('_route') === 'app_login'
            && $request->isMethod('POST');
    }

        //segundo metedo que se ejecuta
    public function getCredentials(Request $request)
    {
        //asi se obtienen las credenciales que llegan del formulario del login
        $credenciales = [
            'email'=> $request->request->get('email'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token')
            ];

        //aca se guarda la informacion en la session
        $request->getSession()->set(Security::LAST_USERNAME, $credenciales['email']);
        $this->request = $request;

        return $credenciales;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
       // $user = $this->userRepository->findOneBy(['email'=>$credentials['email']]);
       // return $this->userRepository->findOneBy(['email'=>$credentials['email']]);

        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            $this->intentosfallidos($this->request);
            throw new InvalidCsrfTokenException();
        }

        $user = $this->userRepository->findOneBy(['email'=>$credentials['email']]);
        if (!$user) {
            $this->intentosfallidos($this->request);
            // fail authentication with a custom error
            throw new CustomUserMessageAuthenticationException('Username could not be found.');
        }

        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $verifica = $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
        if(!$verifica){
            $this->intentosfallidos($this->request);
        }

        return $verifica;
    }

    /*public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        if($this->intentosfallidos($request)){
            return  new RedirectResponse($this->router->generate('app_login_redirect'));//$request->getSession()->generate('app_login_redirect');
        }

        return null;
    }*/

    /**
     * @param Request $request
     * @param bool $redirect
     * @return bool
     * Esta funcion lo que hace es validar los intentos fallidos del usuario y envia aviso para redireccionarlo a la pagina de bloqueo
     * en caso que fuera necesario.
     */
    private function  intentosfallidos(Request $request){
        $intento = $request->getSession()->get('intento');
        $intento++;
        $request->getSession()->set('intento',$intento);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
       return new RedirectResponse($this->router->generate('perfil'));
    }

   /* public function start(Request $request, AuthenticationException $authException = null)
    {
        // todo
    }

    public function supportsRememberMe()
    {
        // todo
    }*/

    protected function getLoginUrl()
    {
        // TODO: Implement getLoginUrl() method.
        return $this->router->generate('app_login');
    }


}

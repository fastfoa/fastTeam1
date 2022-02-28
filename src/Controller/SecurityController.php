<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $u = $this->getUser();

        //$t = $this->getDoctrine()->getManager()->getRepository(User::class)->find($u);
        if ($u) {
            //dd( $u );
            //$enabled = $u->getProfilEnabled();
            //if ( $enabled == 0 )
            //    return $this->redirectToRoute('logout');;
            //return $this->redirectToRoute('dashOFPrincipal');
            return $this->redirectToRoute('profilEnabled');
            }
        
        // $profil = getSQLSingle( 
        //     "SELECT profil_enabled as p
        //      FROM  user
        //      WHERE email='$t'");
        //      return new JsonResponse($profil);

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $erreur = "Email ou mot de passe incorrect";
       
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error, 'erreur' => $erreur]);
        // return $this->redirectToRoute('rgpdForm', ['last_username' => $lastUsername,  'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    function checkRGPD()
    {
        $user = $this->getUser();
        if ( $user == null )
           return $this->redirectToRoute( "login" );
         if ( !$user->getRGPDOK())
            return $this->redirectToRoute( "rgpdForm" );
        return null;
    }



}

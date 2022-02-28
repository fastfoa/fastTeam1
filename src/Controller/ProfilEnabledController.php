<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ProfilEnabledController extends AbstractController
{
    /**
     * @Route("/profil/enabled", name="profil_enabled")
     */
    public function profilEnabled(): Response
    {
        $user = $this->getUser();
        $enabled = $user->getProfilEnabled();
        
        if ($enabled)
            return $this->redirectToRoute('rgpdForm');

        return $this->redirectToRoute( 'app_logout' );
    }
}

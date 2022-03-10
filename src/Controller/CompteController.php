<?php
/*
    controlleur pour modifier ses informations personelles 
    7/03/2022

*/

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\MonCompteADMINType;
use App\Form\MonCompteAppType;
use App\Form\MonCompteEntrepriseType;
use App\Form\MonCompteFormateurType;
use App\Form\MonCompteINDType;
use App\Form\MonCompteMAType;
use App\Form\MonCompteOFType;

class CompteController extends AbstractController
{
    public function checkRGPD()
    {
        $user = $this->getUser();
        if ($user == null) {
            return $this->redirectToRoute("login");
        }
        if (!$user->getRGPDOK()) {
            return $this->redirectToRoute("rgpdForm");
        }
        return null;
    }
    
    /**
     * @Route("/compte", name="compte")
     */
    public function index(): Response
    {
        $ret = $this->checkRGPD();
        if ($ret) {
            return $ret;
        }
        
        $user = $this->getUser();
       
        return $this->render(
            'compte/compte.html.twig',
            [
        'user' => $user
    ]
        );
    }

    public function modifInfoMonCompte(Request $request): Response
    {
        $ret = $this->checkRGPD();
        if ($ret) {
            return $ret;
        }

        $contact = $this->getUser();
        $role = $contact->getRoleString();

        $type =  null;
        $twig = '';

        // définir le type de formaulaire et le twig en rapport 
        // au type du compte user
        if ($role == 'ROLE_APP') {
            $type =  MonCompteAppType::class;
            $twig = 'compte/mon_compte/monCompteApp.html.twig';
            $titre = "Apprenti";
        } elseif ($role == 'ROLE_MA') {
            $type =  MonCompteMAType::class;
            $twig = 'compte/mon_compte/monCompteMA.html.twig';
            $titre = "Maitre d'Apprentissage";
        } elseif ($role == 'ROLE_ENT') {
            $type =  MonCompteEntrepriseType::class;
            $twig = 'compte/mon_compte/monCompteEntreprise.html.twig';
            $titre = "Entreprise";
        } elseif ($role == 'ROLE_FORMATEUR') {
            $type =  MonCompteFormateurType::class;
            $twig = 'compte/mon_compte/monCompteFormateur.html.twig';
            $titre = "Formateur";
        } elseif ($role == 'ROLE_OF') {
            $type =  MonCompteOFType::class;
            $twig = 'compte/mon_compte/monCompteOF.html.twig';
            $titre = "Organisme de Formation";
        } elseif ($role == 'ROLE_IND') {
            $type =  MonCompteINDType::class;
            $twig = 'compte/mon_compte/monCompteIND.html.twig';
            $titre = "Formateur";
        } elseif ($role == 'ROLE_ADMIN') {
            $type =  MonCompteADMINType::class;
            $twig = 'compte/mon_compte/monCompteADMIN.html.twig';
            $titre = "Formateur";
        }

        $form = $this->createForm($type, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine = $this->getDoctrine();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
            return $this->redirectToRoute('compte');
        }
        
        return $this->render($twig, [
            'form' => $form->createView(),
            'menu' => getMenuFromRole($this->getUser()->getRoleString()), //envoye le menu part a port a son role

        ]);
    }
}

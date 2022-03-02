<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Evaluation;
use App\Entity\Competence;
use App\Entity\User;
use App\Entity\Session;
use App\Entity\Formation;
use App\Lib\PDOUtil;;
use App\Form\EvaluationType;
use App\Form\EvaluationAppType;
use App\Form\EvaluationFormateurType;
use App\Form\EvaluationMAType;
use App\Form\EvaluationOFType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class EvaluationController extends AbstractController
{
    /**
     * @Route("/evaluation", name="evaluation")
     */
    public function index(): Response
    {
        return $this->render('evaluation/index.html.twig', [
            'controller_name' => 'EvaluationController',
        ]);
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

    public function saisiEvaluation(Competence $competence, User $app, Request $request): Response
    {

        $login = $this->getParameter('loginDB');
        $pw = $this->getParameter('PasswordDB');

        $user = $this->getUser();
        //dd($user);
        $role='';
        if(!empty($user))
        {
            //$role = $user->getRoles()[0];
            $role= $user->getRoleString();
        }
    
        $message = false;
        $evaluation = new Evaluation();

        $type = EvaluationAppType::class;
        $App = $app;
        $MA = "";
        $Formateur = "";

        if ( $role == "ROLE_APP" )
        {
            $App = $user;
            $MA = getMAFromApprenti($login, $pw, $App->getId() );
            $Formateur = getFormateursFromApprenti($login, $pw, $App->getId() )[0];
            $type = EvaluationAppType::class;
        }   
        else if ( $role == "ROLE_MA" )
        {
            $MA = $user;
            $App = getAppFromMA($login, $pw, $MA->getId() );
            $Formateur = getFormateursFromApprenti($login, $pw, $App->getId() )[0];
            $type = EvaluationMAType::class;
        }
        else if ( $role == "ROLE_FORMATEUR" )
        {
            $Formateur = $user;
            $App = $app;
            $MA = getMAFromApprenti( $login, $pw, $App->getId() );
            $type = EvaluationFormateurType::class;
        }
        else
        {
           $type = EvaluationOFType::class;
           $MA = getMAFromApprenti( $login, $pw, $App->getId() );
           $Formateur = getFormateursFromApprenti($login, $pw, $App->getId() )[0];
        }

        $idSession = getIdSessionFromApprenti( $login, $pw, $App->getId() );
        //dd( $session );
        $nameCompet = $competence->getName();
        $evaluation->setIdCompetence($competence->getId());
        $evaluation->setIdApp($App->getId());
        $evaluation->setIdMA($MA['id']);
        $evaluation->setIdFormateur($Formateur['id']);
        $evaluation->setIdSession($idSession);
        //$evaluation->setNote(1);
      
        $form = $this->createForm( $type, $evaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $doctrine = $this->getDoctrine();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($evaluation);
            $entityManager->flush();
            $message = "le formulaire a bien était pris en compte ";
        }

        return $this->render('evaluation/saisiEvaluation.html.twig', [
                'form' => $form->createView(),
                'nameCompet' => $nameCompet,
                'message' => $message,
                'app'=>$App,
                
            ]);
    }

    public function choiceCompetence(User $app, Session $session, Request $request): Response
    {
        $login = $this->getParameter('loginDB');
        $pw = $this->getParameter('PasswordDB');

        $formationID = $session->getIdFormation();
        $doctrine = $this->getDoctrine();
        $login = $this->getParameter('loginDB');
        $pw = $this->getParameter('PasswordDB');
        $formation = $doctrine->getRepository(Formation::class)->find( $formationID );
        $nomFormation = $formation->getNom();
        $list = getSQLArrayAssoc( $login, $pw,
            "SELECT *  
             FROM  competence as c 
             WHERE c.id_formation=$formationID");
        
        return $this->render('evaluation/choiceCompetence.html.twig', [
            'user' => $app,    
            'session' => $session,    
            'nomFormation' => $nomFormation,    
            'list'=>$list
            ]);
    }
}

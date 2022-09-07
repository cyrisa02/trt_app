<?php

namespace App\Controller;

use App\Entity\Recruiter;
use App\Form\RecruiterType;
use App\Repository\RecruiterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * This controller diplays the index to valid a rectuiter for the consultant
 */
#[Route('/recruteur_a_valider')]
class RecruitertovalidController extends AbstractController
{
    #[Route('/', name: 'app_recruitertovalid_index', methods: ['GET'])]
    public function index(RecruiterRepository $recruiterRepository): Response
    {
        return $this->render('pages/recruiter/indextovalid.html.twig', [
            'recruiters' => $recruiterRepository->findAll(),
        ]);
    }

    
}
<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Form\CandidateType;
use App\Repository\CandidateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * This controller diplays the index to valid a rectuiter for the consultant
 */
#[Route('/candidat_a_valider')]
class CandidatetovalidController extends AbstractController
{
    #[Route('/', name: 'app_candidatetovalid_index', methods: ['GET'])]
    public function index(CandidateRepository $candidateRepository): Response
    {
        return $this->render('pages/candidate/indextovalid.html.twig', [
            'candidates' => $candidateRepository->findAll(),
        ]);
    }

    
}
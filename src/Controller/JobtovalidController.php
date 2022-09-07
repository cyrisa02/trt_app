<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * This controller diplays the index to valid a job for the consultant
 */
#[Route('/annonces_a_valider')]
class JobtovalidController extends AbstractController
{
    #[Route('/', name: 'app_jobtovalid_index', methods: ['GET'])]
    public function index(JobRepository $jobRepository): Response
    {
        return $this->render('pages/job/indextovalid.html.twig', [
            'jobs' => $jobRepository->findAll(),
        ]);
    }

    
}
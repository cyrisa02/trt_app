<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Form\CandidateType;
use App\Repository\JobRepository;
use App\Repository\UserRepository;
use App\Repository\CandidateRepository;
use App\Repository\RecruiterRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CandidatureRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * This Controller displays the candidates of one recruiter
 */
#[Route('/vos_candidats')]
class CandidateRecruiterController extends AbstractController
{
    #[Route('/', name: 'app_yourcandidate_index', methods: ['GET'])]
    public function index(CandidateRepository $candidateRepository, CandidatureRepository $candidatureRepository, JobRepository $jobRepository, RecruiterRepository $recruiterRepository): Response
    {

        /** @var User $user */
        $user = $this->getUser();
        $recruiter = $user->getRecruiter();  
        
        return $this->render('pages/candidate/indexforrecruiter.html.twig', [
            'candidates' => $candidateRepository->findByRecruiter($recruiter),
           // 'candidatures' =>
           // $candidatureRepository->findAll(),
           // 'jobs'=>
           // $jobRepository->findByUser($recruiter),
            'recruiters'=> $recruiterRepository->findAll(),

        ]);
    }

    #[Route('/consult', name: 'app_candidate_consult_index', methods: ['GET'])]
    public function indexconsult(CandidateRepository $candidateRepository): Response
    {
        return $this->render('pages/candidate/indexconsult.html.twig', [
            'candidates' => $candidateRepository->findAll(),
        ]);
    }

//     #[Route('/creation', name: 'app_candidate_new', methods: ['GET', 'POST'])]
//     public function new(Request $request, CandidateRepository $candidateRepository): Response
//     {
//         $candidate = new Candidate();
//         $form = $this->createForm(CandidateType::class, $candidate);
//         $form->handleRequest($request);
//         $image= 'test.png';

//         if ($form->isSubmitted() && $form->isValid()) {
            
//             $file = $request->files->get('candidate')['my_file'];
//             $uploads_directory = $this->getParameter('uploads_directory');

//             $filename = md5(uniqid()) . '.' . $file->guessExtension();

            

//             $file->move(
//                 $uploads_directory,
//                 $filename
//             );
// // Comment sauveagrder en BD, champ cvName?
//         $candidate->setCvName($filename);
//         $candidateRepository->add($candidate, true);

//             return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
//         }

//         return $this->renderForm('pages/candidate/new.html.twig', [
//             'candidate' => $candidate,            
//             'form' => $form,
//             'image' => $image,
//         ]);
//     }

//     #[Route('/{id}', name: 'app_candidate_show', methods: ['GET'])]
//     public function show(Candidate $candidate): Response
//     {
//         return $this->render('pages/candidate/show.html.twig', [
//             'candidate' => $candidate,
//         ]);
//     }

// #[Route('/add', name: 'app_candidate_add', methods: ['GET', 'POST'])]
// public function add(EntityManagerInterface $manager, Request $request, Candidate $candidate)
// {
//     $form = $this->createForm(CandidateType::class);
//      $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $candidate = $form->getData();

//             $cv = $candidate->getCv();

//             $file = $cv->getFile();

//             $name = md5(uniqid()).  '.'.$file->guessExtension();

//             $file->move('../', $name);

//             $cv->setName($name);


//             $manager->persist($candidate);
//             $manager->flush();

//             $this->addFlash(
//                 'notice',
//                 'Votre profil a été mis à jour'

//             );
//             return $this->redirectToRoute('home.index');
//         }
//         return $this->render('pages/candidate/add.html.twig', [
//             'form' => $form->createView(),
//         ]);
// }


    // #[Route('/{id}/edition', name: 'app_candidate_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Candidate $candidate, CandidateRepository $candidateRepository): Response
    // {
    //     $form = $this->createForm(CandidateType::class, $candidate);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $candidateRepository->add($candidate, true);

    //         return $this->redirectToRoute('app_candidate_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('pages/candidate/edit.html.twig', [
    //         'candidate' => $candidate,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_candidate_delete', methods: ['POST'])]
    // public function delete(Request $request, Candidate $candidate, CandidateRepository $candidateRepository): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$candidate->getId(), $request->request->get('_token'))) {
    //         $candidateRepository->remove($candidate, true);
    //     }

    //     return $this->redirectToRoute('app_candidate_index', [], Response::HTTP_SEE_OTHER);
    // }
}
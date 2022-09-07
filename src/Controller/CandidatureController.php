<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Form\JobContactType;
use App\Form\CandidatureType;
use App\Service\MailerService;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use App\Repository\CandidatureRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

#[Route('/candidature')]
class CandidatureController extends AbstractController
{
    #[Route('/', name: 'app_candidature_index', methods: ['GET'])]
    public function index(CandidatureRepository $candidatureRepository): Response
    {
        return $this->render('pages/candidature/index.html.twig', [
            'candidatures' => $candidatureRepository->findAll(),
            
        ]);
    }

    #[Route('/creation', name: 'app_candidature_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CandidatureRepository $candidatureRepository): Response
    {
        $candidature = new Candidature();
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidatureRepository->add($candidature, true);
            
        $this->addFlash('success', 'Votre candidature a été envoyée avec succès');
        
            return $this->redirectToRoute('app_candidature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/candidature/new.html.twig', [
            'candidature' => $candidature,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_candidature_show', methods: ['GET'])]
    public function show(Candidature $candidature): Response
    {
        return $this->render('pages/candidature/show.html.twig', [
            'candidature' => $candidature,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_candidature_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidature $candidature, CandidatureRepository $candidatureRepository, MailerInterface $mailer ): Response
    {
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidatureRepository->add($candidature, true);
           // $mailMessage = $candidature->getUser;
           $mailMessage='coucou';
          //  $mailer->sendEmail(content: $mailMessage);
          $email = (new TemplatedEmail())
        ->from('cyril.gourdon.02@gmail.com')
        ->to('cyrisa02.test@gmail.com')
        // code pour avoir accès à l'adresse test:    1970studi!
        // 
        //Pour le recruteur il faut envoyer
        //->to($candidature->getUser()->getRecruiter()->getEmail())// à mettre en place pour la production 
       // ->attach(fopen($candidature->getUser()->getCandidate()->getCvName()))


        ///
        //addTo('ajouterunenvelleadresse@gmail.com)
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com') si on veut une autre adresse de réception des réponse
        //->priority(Email::PRIORITY_HIGH)
        
        ->subject('Modification du statut de candidature')
       //->text('Vvotre candidature a été validée');
       ->htmlTemplate('emails/candidatureanswer.html.twig')
        ->context([
            'candidature'=>$candidature
        ]);


        $mailer->send($email);

        $this->addFlash('success', 'Votre message a été envoyé');


            return $this->redirectToRoute('app_candidature_index', [], Response::HTTP_SEE_OTHER);
        }
    

        return $this->renderForm('pages/candidature/edit.html.twig', [
            'candidature' => $candidature,
            'form' => $form ,
            
        ]);
    }

    #[Route('/details/{id}', name: 'details', methods: ['GET','POST'])]
    public function details($id, CandidatureRepository $candidatureRepository, Request $request)
    {
        $candidature = $candidatureRepository->findOneBy(['id'=>$id]);

        if(!$candidature){
            throw new NotFoundHttpException('Pas d\'annonce trouvée');
        }

        $form = $this->createForm(JobContactType::class);

        $contact = $form->handleRequest($request);
        
        return $this->renderForm('pages/candidature/details.html.twig', [
            'candidature'=>$candidature,
            'form'=>$form->createView()
        ]);
    }

    #[Route('/{id}', name: 'app_candidature_delete', methods: ['POST'])]
    public function delete(Request $request, Candidature $candidature, CandidatureRepository $candidatureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidature->getId(), $request->request->get('_token'))) {
            $candidatureRepository->remove($candidature, true);
        }

        return $this->redirectToRoute('app_candidature_index', [], Response::HTTP_SEE_OTHER);
    }
}
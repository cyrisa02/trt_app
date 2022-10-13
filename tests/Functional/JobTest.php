<?php

namespace App\Tests\Functional;

use App\Entity\Job;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JobTest extends WebTestCase
{
    public function testJob(): void
    {
        $client = static::createClient();

        // Récupérer l'urlgenerator
        $urlGenerator = $client->getContainer()->get('router');

        // Récup entity manager, il faut être connecté , 79=user recruiter

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 79);

        $client->loginUser($user);

        // Se rendre sur la page de création d'un franchisé
        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('app_job_new') );

        // Gérer le formulaire
        $form = $crawler->filter("form[name=registration_form_type_job]")->form([
            'registration_form_type_job[title]' => "Société",
            'registration_form_type_job[workPlace]' => "Soissons",
            'registration_form_type_job[description]' => "Charcutier",
            'registration_form_type_jobble]' => True,
            'registration_form_type_job[schedule]' => "35h/semaine",
            'registration_form_type_job[salary]' => "20k€/an",            
        ]);
        $client->submit($form);

        //Gérer la redirection

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        // Gérer l'alert box
        $this->assertSelectorTextContains('div.alert-success', 'Votre demande a été enregistrée avec succès');

        $this->assertRouteSame('home.index');

        // Bien vérifier que le token du formulaire est bien dans les balises form grâce à l'insspecteur du navigateur        
    }

    public function testIfListJObIsSuccessfull(): void
    {
        $client = static::createClient();

        // Récupérer l'urlgenerator
        $urlGenerator = $client->getContainer()->get('router');

        // Récup entity manager, il faut être connecté , 15=admin

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');
        // 73 c'est le consultant
        $user = $entityManager->find(User::class, 73);

        $client->loginUser($user);

        // Se rendre sur la page de création d'un franchisé
        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('app_jobtovalid_index') );

        $this->assertResponseIsSuccessful();

        $this->assertRouteSame('app_jobtovalid_index');
    }

    public function testIfUpdateAnJobIsSuccessfull(): void
    {
        $client = static::createClient();
        
        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 73);
        
        $client->loginUser($user);
        
        $crawler = $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('app_job_edit', [21])
        );

     
        $this->assertResponseIsSuccessful();

        $form = $crawler->filter('form[name=job]')->form([
            'job[title]'=>"Charcutier de métier",
            'job[schedule]'=>"35h sans heure supp",
            'job[is_visible]'=> true,
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        // Gérer l'alert box
        $this->assertSelectorTextContains('div.alert-success', 'Votre demande a été enregistrée avec succès');

        $this->assertRouteSame('app_job_index');
    }

    public function testIfDeleteAnJobIsSuccessfull(): void

    {
        $client = static::createClient();
        
        $urlGenerator = $client->getContainer()->get('router');

        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        $user = $entityManager->find(User::class, 73);
        

        $client->loginUser($user);
        
        $crawler = $client->request(
            Request::METHOD_GET,
            $urlGenerator->generate('app_job_delete', [23])
        );     
       
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        // Gérer l'alert box
        $this->assertSelectorTextContains('div.alert-success', 'Votre demande a été supprimée avec succès');

        $this->assertRouteSame('app_job_index');

    }

}
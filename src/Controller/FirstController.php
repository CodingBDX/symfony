<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FirstController extends AbstractController
{
    #[Route('/order/{jojo}', name: 'test.app')]
    public function test($jojo): Response {
        return new Response(
            
            "<html><body>
             $jojo   
            </body></html>
            ");
    }
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }
#[Route('/multi/{entier1}/{entier2}',
name: 'multiplication',
requirements: ['entier1' => '\d+', 'entier2' => '\d+']
)]
    public function multiplaction($entier1, $entier2 ){
$result = $entier1 * $entier2;
        return new Response($result);
    }

#[Route('/sayhello/{name}/{firstname}', name: 'app_sayhello')]
    public function sayhello(Request $request, $name, $firstname): Response
    {
        return $this->render('first/name.html.twig', [
            'name' => 'henri',
            'firstname' => 'jojo',

        ]);
    }    
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TabController extends AbstractController
{
    #[Route('/tab/{nb?5}', name: 'tab.app', 
    requirements:([
            'nb' => '\d+',
        ]),    
     
    
)]

    public function index($nb): Response
    {

        $notes = [];
        for ($i = 0 ; $i < $nb ; $i++){
            $notes[] = rand(0,20);
        }
        return $this->render('tab/index.html.twig', [
        'notes' => $notes,
        ]);
    }


    #[Route('/tab/users', name: 'tab.users')] 
      public function users()
    {
$users = [
    ['firstname' => 'jean', 'age' => 36],
    ['firstname' => 'lol', 'age' => 16],
    ['firstname' => 'john', 'age' => 56]

];
            
     return $this->render('tab/users.html.twig', [
        'users' => $users,
        ]);
    }


}

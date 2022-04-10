<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
#[Route('/personne', name: 'personne.index')]
    public function index(ManagerRegistry $doctrine): Response
    {
$repository = $doctrine->getRepository(Personne::class);
$personnes = $repository->findAll();

return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
  'isPagination' => true,
        ]);
    }

#[Route('/personne/{id<\d+>}', name: 'personne.id')]
    public function personneid(ManagerRegistry $doctrine, $id): Response
    {
$repository = $doctrine->getRepository(Personne::class);
$personne = $repository->find($id);
if(!$personne) {$this->addFlash('error', "user with $id not exist");
return $this->redirectToRoute('personne.index');
}

return $this->render('personne/detail.html.twig', [
            'personne' => $personne,
        ]);
    }

    #[Route('/personne/add', name: 'personne.add')]
    public function addPersonne(ManagerRegistry $doctrine): Response
    {
        // $this->getDoctrine();
        $entityManager = $doctrine->getManager();
        $personne = new Personne();
        $personne->setFirstname('joel');
        $personne->setName('audrey');
        $personne->setAge(40);
$personne = new Personne();
        $personne->setFirstname('momo');
        $personne->setName('ylian');
        $personne->setAge(20);
        // ajouter des personnes 😺
        $entityManager->persist($personne);

        // execute pour mettre en mysql Ⓜ️
        $entityManager->flush();
        return $this->render('personne/detail.html.twig', [
            'personne' => $personne,
        ]);
    }



    #[Route('/personne/alls', name: 'personne.alls')]
    public function indexAlls(ManagerRegistry $doctrine): Response
    {
$repository = $doctrine->getRepository(Personne::class);
$personnes = $repository->findBy(['age' => '30'], ['name' => 'DESC'], 2);

return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
  'isPagination' => true,


        ]);
    }


    #[Route('/personne/pagination/{page?1}/{nbr?12}', name: 'personne.pagination')]
    public function indexPaginationtion(ManagerRegistry $doctrine, $page, $nbr): Response
    {
$repository = $doctrine->getRepository(Personne::class);

$personnes = $repository->findBy([],['name' => 'DESC'], $nbr, ($page -1 ) * $nbr);

return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
            'isPagination' => true,


]);
    }

    #[Route('/personne/delete/{id}', name: 'personne.delete')]

    public function deletePersonne(Personne $personne = null, ManagerRegistry $doctrine, $id): RedirectResponse  {
if($personne) {
    $manager = $doctrine->getManager();
$manager->remove($personne);

$manager->flush();
$this->addFlash('success', 'personne killed');
} else 
{ $repository = $doctrine->getRepository(Personne::class);
  $personneid = $repository->find($id);
    $this->addFlash('error', "personne doesn't exist with id $id");
}
return $this->redirectToRoute('personne.index');
    }
    
#[Route('/personne/update/{id}/{name}/{firstname}/{age}', name:"personne.update")]
public function updatePersonne(Personne $personne = null, ManagerRegistry $doctrine, $id, $name, $firstname, $age): RedirectResponse {

    // verifier personne existe
if($personne) {
// si oui, update puis message reussite
$personne->setName($name);
$personne->setFirstname($firstname);
$personne->setAge($age);

$manager = $doctrine->getManager();
$manager->persist($personne);
$manager->flush();
$this->addFlash('success', "user update succes");
} else {

    // si error get msg
    $this->addFlash('error', "people doesn't exist anymore");

}
    
return $this->redirectToRoute('personne.index');
    
}
    
}

<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 
use Symfony\Component\HttpFoundation\Request; 

class FactureController extends AbstractController
{
    /**
     * @Route("/facture/{id}", name="facture",methods={"GET"})
     */
    public function facture(CommandeRepository $commandeRepository,$id): Response
    {
        return $this->json($commandeRepository-> findFacture($id));
    }

    /**
     * @Route("/factureTotal/{id}", name="factureTotal",methods={"GET"})
     */
    public function factureTotal(CommandeRepository $commandeRepository,$id): Response
    {

        return $this->json($commandeRepository-> findFactureTotal($id));

    }

    /**
     * @Route("/chiffre-affaire", name="chiffre_affaire",methods={"GET"})
     */
    public function findChiffre_affaire(CommandeRepository $commandeRepository): Response
    {
        return $this->json($commandeRepository-> findChiffre_affaire());
    }


    /**
     * @Route("/cmd", name="cmd",methods={"GET"})
     */
     public function findCommande(CommandeRepository $commandeRepository): Response
     {
         return $this->json($commandeRepository-> findCommande());
     }
}


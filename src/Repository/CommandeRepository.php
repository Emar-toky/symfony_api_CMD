<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    public function findFacture($id){ 
        $conn = $this->getEntityManager()->getConnection();
        $query = 'SELECT client.id as client_id ,client.nom_client as nom_client , 
        produit.id as produit_id, produit.designation as designation ,
        produit.pu as pu , quantite, Sum(quantite*produit.pu) as total_kely 
        FROM `commande`
        INNER JOIN client on commande.client_id = client.id 
        INNER join produit on commande.produit_id = produit.id 
        WHERE client.id = :id 
        group by produit.id,quantite';
        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(); 
    }

    public function findFactureTotal($id){ 
        $conn = $this->getEntityManager()->getConnection();
        $query = 'SELECT  
        Sum(quantite*produit.pu) as total 
        FROM `commande`
        INNER JOIN client on commande.client_id = client.id 
        INNER join produit on commande.produit_id = produit.id 
        WHERE client.id = :id';
        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(); 
    }

    public function findChiffre_affaire(){
        $conn = $this->getEntityManager()->getConnection();
        $query='SELECT  client.id,client.nom_client,
        Sum(quantite*produit.pu) as chiffre_affaire 
        FROM `commande`
        INNER JOIN client on commande.client_id = client.id 
        INNER join produit on commande.produit_id = produit.id 
        GROUP by client.id';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function findCommande( ){ 
        $conn = $this->getEntityManager()->getConnection();
        $query = 'SELECT commande.id,client.id as client_id ,client.nom_client as nom_client , 
        produit.id as produit_id, produit.designation as designation ,
        produit.pu as pu , quantite
        FROM `commande`
        INNER JOIN client on commande.client_id = client.id 
        INNER join produit on commande.produit_id = produit.id';
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

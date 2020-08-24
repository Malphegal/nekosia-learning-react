<?php

namespace App\Controller;

use App\Entity\Account;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

// TODO: Ajouter les cas d'erreurs dans les méthodes :
//          - Si y'a pas de données
//          - Si la données n'existe pas

class AccountController extends AbstractController
{
    /**
     * @Route("/api/accounts/{id}", name="get_account", methods={"GET"})
     */
    public function index(AccountRepository $ar, $id)
    {
        $account = $ar->findOneById($id);

        return $this->json($account, 200, [], [
            //'groups' => 'post:read'
        ]);
    }

    /**
     * @Route("/api/accounts", name="create_account", methods={"POST"})
     */
    public function createAccount(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $jsonIncome = $request->getContent();

        try
        {
            // Ajout des informations en provenance des données du POST
            $account = $serializer->deserialize($jsonIncome, Account::class, 'json');
            $errors = $validator->validate($account);

            // Si les données ne sont pas conformes, on renvoie 400
            if(count($errors) > 0)
                return $this->json($errors, 400);

            // Ajout de la date de création du compte
            $account->setCreatedDate(new \DateTime('now'));

            // Création dans la base de données
            $em->persist($account);
            $em->flush();
            
            return $this->json($account, 201, [], [
                //'groups' => 'post:read'
            ]);
        }
        catch(NotEncodableValueException $e)
        {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400, []);
        }
    }
    
    /**
     * @Route("/api/delete/accounts/{id}", name="delete_account", methods={"GET"})
     */
    public function delete(AccountRepository $ar, EntityManagerInterface $em, $id)
    {
        $account = $ar->findOneById($id);
        
        if (!$account)
            return $this->json([
                'status' => 400,
                'message' => "Ce compte d'identifiant '${id}' n'existe pas !"
            ], 400, []);
        
        $em->remove($account);
        $em->flush();
        
        return $this->json(true, 200);
    }
}

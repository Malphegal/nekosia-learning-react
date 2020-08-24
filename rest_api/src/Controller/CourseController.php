<?php

namespace App\Controller;

use App\Entity\Course;
use App\Repository\CourseRepository;
use App\Repository\AccountRepository;
use App\Repository\ThemeRepository;
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

class CourseController extends AbstractController
{
    /**
     * @Route("/api/course/{id}", name="get_course", methods={"GET"})
     */
    public function getCourse(CourseRepository $cr, $id)
    {
        $course = $cr->findOneById($id);

        return $this->json($course, 200, [], [
            //'groups' => 'post:read'
        ]);
    }

    /**
     * @Route("/api/courses/{from}/{to}", name="get_courses", methods={"GET"})
     */
    public function getCourses(CourseRepository $cr, $from, $to)
    {
        $a = array('a'=> 1);
        return $this->json($a, 200, [], [
            //'groups' => 'post:read'
        ]);
        $courses = $cr->getPage($from, $to);
        $courses[0] = $this->convertCourseIdsToValues($courses[0]);
        return $this->json($courses, 200, [], [
            //'groups' => 'post:read'
        ]);
    }

    private function convertCourseIdsToValues($course)
    {
        $res = array("name" => $course->getName());
        $course->setAccount($course->getAccount()->getNickname());
        dd($acc);
        return $course;
    }
    
    /**
     * @Route("/api/courses", name="create_course", methods={"POST"})
     */
    public function createCourse(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator, AccountRepository $ar, ThemeRepository $tr)
    {
        $jsonIncome = $request->getContent();

        try
        {
            // Ajout des informations en provenance des données du POST
            $course = $serializer->deserialize($jsonIncome, Course::class, 'json');
            $errors = $validator->validate($course);

            // Si les données ne sont pas conformes, on renvoie 400
            if(count($errors) > 0)
                return $this->json($errors, 400);

                
            //return $this->json($jsonDecode, 400);
            $jsonDecode = json_decode($jsonIncome, true);

            // Vérification du compte et du thème
            $theme = $tr->findOneById($jsonDecode["theme_id"]);
            $course->setTheme($theme);
            $account = $ar->findOneById($jsonDecode["account_id"]);
            $course->setAccount($account);

            // Ajout de la date de création du cours, et de la mise à jour
            $course->setCreatedDate(new \DateTime('now'));
            $course->seteditedDate(new \DateTime('now'));

            // Création dans la base de données
            $em->persist($course);
            $em->flush();
            
            return $this->json($course, 201, [], [
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
     * @Route("/api/delete/courses/{id}", name="delete_course", methods={"GET"})
     */
    public function delete(CourseRepository $cr, EntityManagerInterface $em, $id)
    {
        $course = $cr->findOneById($id);
        
        if (!$course)
            return $this->json([
                'status' => 400,
                'message' => "Ce compte d'identifiant '${id}' n'existe pas !"
            ], 400, []);
        
        $em->remove($course);
        $em->flush();
        
        return $this->json(true, 200);
    }
}

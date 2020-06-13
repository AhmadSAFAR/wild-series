<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategoryRepository;
use App\Form\CategoryType;
use App\Entity\Category;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CategoryController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     *
     * @Route("/category", name="category_add")
     */
    //function pour ajouter des category dans la base et pour traiter le formulaire
    public function add(EntityManagerInterface $manager,Request $request):Response
    {
        $categories = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll();
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($category);
            $manager->flush();
            return $this->redirectToRoute('category_add');
        }
      

        return $this->render('category/add.html.twig', [
            'form' => $form->createView(),
            'categories' => $categories,
        ]);
    }
}

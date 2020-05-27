<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;
use App\Repository\ProgramRepository;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(ProgramRepository $program) :Response
    {
        return $this->render('base.html.twig',[
            "programs"=>$program->findAll()
        ]);
    }
}
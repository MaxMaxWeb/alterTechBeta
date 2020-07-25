<?php


namespace App\Controller;


use App\Entity\Reponse;
use App\Mercure\MercureCookiesGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function __invoke(MercureCookiesGenerator $mcg): Response
    {

        $response = $this->render('mercure.html.twig', []);


        return $response;

    }


}
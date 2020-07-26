<?php


namespace App\Controller;


use App\Services\MercureCookieGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestBController extends AbstractController
{
    /**
     * @Route("/test2", name="test2")
     */
    public function send(MercureCookieGenerator $mcg): Response
    {

        $response = $this->render('mercure2.html.twig');
        $response->headers->set('set-cookie', $mcg->generate());
        return $response;

    }

}
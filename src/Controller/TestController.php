<?php


namespace App\Controller;


use App\Services\MercureCookieGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/chat", name="chat")
     */
    public function testA(MercureCookieGenerator $mcg): Response
    {

        $response = $this->render('mercure.html.twig');
        $response->headers->set('set-cookie', $mcg->generate());
        return $response;

    }

}
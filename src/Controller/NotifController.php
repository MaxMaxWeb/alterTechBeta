<?php


namespace App\Controller;


use App\Services\MercureCookieGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotifController extends AbstractController
{
    /**
     * @Route("/homeAppr", name="homeAppr")
     */
    public function notif(MercureCookieGenerator $mcg): Response
    {

        $response = $this->render('homeAppr.html.twig');
        $response->headers->set('set-cookie', $mcg->generate());
        return $response;

    }

}
<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

class PublishBController extends AbstractController
{

    /**
     *
     * @Route("/bMessage", name="bMessage", methods={"POST"})
     */

    public function bMessage(PublisherInterface $pub, Request $request): RedirectResponse
    {
        $target = [

            "http://127.0.0.1:8000/test2"

        ];

        $update = new Update('http://localhost:8000/chat', json_encode([
            'message' => $request->request->get('message'),
        ]), $target);

        $pub($update);


        return $this->redirectToRoute('chat');
    }

}
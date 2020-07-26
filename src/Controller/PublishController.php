<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mercure\Debug\TraceablePublisher;
use Symfony\Component\Mercure\Publisher;
use Symfony\Component\Mercure\PublisherInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class PublishController extends AbstractController
{
    /**
     *
     * @Route("/message", name="sendMessage", methods={"POST"})
     */

    public function sendMessage(PublisherInterface $pub, Request $request): RedirectResponse
    {
        $target = [

            "http://127.0.0.1:8000/chat"

        ];

        $update = new Update('http://localhost:8000/test2', json_encode([
            'message' => $request->request->get('message'),
        ]), $target);

        $pub($update);


        return $this->redirectToRoute('test2');
    }


}


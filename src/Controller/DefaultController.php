<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/app/{slug?}', name: 'app', requirements: ['slug' => '.+'])]
    public function app(): Response
    {
        return $this->render('app.html.twig');
    }

    /**
     * @Route("/api/helloword/{name}", name="api_helloword")")
     */
    #[Route('/api/helloworld/{name}', name: 'hello_world')]
    public function apiHelloworld(string $name): Response
    {
        return new JsonResponse('hello '.$name);
    }
}

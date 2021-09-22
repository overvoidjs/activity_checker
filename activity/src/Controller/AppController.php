<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AppController extends AbstractController
{

    /**
     * @Route("/", name="app")
     */
    public function app(): Response
    {
        throw $this->createNotFoundException();
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Services\SecurityService;

class ApiController extends AbstractController
{

    public function __construct(SecurityService $securityService){
      $this->securityService = $securityService;
    }

    /**
     * @Route("/api/login", name="api_login")
     */
    public function api_login(Request $request){

      $password = $request->request->get('password');

      if($this->securityService->login($password)){
        return $this->redirect('/admin/activity');
      } else {
        return $this->redirect('/admin');
      }

    }

}

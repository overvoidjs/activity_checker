<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Services\SecurityService;
use App\Services\PingService;

class PagesController extends AbstractController
{

    public function __construct(SecurityService $securityService, PingService $pingService){
      $this->is_login = $securityService->is_login();
      $this->pingService = $pingService;
      $pingService->send();
    }

    /**
     * @Route("/", name="home_page")
     */
    public function home_page(): Response
    {

        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

    /**
     * @Route("/about", name="about_page")
     */
    public function about_page(): Response
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

    /**
     * @Route("/blog", name="blog_page")
     */
    public function blog_page(): Response
    {
        return $this->render('pages/index.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

    /**
     * @Route("/admin", name="admin_page")
     */
    public function admin_page(): Response
    {
      if($this->is_login){
        return $this->redirect('/admin/activity');
      }

        return $this->render('pages/admin.twig', [
            'controller_name' => 'PagesController',
        ]);
    }


    /**
     * @Route("/admin/activity", name="admin_activity_page")
     */
    public function admin_activity_page(Request $request): Response
    {
      if(!$this->is_login){
        throw $this->createNotFoundException();
      }

      $result = json_decode($this->pingService->get(), true);

      if(is_array($result) && isset($result['result'])){
        $result = $result['result'];


        $limit = 2;
        $page = $request->query->get('page');

        if($page > 0){
          $page = $page - 1;
        }

        $offset = $limit * $page;
        $total_pages = count($result) / $limit;

        $result = array_slice($result, $offset, $limit);

      } else {
        $result = [];
      }


        return $this->render('pages/admin.activity.twig', [
            'result' => $result,
            'total_pages' => $total_pages
        ]);
    }
}

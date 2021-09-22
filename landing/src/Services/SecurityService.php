<?php
namespace App\Services;

use Symfony\Component\HttpFoundation\Session\Session;

class SecurityService
{


  //Получаем информацию залогинен ли у нас пользователь
  public function is_login(){
    $session = new Session;
    $resp = FALSE;
    if($session->has('f22')){
      $resp = $session->get('f22');
    }
    return $resp;
  }

  public function login($password){
    $resp = FALSE;

    if($password == 'hibro'){
      $session = new Session;

      $session->set('f22','logined');

      $resp = TRUE;
    }

    return $resp;
  }

}

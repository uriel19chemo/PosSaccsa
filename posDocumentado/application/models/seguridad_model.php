<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Clase seguridad_model Para seguridad de usuarios logueados  
class seguridad_model extends CI_Model {
/*
  * Funcion SessionActivo Para consultar las sesiones activas
 */	
     public function SessionActivo($url){
          if($this->session->userdata('is_logged_in')){

          }else{
               redirect(base_url()."login");
          }
     }
}
?>
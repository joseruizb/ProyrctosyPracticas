<?php

class Acesso {

   private $valido;
   private $nick;
   private $nombre;
   private $permisos;
   

   public function __construct(){

      $this->valido = true;
      $this->nick = "";
      $this->nombre = "";
      $this->permisos = [];
      
   }


   public function registrarUsuario($nick, $nombre, $permisos){

      $_SESSION["usuario"] = ["nick"=>$nick,"nombre"=>$nombre,"permisos"=>$permisos];
   }
   public function quitarRegistroUsuario(){

      session_unset();


   }   
   public function hayUsuario(){

      foreach($_SESSION as $val){

         if($val["nick"] == $this->nick && $val["valido"] == $this->valido) return true;
         return false;

      }

   }
   public function puedePermiso($numero){

      foreach($this->permisos as $val){
         if($val == $numero) return true;
         return false;
      }

   }  
   public function getNick(){

      return $this->nick;


   }
   public function getNombre(){

      return $this->nombre;

   }


}






?>
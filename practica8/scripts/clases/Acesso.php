<?php

session_start();

class Acesso {

   private $valido;
   private $nick;
   private $nombre;
   private $permisos;
   

   public function __construct($nick = "",$nombre = "",$permisos=array()){

      if(sizeof($permisos) <=10 && $nick != ""){
      $_SESSION["usuario"] = ["nick"=>$nick,"nombre"=>$nombre,"permisos"=>$permisos,"valido" => true];
      $this->valido = true;
      $this->nick = $nick;
      $this->nombre = $nombre;
      $this->permisos = $permisos;
      }


      
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
<?php

    class RegistroTexto{

        private $_cadena;
        private $_fechahora;


        public function __construct($cad){

            $date = new DateTime();

            $this->_cadena = $cad;
            $this->_fechahora = $date->format('Y-m-d H:i:s');

        }
        public function __getCadena(){return $this->_cadena;}
        public function __getfechaHora(){return $this->_fechahora;}


        public function __toString(){

            return $this->_fechahora." => ".$this->_cadena;

            
        }


    }

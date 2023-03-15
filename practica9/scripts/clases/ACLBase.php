<?php

    /**
     * 
     * 
     * 
     */
    abstract class ACLBase{

        abstract function anadirRole($nombre, $permisos=array());
        abstract function getCodRole($nombre);
        abstract function existeRole($codRole);
        abstract function anadirUsuario($nombre, $nick, $contrasenia, $codRole);
        abstract function getCodUsuario($nick);
        abstract function existeUsuario($nick);
        abstract function esValido($nick, $contrasenia);
        abstract function getPermiso($codUsuario, $numero);
        abstract function getPermisos($codUsuario);
        abstract function getNombre($codUsuario);
        abstract function getBorrado($codUsuario);
        abstract function getUsuarioRole($codUsuario);
        abstract function setNombre($codUsuario, $nombre);
        abstract function setContrasenia($codUsuario,$contra);
        abstract function setBorrado($codUsuario, $borrado);
        abstract function setUsuarioRole($codUsuario,$role);
        abstract function dameUsuarios();
        abstract function dameRoles();

    }






?>
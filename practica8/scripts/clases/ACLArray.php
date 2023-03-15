<?php


class ACLArray extends ACLBase
{
    /**
     * $_role contiene los roles definitivos en la ACL
     * Cada role sera un array ascoiativo de 
     * cod => [ "cod"=> ,
     *    "nombre" => ,
     *    "permisos" => [1=>false, 2=> xx,...........10=> xxx]
     * ]
     * 
     */
    private $_roles = [];

    /**
     * $_usuarios contiene los roles definitivos en la ACL
     * Cada role sera un array ascoiativo de
     *  cod => [ "cod"=> ,
     *    "nick" => ,
     *    "nombre" => ,
     *    "contrasenia" => ,
     *    "cod_role" => 
     *]
     * 
     */
    private $_usuarios = [];


    /**
     * 
     * 
     */
    public static $_codRol = 0;
    public static $_codUsu = 0;


    public function __construct(){

        /**
         * Crear Roles
         */
        $this->anadirRole("normales",[1=>true]);
        $this->anadirRole("administrador",[1=>true,2=>true]);

        /**
         * 
         * Crear Usuarios
         */
        $this->anadirUsuario("usuario alumno","alumno","1234",$this->getCodRole("normales"));
        $this->anadirUsuario("usuario profesor","profesor","1234",$this->getCodRole("administrador"));
        $this->anadirUsuario("José Ruiz","pepe","1234",$this->getCodRole("administrador"));

        
    }

    function anadirRole($nombre, $permisos = array())
    {

        $repite = false;
        foreach ($this->_roles as $val)
            if ($val["nombre"] == $nombre) $repite = true;

        if (sizeof($permisos) <= 10 && $repite == false) {
            $this->_roles[self::$_codRol] = [
                "cod" => self::$_codRol,
                "nombre" => $nombre,
                "permisos" => $permisos
            ];
            self::$_codRol++;
            return true;
        } else return false;
    }
    function getCodRole($nombre)
    {
        foreach ($this->_roles as $val){
            if ($val["nombre"] == $nombre) return $val["cod"];}
        return false;
    }
    function existeRole($codRole)
    {
        foreach ($this->_roles as $val){
            if ($val["cod"] == $codRole) return true;}
            return false;
    }
    function anadirUsuario($nombre, $nick, $contrasenia, $codRole)
    {

        $repite = false;

        foreach ($this->_usuarios as $val)
            if ($val["nick"] == $nick) $repite = true;

        if ($repite == false) {
            $this->_usuarios[self::$_codUsu] = [
                "cod" => self::$_codUsu,
                "nick" => $nick,
                "nombre" => $nombre,
                "contrasenia" => $contrasenia,
                "cod_role" => $codRole,
                "borrado" => false
            ];
            self::$_codUsu++;
            return true;
        } else return false;
    }
    function getCodUsuario($nick)
    {
        foreach ($this->_usuarios as $val){
            if ($val["nick"] == $nick) return $val["nick"];}
            return false;
    }
    function existeUsuario($nick)
    {
        foreach ($this->_usuarios as $val){
            if ($val["nick"] == $nick) return true;}
            return false;
    }
    function esValido($nick, $contrasenia)
    {
        foreach ($this->_usuarios as $val){
            if ($val["nick"] == $nick && $val["contrasenia"] == $contrasenia) return true;}
            return false;
    }

    /**
     * 
     */
    function getPermiso($codUsuario, $numero)
    {

        $codRol = 0;
        foreach ($this->_usuarios as $val)
            if ($val["cod"] == $codUsuario) $codRol = $val["cod_role"];

        foreach ($this->_roles as $val) {
            if ($val["cod"] == $codRol) {
                foreach ($val["permisos"] as $pos => $var) if ($pos == $numero) return true;
            }
        }

        return false;
    }
    function getPermisos($codUsuario)
    {
        $codRol = 0;
        foreach ($this->_usuarios as $val)
            if ($val["cod"] == $codUsuario) $codRol = $val["cod_role"];

        foreach ($this->_roles as $val) {
            if ($val["cod"] == $codRol) return $val["permisos"];
        }

        return false;
    }
    function getNombre($codUsuario)
    {
        foreach ($this->_usuarios as $val) if ($val["cod"] == $codUsuario) return $val["nombre"];
        return false;
    }
    function getBorrado($codUsuario)
    {

        foreach ($this->_usuarios as $val) if ($val["cod"] == $codUsuario) return $val["borrado"];
            return false;
    }
    function getUsuarioRole($codUsuario)
    {
        foreach ($this->_usuarios as $val)if ($val["cod"] == $codUsuario) return $val["cod_role"];
            return false;
    }
    function setNombre($codUsuario, $nombre)
    {
        foreach ($this->_usuarios as $val) if ($val["cod"] == $codUsuario) $val["nombre"] = $nombre;
            return false;
    }
    function setContrasenia($codUsuario, $contra)
    {
        foreach ($this->_usuarios as $val) if ($val["cod"] == $codUsuario) $val["contrasenia"] = $contra;
            return false;
    }
    function setBorrado($codUsuario, $borrado)
    {
        foreach ($this->_usuarios as $val) if ($val["cod"] == $codUsuario) $val["borrado"] = $borrado;
            return false;
    }
    function setUsuarioRole($codUsuario, $role)
    {
        foreach ($this->_usuarios as $val) if ($val["cod"] == $codUsuario) $val["cod_role"] = $role;
            return false;
    }
    function dameUsuarios()
    {
        $arrayUsu = [];
        foreach ($this->_usuarios as $val) $arrayUsu[$val["cod"]] = ["cod" =>$val["cod"],"nick" => $val["nick"]];
        $lista = ""; 
        foreach($arrayUsu as $val){

            $lista = $lista.$val["cod"]."=>".$val["nick"]."<br>";

        }

        return $lista;

    }
    function dameRoles()
    {
        $arrayRol = [];
        foreach ($this->_roles as $val) $arrayRol[$val["cod"]] = ["cod" =>$val["cod"],"nombre" => $val["nombre"]];
        $lista = ""; 
        foreach($arrayRol as $val){

            $lista = $lista.$val["cod"]."=>".$val["nombre"]."<br>";

        }

        return $lista;
    }
}

<?php

class ACLBD extends ACLBase
{

    private $_sqli;
    private $_hayConeccion;
    private $_prefijo = '_$"_';


    public function __construct($servidor, $usuario, $contra, $bd)
    {
        $this->_hayConeccion = true;
        $this->_sqli = new mysqli($servidor, $usuario, $contra, $bd);
        if (!$this->_sqli || $this->_sqli->connect_errno <> 0)
            $this->_hayConeccion = false;


        $this->anadirRole("normales", [1 => true]);
        $this->anadirRole("administradores", [1 => true, 2 => true]);

        $this->anadirUsuario(
            "alumno",
            "alumno",
            "alumno",
            $this->getCodRole("normales")
        );
        $this->anadirUsuario(
            "profesor",
            "profesor",
            "profesor",
            $this->getCodRole("administradores")
        );
        $this->anadirUsuario(
            "juanan",
            "juan",
            "juan",
            $this->getCodRole("administradores")
        );
    }

    /**
     * Esta función añade un nuevo role 
     * @param string $nombre Nombre del role
     * @param array $permisos Array con los permisos para el role (1=> true o false)
     * 
     * @return bool devuleve si se ha podio crea o no
     */
    public function anadirRole($nombre, $permisos = [])
    {
        if (!$this->_hayConeccion)
            return false;

        $nombre = mb_substr(mb_strtolower($nombre), 0, 30);

        if ($this->existeNombreRole($nombre))
            return false;

        for ($cont = 1; $cont <= 10; $cont++) {
            if (isset($permisos[$cont])) {
                $aPermisos[$cont] = isset($permisos[$cont]) && (bool)$permisos[$cont] ? '1' : '0';
            } else {
                $aPermisos[$cont] = '0';
            }
        }

        $nombre = $this->_sqli->escape_string($nombre);

        $sentencia = "insert into acl_roles (" .
            "     nombre, " .
            "    perm1, perm2,perm3,perm4,perm5," .
            "    perm6,perm7, perm8, perm9, perm10" .
            "       ) values (" .
            "     '$nombre', " .
            "    {$aPermisos[1]}, {$aPermisos[2]}," .
            "    {$aPermisos[3]},{$aPermisos[4]}," .
            "    {$aPermisos[5]}, {$aPermisos[6]}," .
            "    {$aPermisos[7]}, {$aPermisos[8]}," .
            "    {$aPermisos[9]}, {$aPermisos[10]}" .
            "          )";
        $resultado = $this->_sqli->query($sentencia);
        return $resultado == true;
    }

    private function existeNombreRole($role)
    {
        if (!$this->_hayConeccion)
            return false;

        $role = mb_substr(mb_strtolower($role), 0, 30);

        $sentencia = "select * from acl_roles where nombre='$role'";
        $resultado = $this->_sqli->query($sentencia);
        if (!$resultado)
            return false;

        $fila = $resultado->fetch_assoc();

        return ($fila != false);
    }

    /**
     * Esta función devuelve el codigo de role que corresponde al nombre dado 
     * @param string $nombre Nombre del role
     * 
     * @return bool devuelve el codigo de role si lo encuentra o false
     *              si no lo encuentra
     */
    public function getCodRole($nombre)
    {
        if (!$this->_hayConeccion)
            return false;
        $nombre = mb_substr(mb_strtolower($nombre), 0, 30);

        if (!$this->existeNombreRole($nombre))
            return false;

        $nombre = $this->_sqli->escape_string($nombre);

        $consulta = "SELECT cod_acl_role from acl_roles where nombre = '$nombre'";

        $resul = $this->_sqli->query($consulta)->fetch_assoc();

        return (is_null($resul) ? false : intval($resul["cod_acl_role"]));
    }

    /**
     * Comprueba si existe o no 
     * @param string $codRole Codigo del role
     * 
     * @return bool devuelve true o false si se encuentra un role 
     *              con el codigo
     */
    public function existeRole($codRole)
    {
        if (!$this->_hayConeccion)
            return false;

        $codRole = (int)$codRole;

        $consulta = "SELECT * from acl_roles " .
            "      where cod_acl_role = $codRole";

        $resul = $this->_sqli->query($consulta)->fetch_assoc();

        if (is_null($resul))
            return false;

        return true;
    }

    /**
     * Devuelve los permisos del role indicado 
     * @param string $codRole Codigo del role
     * 
     * @return mixed devuelve un array con los permisos
     *              o false si no encuentra el role
     */
    public function getPermisosRole($codRole)
    {
        if (!$this->_hayConeccion)
            return false;

        $codRole = (int)$codRole;
        if (!$this->existeRole($codRole))
            return false;


        $consulta = "SELECT `perm1`, `perm2`, `perm3`, `perm4`, `perm5`," .
            "      `perm6`, `perm7`, `perm8`, `perm9`, `perm10` " .
            "     FROM `acl_roles` " .
            "     WHERE cod_acl_role = $codRole";


        $resul = $this->_sqli->query($consulta)->fetch_row();
        $perm = [];
        for ($cont = 1; $cont < 11; $cont++)
            $perm[$cont] = (bool)$resul[$cont - 1];

        return ($perm);
    }

    /**
     * Devuelve el permiso del role indicado 
     * @param string $codRole Codigo del role
     * @param int $numero Numero del permiso
     * 
     * @return mixed devuelve el valor del permiso
     *              o false si no encuentra el role
     */
    function getPermisoRole($codRole, $numero)
    {
        $codRole = (int)$codRole;

        $perm = $this->getPermisosRole($codRole);
        if ($perm == false)
            return false;

        if ($numero < 1 || $numero > 10)
            return false;

        return ($perm[$numero]);
    }

    /**
     * Añade un usuario con los datos indicados
     * @param string $nombre nombre del usuario
     * @param string $nick nick del usuario
     * @param string $contrasena contraseña del usuario
     * @param int $codRole codigo del role a asignar.
     *   
     * @return bool Devuelve true o false si se puede hacer
     */
    public function anadirUsuario($nombre, $nick, $contrasena, $codRole)
    {
        if (!$this->_hayConeccion)
            return false;

        if (!$this->existeRole($codRole))
            return false;

        $nick = mb_strtolower($nick);

        if ($this->existeUsuario($nick))
            return false;

        $contrasena = $this->_sqli->escape_string($this->_prefijo . $contrasena);
        $nombre = $this->_sqli->escape_string(mb_substr($nombre, 0, 50));
        $nick = $this->_sqli->escape_string(mb_substr($nick, 0, 50));


        $consulta = "INSERT INTO  acl_usuarios (" .
            " nick,nombre,contrasenia,cod_acl_role,borrado" .
            "    ) VALUES (" .
            "'$nick', '$nombre', md5('$contrasena'), $codRole,false)";
        return $this->_sqli->query($consulta);
    }
    /**
     * Devuelve el codigo de usuario para el nick indicado
     * @param string $nick nick del usuario
     *   
     * @return mixed Devuelve el codigo si existe el usuario. 
     *               False en caso contrario
     */
    public function getCodUsuario($nick)
    {
        if (!$this->_hayConeccion)
            return false;

        $nick = mb_strtolower($nick);

        $consulta = "SELECT cod_acl_usuario FROM acl_usuarios " .
            "        WHERE nick = '$nick'";

        $resul = $this->_sqli->query($consulta)->fetch_assoc();

        return (is_null($resul) ? false : intval($resul["cod_acl_usuario"]));
    }

    /**
     * Comprueba si existe un usuario con el codigo indicado
     * @param int $codUsuario codigo del usuario
     *   
     * @return bool Devuelve true si existe. False en caso contrario
     */
    function existeCodUsuario($codUsuario)
    {
        if (!$this->_hayConeccion)
            return false;



        $consulta = "SELECT cod_acl_usuario FROM acl_usuarios " .
            "        WHERE cod_acl_usuario = $codUsuario";

        $resul = $this->_sqli->query($consulta)->fetch_assoc();

        return (is_null($resul) ? false : true);
    }

    /**
     * Comprueba si existe un usuario con el NICK indicado
     * @param string $nick nick del usuario
     *   
     * @return bool Devuelve true si existe. False en caso contrario
     */
    public function existeUsuario($nick)
    {
        if ($this->getCodUsuario($nick) !== false)
            return true;

        return false;
    }

    /**
     * Comprueba si la contraseña es valida para el usuario indicado
     * @param string $nick nick del usuario
     * @param string $contrasena contraseña a verificar
     *   
     * @return bool Devuelve true si existe el usuario y es la contraseña válida
     */
    public function esValido($nick, $contrasena)
    {
        if (!$this->_hayConeccion)
            return false;

        if (!$this->existeUsuario($nick))
            return false;

        $nick = mb_strtolower($nick);
        $contrasena = $this->_sqli->escape_string($this->_prefijo . $contrasena);
        $nick = $this->_sqli->escape_string(mb_substr($nick, 0, 50));

        $consulta = "SELECT * FROM acl_usuarios " .
            "WHERE nick = '$nick' " .
            "       and contrasenia = md5('$contrasena')" .
            "       and borrado = 0 ";

        $resul = $this->_sqli->query($consulta)->fetch_row();

        if (is_null($resul))
            return false;

        return true;
    }


    /**
     * Devuelve el valor para el permiso $numero del usuario $codUsuario
     * @param int $codUsuario codigo del usuario
     * @param int $numero numero del permiso
     *   
     * @return bool Devuelve valor del permiso. Si el usuario no existe
     *              o el permiso no corresponde con un numero válido 
     *              devuelve false
     */
    public function getPermiso($codUsuario, $numero)
    {

        $resul = $this->getPermisos($codUsuario);

        if ($resul === false)
            return false;

        return $resul[$numero];
    }

    /**
     * Devuelve los permisos del usuario indicado
     * @param int $codUsuario codigo del usuario
     *   
     * @return mixed Devuelve los permisos del usuario o false si no existe
     *              el usuario
     */
    public function getPermisos($codUsuario)
    {
        if (!$this->_hayConeccion)
            return false;
        if (!$this->existeCodUsuario($codUsuario))
            return false;

        $codRole = $this->getUsuarioRole($codUsuario);
        if (!$codRole)
            return false;

        $resul = $this->getPermisosRole($codRole);
        if (!$resul)
            return false;

        return $resul;
    }

    /**
     * Devuelve el nombre del usuario indicado
     * @param int $codUsuario codigo del usuario
     *   
     * @return mixed Devuelve el nombre del usuario o false si no existe
     *              el usuario
     */
    public function getNombre($codUsuario)
    {
        if (!$this->_hayConeccion)
            return false;

        $codUsuario = intval($codUsuario);

        $consulta = "SELECT nombre FROM acl_usuarios " .
            "    WHERE cod_acl_usuario = $codUsuario";

        $resul = $this->_sqli->query($consulta)->fetch_assoc();

        if (is_null($resul))
            return false;

        return $resul["nombre"];
    }

    /**
     * Devuelve si el usuario esta borrado o no
     * @param int $codUsuario codigo del usuario
     *   
     * @return mixed Devuelve si esta borrado el usuario o false si no existe
     *              el usuario
     */
    public function getBorrado($codUsuario)
    {
        if (!$this->_hayConeccion)
            return false;

        $codUsuario = intval($codUsuario);


        $consulta = "SELECT borrado FROM acl_usuarios " .
            "    WHERE cod_acl_usuario = $codUsuario";

        $resul = $this->_sqli->query($consulta)->fetch_assoc();

        if (is_null($resul))
            return false;

        return boolval($resul["borrado"]);
    }

    /**
     * Devuelve el role  del usuario indicado
     * @param int $codUsuario codigo del usuario
     *   
     * @return mixed Devuelve el role del usuario o false si no existe
     *              el usuario
     */
    public function getUsuarioRole($codUsuario)
    {
        if (!$this->_hayConeccion)
            return false;

        $codUsuario = intval($codUsuario);


        $consulta = "SELECT cod_acl_role FROM acl_usuarios " .
            "    WHERE cod_acl_usuario = $codUsuario";

        $resul = $this->_sqli->query($consulta)->fetch_assoc();

        if (is_null($resul))
            return false;

        return (int)$resul["cod_acl_role"];
    }

    /**
     * Asigna el nombre al usuario indicado
     * @param int $codUsuario codigo del usuario
     * @param string $nombre Nombre a asignar
     *   
     * @return mixed Devuelve true o false si lo ha podido hacer
     */
    public function setNombre($codUsuario, $nombre)
    {
        if (!$this->_hayConeccion)
            return false;

        $codUsuario = intval($codUsuario);

        $nombre = $this->_sqli->escape_string(mb_substr($nombre, 0, 50));


        $consulta = "UPDATE acl_usuarios SET nombre = '$nombre' " .
            "    WHERE cod_acl_usuario = '$codUsuario'";
        $this->_sqli->query($consulta);
        return true;
    }

    /**
     * Asigna la contraseña al usuario indicado
     * @param int $codUsuario codigo del usuario
     * @param string $contra Contraseña a asignar
     *   
     * @return mixed Devuelve true o false si lo ha podido hacer
     */
    public function setContrasenia($codUsuario, $contra)
    {
        if (!$this->_hayConeccion)
            return false;

        $codUsuario = intval($codUsuario);
        $contra = $this->_sqli->escape_string($this->_prefijo . $contra);


        $consulta = "UPDATE acl_usuarios SET contrasenia = '$contra' " .
            "    WHERE cod_acl_usuario = '$codUsuario'";
        $this->_sqli->query($consulta);

        return true;
    }

    /**
     * Pone el usuario como borrado o no
     * @param int $codUsuario codigo del usuario
     * @param bool $borrado 
     *    
     * @return mixed Devuelve true o false si lo ha podido hacer
     */
    public function setBorrado($codUsuario, $borrado)
    {
        if (!$this->_hayConeccion)
            return false;
        $borrado = $borrado ? "1" : "0";
        $consulta = "UPDATE acl_usuarios SET borrado = '$borrado' " .
            "    WHERE cod_acl_usuario  = '$codUsuario'";
        $this->_sqli->query($consulta);
        return true;
    }

    /**
     * Asigna el role al usuario indicado
     * @param int $codUsuario codigo del usuario
     * @param int $codRole Role a asignar
     *   
     * @return mixed Devuelve true o false si lo ha podido hacer
     */
    public function setUsuarioRole($codUsuario, $codRole)
    {
        if (!$this->_hayConeccion)
            return false;

        $codUsuario = intval($codUsuario);

        if (!$this->existeRole($codRole))
            return false;

        $consulta = "UPDATE acl_usuarios SET cod_acl_role = '$codRole' " .
            "     WHERE cod_acl_usuario = '$codUsuario'";
        $this->_sqli->query($consulta);

        return true;
    }


    /**
     * Devuelve un array con los usuarios que hay
     *   
     * @return mixed Devuelve el array o false si no se puede hacer
     */
    public function dameUsuarios()
    {
        if (!$this->_hayConeccion)
            return false;

        $consulta = "SELECT cod_acl_usuario, nick " .
            "      from acl_usuarios " .
            "ORDER BY cod_acl_usuario";

        $datos = $this->_sqli->query($consulta);
        $res = [];

        while ($fila = $datos->fetch_assoc())
            $res[(int)$fila["cod_acl_usuario"]] = $fila["nick"];

        return $res;
    }

    /**
     * Devuelve un array con los roles que hay
     *   
     * @return mixed Devuelve el array o false si no se puede hacer
     */
    public function dameRoles()
    {
        if (!$this->_hayConeccion)
            return false;

        $consulta = "SELECT cod_acl_role, nombre " .
            "      from acl_roles " .
            "ORDER BY cod_acl_role";

        $datos = $this->_sqli->query($consulta);
        $res = [];

        while ($fila = $datos->fetch_assoc())
            $res[(int)$fila["cod_acl_role"]] = $fila["nombre"];

        return $res;
    }
}

<?php

/**
 * Modelo Login
 */

class Login
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new Database;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function validateUsuario($data)
    {
        try {
            // Encriptar contraseña
            //$data['clave'] = hash('sha256', $data['clave']);
            $strSql = "SELECT usu.*, rol.nombre rol, p.id_persona id,  p.nombre persona, p.apellido apersona FROM usuariopersona usu INNER JOIN rolusuario rol ON rol.id_rol = usu.id_rol inner join persona p on p.id_usuario=usu.id_usuario WHERE usu.email = '{$data['email']}' AND usu.clave = '{$data['clave']}' ";

            $query = $this->pdo->select($strSql);
            
            if(isset($query[0]->id_usuario)) {
                if($query[0]->estado == 'activo') {
                    $_SESSION['usuariopersona'] = $query[0];
                    return true;
                } else {
                    return 'Error al Iniciar Sesión. Su Usuario esta Inactivo';
                }
            } else {
                return 'Error al Iniciar Sesión. Verifique sus Credenciales';
            }

        } catch (PDOException $e) {
            return $e->getMessage();
        }    
    }

}

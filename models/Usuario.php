<?php
    class Usuario
    {
        private $id_usuario;
        private $email;
        private $clave;
        private $estado;
        private $id_rol;

        public function __construct(){
            try{
                $this->pdo= new database;
            }catch(PDOException $e){
                die($e->getMessage());
            }
		}
		public function getAll(){
            try{
                $strSql= "SELECT u.*, r.nombre, p.nombre persona, p.apellido FROM usuariopersona u inner join rolusuario r on r.id_rol=u.id_rol inner join persona p on p.id_usuario=u.id_usuario";
                $query= $this->pdo->select($strSql);
                return $query;
            }catch(PDOException $e){
                die($e->getMessage());
            }
		}
        public function newUsuario($data){
            try{
                $this->pdo->insert('usuariopersona', $data);
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function getUltimoId()
		{
			try {
				$strSql= "SELECT MAX(id_usuario) as id_usuario FROM usuariopersona";
				$query= $this->pdo->select($strSql);
				return $query;
			} catch (PDOException $e) {
				return $e->getMessage();
			}
		}
        public function getUsuario()
		{
			try{
				$strSql="SELECT * status FROM usuariopersona WHERE estado='activo' ";
				$query= $this->pdo->select($strSql);
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
        }
        public function getUsuarioId($id_usuario)
		{
			try {
				$strSql= "SELECT * FROM usuariopersona WHERE id_usuario= :id_usuario";
				$arrayData= ['id_usuario' => $id_usuario];
				$query= $this->pdo->select($strSql, $arrayData);
				return $query;
			} catch (PDOException $e) {
				die($e->getMessage());
			}
        }
        public function updateUsuario($data)
		{
			try {
				$strWhere= 'id_usuario='.$data['id_usuario'];
				$this->pdo->update('usuariopersona', $data, $strWhere); 
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}
		public function getPersona($id){
            try{
                $strSql= "SELECT u.id_usuario, p.id_persona, p.nombre, p.apellido, p.documento, u.email, p.telefono, p.fecha_nacimiento, p.eps, p.rh FROM usuariopersona u inner join rolusuario r on r.id_rol=u.id_rol inner join persona p on p.id_usuario=u.id_usuario where u.id_usuario=".$id;
                $query= $this->pdo->select($strSql);
                return $query;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
    }
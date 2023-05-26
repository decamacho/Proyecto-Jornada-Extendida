<?php
    
    class Profesor
    {
        private $id_persona;
        private $nombre;
        private $apellido;
        private $documento;
        private $telefono;
        private $fecha_nacimiento;
        private $eps;
        private $rh;
        private $id_usuario;
        private $id_centro;
        private $id_estado;

        public function __construct()
        {
            try{
                $this->pdo= new database;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function getAll()
        {
            try{
                $strSql= "SELECT p.id_persona, p.nombre, p.apellido,p.documento, p.telefono, YEAR(CURDATE())-YEAR(p.fecha_nacimiento)  AS edad, 
                        p.eps, p.rh, u.email , u.estado, c.nombre as nombre_centro, u.id_usuario FROM persona p INNER JOIN usuariopersona u ON p.id_usuario=u.id_usuario INNER JOIN rolusuario ru on ru.id_rol=u.id_rol inner join centrointeres c ON c.id_centro=p.id_centro WHERE ru.id_rol=3 and u.estado='activo'";
                $query= $this->pdo->select($strSql);
                return $query;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function getCursos($id)
        {
            try{
                $strSql= "SELECT c.id_curso, c.numero_curso  cursos from persona p inner join usuariopersona up on up.id_usuario=p.id_usuario inner join detalleprofesor dp on dp.id_persona=p.id_persona inner join curso c on c.id_curso=dp.id_curso where up.id_rol=3 and p.id_persona=".$id;
                $query= $this->pdo->select($strSql);
                return $query;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function getAllInactive()
        {
            try{
                $strSql= "SELECT p.id_persona, p.nombre, p.apellido,p.documento, p.telefono, YEAR(CURDATE())-YEAR(p.fecha_nacimiento)  AS edad, 
                        p.eps, p.rh, u.email , u.estado, c.nombre as nombre_centro, u.id_usuario FROM persona p INNER JOIN usuariopersona u ON p.id_usuario=u.id_usuario INNER JOIN rolusuario ru on ru.id_rol=u.id_rol inner join centrointeres c ON c.id_centro=p.id_centro WHERE ru.id_rol=3 and p.id_estado=2";
                $query= $this->pdo->select($strSql);
                return $query;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function newProfesor($data)
        {
            try{
                $this->pdo->insert('persona', $data);
                return true;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function getProfesorId($id_persona)
		{
			try {
				$strSql= "SELECT * FROM persona p LEFT JOIN usuariopersona u on p.id_usuario=u.id_usuario WHERE id_persona= :id_persona";
				$arrayData= ['id_persona' => $id_persona];
				$query= $this->pdo->select($strSql, $arrayData);
				return $query;
			} catch (PDOException $e) {
				die($e->getMessage());
			}
        }
        public function updateProfesor($data)
		{
			try {
				$strWhere= 'id_persona='.$data['id_persona'];
				$this->pdo->update('persona', $data, $strWhere); 
			} catch (PDOException $e) {
				die($e->getMessage());
			}
        }
        public function getUltimoId()
		{
			try {
				$strSql= "SELECT MAX(id_persona) as id_persona FROM persona";
				$query= $this->pdo->select($strSql);
				return $query;
			} catch (PDOException $e) {
				return $e->getMessage();
			}
        }
        public function saveCursos($arrayCursos, $ultimoId)
        {
            try {
                foreach ($arrayCursos as $curso) {
                    $data = [
                        'id_persona' => $ultimoId,
                        'id_curso' => $curso['id']
                    ];

                    $this->pdo->insert('detalleprofesor', $data);
                }
                return true;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }
        public function deleteDetalle($id)
        {
            try {
                $strWhere = 'id_persona =' . $id;
                $this->pdo->delete('detalleprofesor', $strWhere);
                return true;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }
        public function getRepetido()
        {
            try{
                $strSql= "SELECT * from usuariopersona u ";
                $query= $this->pdo->select($strSql);
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
    }
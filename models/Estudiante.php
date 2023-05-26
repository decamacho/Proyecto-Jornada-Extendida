<?php
    
    class Estudiante
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

        public function __construct(){
            try{
                $this->pdo= new database;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function getAll(){
            try{ $strSql= "SELECT p.*,YEAR(CURDATE())-YEAR(p.fecha_nacimiento) AS edad,c.nombre as centro ,u.id_rol as rol,u.email,u.estado  FROM persona p INNER JOIN usuariopersona u ON u.id_usuario=p.id_usuario
                INNER JOIN centrointeres c ON c.id_centro=p.id_centro
                WHERE  id_rol=2 and u.estado='activo'";
                $query= $this->pdo->select($strSql);
                return $query;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function getById($id)
		{
			try {
				$strSql= "SELECT p.*, u.*, c.id_grado grado, c.numero_curso FROM persona p inner join usuariopersona u on p.id_usuario=u.id_usuario inner join curso c on c.id_curso=p.id_curso WHERE id_persona= :id";
				$arrayData= ['id' => $id];
				$query= $this->pdo->select($strSql, $arrayData);
				return $query;
			} catch (PDOException $e) {
				die($e->getMessage());
			}
        }
        public function viewCurso($curso)
        {
            try {
                $strSql = "SELECT p.*, YEAR(CURDATE())-YEAR(p.fecha_nacimiento) AS edad, c.numero_curso as curso, u.id_rol as rol, u.email , u.estado FROM persona p INNER JOIN usuariopersona u ON u.id_usuario=p.id_usuario
                INNER JOIN curso c ON c.id_curso=p.id_curso WHERE id_rol=2 and p.id_estado=1 and c.id_curso=".$curso;
                $query = $this->pdo->select($strSql);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function countInscripcion($curso, $centro)
        {
            try {
                $strSql = "SELECT count(i.id_inscripcion) count from inscripcionpersona i inner join persona p on p.id_persona=i.id_persona inner join plancurso pc on pc.id_plan=i.id_plan inner join centrointeres ce on ce.id_centro=pc.id_centro where pc.id_curso=".$curso." and ce.id_centro=".$centro;
                $query = $this->pdo->select($strSql);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function viewInscripcion($curso)
        {
            try {
                $strSql = "SELECT i.id_inscripcion, p.nombre, p.id_persona, p.apellido, p.documento, pc.id_curso curso from inscripcionpersona i inner join persona p on p.id_persona=i.id_persona inner join plancurso pc on pc.id_plan=i.id_plan where pc.id_curso=".$curso." order by p.apellido asc";
                $query = $this->pdo->select($strSql);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function viewDeporteMax($curso, $min)
        {
            try {
                $strSql = "SELECT i.id_plan, i.id_inscripcion, p.nombre, p.id_persona, p.apellido, p.documento, pc.id_curso curso, ce.nombre centro, ce.id_centro from inscripcionpersona i inner join persona p on p.id_persona=i.id_persona inner join plancurso pc on pc.id_plan=i.id_plan inner join centrointeres ce on ce.id_centro=pc.id_centro where pc.id_curso=".$curso." and i.id_plan > ".$min." order by p.apellido asc";
                $query = $this->pdo->select($strSql);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function viewDeporteMin($curso, $max)
        {
            try {
                $strSql = "SELECT i.id_plan, i.id_inscripcion, p.nombre, p.id_persona, p.apellido, p.documento, pc.id_curso curso, ce.nombre centro, ce.id_centro  from inscripcionpersona i inner join persona p on p.id_persona=i.id_persona inner join plancurso pc on pc.id_plan=i.id_plan inner join centrointeres ce on ce.id_centro=pc.id_centro where pc.id_curso=".$curso." and i.id_plan < ".$max." order by p.apellido asc";
                $query = $this->pdo->select($strSql);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function newEstudiante($data){
            try{
                
                $this->pdo->insert('persona', $data);
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function getEstudianteId($id_curso)
		{
			try {
				$strSql= "SELECT * FROM persona p LEFT JOIN usuariopersona u on p.id_usuario=u.id_usuario WHERE id= :id";
				$arrayData= ['id' => $id];
				$query= $this->pdo->select($strSql, $arrayData);
				return $query;
			} catch (PDOException $e) {
				die($e->getMessage());
			}
        }
        public function updateEstudiante($data)
		{
			try {
				$strWhere= 'id_persona='.$data['id_persona'];
				$this->pdo->update('persona', $data, $strWhere); 
			} catch (PDOException $e) {
				die($e->getMessage());
			}
        }
        
        public function editStatus($data)
        {
            try{
                $strWhere='id='.$data['id'];
                $this->pdo->update('persona',$data,$strWhere);
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }   
}
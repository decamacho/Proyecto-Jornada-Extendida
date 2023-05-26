<?php
	
	/**
	 * Modelo de la Tabla 
	 */
	class Inscripcion
	{
		private $id_inscripcion;
		private $fecha;
		private $anualidad;
		private $id_curso;
		private $pdo;
		
		public function __construct()
		{
			try {
				$this->pdo = new Database;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function getAll()
		{
			try {
				$strSql = "SELECT i.*,p.nombre, p.apellido, p.documento, c.nombre as cen, cu.numero_curso, cu.id_curso curso FROM inscripcionpersona i INNER JOIN persona p On i.id_persona = p.id_persona INNER JOIN plancurso pc On i.id_plan = pc.id_plan INNER JOIN centrointeres c On pc.id_centro = c.id_centro INNER JOIN curso as cu On pc.id_curso = cu.id_curso WHERE i.estado='Activo' ORDER BY i.id_inscripcion;";

				$query = $this->pdo->select($strSql);
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}
		public function getActivePers($id)
		{
			try {
				$strSql = "SELECT pe.id_persona, pe.nombre, pe.apellido FROM persona pe where id_persona = :id";
				$arrayData = ['id' => $id];
				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql,$arrayData);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}
		
		public function countPersona($id)
		{
			try {
				$strSql = "SELECT count(*) inscripcion from inscripcionpersona where id_persona=:id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}
		public function newInscrip($data)
		{
			try {
				$data['estado']='activo';
				$this->pdo->insert('inscripcionpersona', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}


		public function getInscripById($id)
		{
			try {
				$strSql = "SELECT * FROM inscripcionpersona WHERE id_inscripcion = :id_inscripcion";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function updateInscrip($data)
		{
			try {
				$strWhere = 'id_inscripcion =' . $data['id_inscripcion'];
				$this->pdo->update('inscripcionpersona', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function deleteInscrip($data)
		{
			try {
				$strWhere = 'id_inscripcion = '. $data['id_inscripcion'];
				$this->pdo->delete('inscripcionpersona', $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}


		public function getById($id)
		{
			try {
				$strSql = "SELECT pc.id_curso, cen.nombre centro, ca.nombre, cu.numero_curso as curso, pc.id_plan, cu.id_grado grado, cen.id_centro FROM plancurso pc INNER JOIN centrointeres cen ON pc.id_centro=cen.id_centro INNER JOIN categoriacentro ca ON cen.id_categoria = ca.id_categoria INNER JOIN curso cu ON pc.id_curso = cu.id_curso WHERE pc.id_curso = ".$id." AND ca.nombre = 'deporte' GROUP BY cen.nombre";
				$arrayData = ['id_curso' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}
		public function getAllPerson($id)
		{
			try {
				$strSql = "SELECT * from inscripcionpersona i inner join persona p on p.id_persona=i.id_persona where i.id_inscripcion=".$id;
				$arrayData = ['id_curso' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}
		public function getCentro($id)
		{
			try {
				$strSql = "SELECT DISTINCT(c.id_centro) centro, c.nombre, p.id_plan from plancurso p inner join centrointeres c on c.id_centro=p.id_centro where p.id_curso=:id_curso and c.id_categoria=1 group by c.id_centro";
				$arrayData = ['id_curso' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}
	}

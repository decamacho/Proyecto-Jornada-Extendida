<?php
	
	/**
	 * Modelo de la Tabla Rolusuario
	 */
	class Rolusu
	{
		private $id_rol;
		private $nombre;
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
				$strSql = "SELECT * FROM rolusuario rol order by rol.id_rol;";

				
				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}
		/*
		public function getActiveRolusu()
		{
			try {
				$strSql = "SELECT * FROM rolusuario";
				
				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}
		*/
		public function newRolusu($data)
		{
			try {
				/*$data['estado']='activo';*/
				$this->pdo->insert('rolusuario', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}


		public function getRolusuById($id)
		{
			try {
				$strSql = "SELECT * FROM rolusuario WHERE id_rol = :id_rol";
				$arrayData = ['id_rol' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function updateRolusu($data)
		{
			try {
				$strWhere = 'id_rol =' . $data['id_rol'];
				$this->pdo->update('rolusuario', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function deleteRolusu($data)
		{
			try {
				$strWhere = 'id_rol = '. $data['id_rol'];
				$this->pdo->delete('rolusuario', $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}


		public function getById($id)
		{
			try {
				$strSql = "SELECT * FROM rolusuario WHERE id_rol = :id_rol";
				$arrayData = ['id_rol' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

	}
?>	
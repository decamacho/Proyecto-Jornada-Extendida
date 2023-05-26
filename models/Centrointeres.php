<?php
	
	/**
	 * Modelo de la Tabla centrointeres
	 */
	class Centrointeres
	{
		private $id_centro;
		private $nombre;
		private $cupos;
		private $hora_inicio;
		private $hora_final;
		private $id_categoria;
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
				$strSql = "SELECT cen.*,ca.nombre as categoria FROM centrointeres cen INNER JOIN categoriacentro as ca On cen.id_categoria = ca.id_categoria WHERE cen.estado='Activo' order by cen.id_centro";
				
				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}
		public function getActiveCategoriacen()
		{
			try {
				$strSql = "SELECT * FROM categoriacentro";
				
				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newCentrointere($data)
		{
			try {
				$this->pdo->insert('centrointeres', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}


		public function getCentroIntereById($id)
		{
			try {
				$strSql = "SELECT * FROM centrointeres WHERE id_centro = :id_centro";
				$arrayData = ['id_centro' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function updateCentroIntere($data)
		{
			try {
				$strWhere = 'id_centro =' . $data['id_centro'];
				$this->pdo->update('centrointeres', $data, $strWhere);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function deleteCentroIntere($data)
		{
			try {
				$strWhere = 'id_centro = '. $data['id_centro'];
				$this->pdo->delete('centrointeres', $strWhere);
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}


		public function getById($id)
		{
			try {
				$strSql = "SELECT * FROM centrointeres WHERE id_centro = :id_centro";
				$arrayData = ['id_centro' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

	}
?>	
<?php
    class Centro
    {
        private $id_centro;
        private $nombre;
        private $cupos;
        private $hora_inicio;
        private $hora_final;
        private $id_categoria;
        private $estado;

        public function __construct(){
            try{
                $this->pdo= new database;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function getAll(){
            try{
                $strSql= "select c.id_centro, c.nombre, c.cupos, c.hora_inicio, c.hora_final, ca.nombre, c.estado 
                    from centrointeres c INNER join categoriacentro ca on ca.id_categoria=c.id_centro order by c.id_centro asc ";
                $query= $this->pdo->select($strSql);
                return $query;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function getCentroActivo()
		{
			try{
				$strSql= "select * from centrointeres where estado='activo'";
				$query=$this->pdo->select($strSql);
				return $query;
			} catch (PDOException $e){
				die($e-> getMessage());
			}
		}
    }
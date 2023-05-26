<?php
    class Grado
    {
        
        private $id_grado;
        private $estado;
        private $jornada;
        private $nombre;

        public function __construct(){
            try{
                $this->pdo= new database;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function getAll(){
            try{
                $strSql= "SELECT * from gradocurso";
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

        public function newCurso($data)
    {
        try {
            $data['estado'] = 'activo';
            $this->pdo->insert('curso', $data);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function updateGrado($data)
    {
        try {
            $strWhere= 'id_grado='.$data['id_grado'];
            $this->pdo->update('gradocurso', $data, $strWhere);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function getById($id_grado)
    {
        try {
            $strSql = "SELECT * FROM gradocurso WHERE id_grado=:id_grado";
            $array = ['id_grado' => $id_grado];
            $query = $this->pdo->select($strSql, $array);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


         
    }

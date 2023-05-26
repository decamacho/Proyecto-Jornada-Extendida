<?php 
    class Plan
    {
        private $id_plan;
        private $dia;
        private $hora_inicio;
        private $hora_final;
        private $id_centro;
        private $id_curso;

        public function __construct(){
            try{
                $this->pdo= new database;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function getPlan($curso)
		{
			try{
				$strSql= "select * from plancurso p inner join curso c on c.id_curso=p.id_curso inner join centrointeres ci on ci.id_centro=p.id_centro  where c.estado='activo' and c.id_curso=".$curso;
				$query=$this->pdo->select($strSql);
				return $query;
			} catch (PDOException $e){
				die($e-> getMessage());
			}
        }
    }
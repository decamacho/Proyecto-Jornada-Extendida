<?php
    class Curso
    {
        private $id_curso;
        private $estado;
        private $id_grado;
        private $numero_curso;
        

        public function __construct(){
            try{
                $this->pdo= new database;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function getAll(){
            try{
                $strSql= "SELECT * from curso";
                $query= $this->pdo->select($strSql);
                return $query;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function getEstudiante($id_curso){
            try{ $strSql= "SELECT p.*,YEAR(CURDATE())-YEAR(p.fecha_nacimiento) AS edad, c.numero_curso as centro ,u.id_rol as rol,u.email,u.estado FROM persona p 
                          INNER JOIN usuariopersona u ON u.id_usuario=p.id_usuario
                          INNER JOIN curso c ON c.id_curso=p.id_curso
                          WHERE  id_rol=2 and u.estado='activo' and c.id_curso=1";
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
        public function getUltimoCurso()
		{
			try {
				$strSql= "SELECT MAX(id_curso) as id_curso FROM curso";
				$query= $this->pdo->select($strSql);
				return $query;
			} catch (PDOException $e) {
				return $e->getMessage();
			}
        }
        public function saveCentros($arrayCentros, $ultimoId)
        {
            try {
                foreach ($arrayCentros as $centro) {
                    $data = [
                        'id_curso'  => $ultimoId,
                        'id_centro' => $centro['id_centro'],
                        'dia'       => $centro['dia']
                    ];

                    $this->pdo->insert('plancurso', $data);
                }
                return true;
            } catch (PDOException $e) {
                return $e->getMessage();
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
        public function getAllCentro(){
            try{
                $strSql= "SELECT * from centrointeres c where c.estado='activo'";
                $query= $this->pdo->select($strSql);
                return $query;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }

        public function updateCurso($data)
        {
            try {
                $strWhere = 'id_curso=' . $data['id_curso'];
                $this->pdo->update('curso', $data, $strWhere);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function getById($id_curso)
        {
            try {
                $strSql = "SELECT * FROM curso WHERE id_curso=:id_curso";
                $array = ['id_curso' => $id_curso];
                $query = $this->pdo->select($strSql, $array);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function getIdG($id_grado)
        {
            try {
                $strSql = "SELECT * FROM curso WHERE id_grado=:id_grado";
                $array = ['id_grado' => $id_grado];
                $query = $this->pdo->select($strSql, $array);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function editStatus($data)
        {
            try{
                $strWhere='id_curso='.$data['id_curso'];
                $this->pdo->update('curso',$data,$strWhere);
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }


         
    }

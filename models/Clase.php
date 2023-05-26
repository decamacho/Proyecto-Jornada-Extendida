<?php 
    class Clase
    {
        private $id_clase;
        private $fecha;
        private $id_plan;

        public function __construct()
        {
            try{
                $this->pdo= new database;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function getClase($clase)
        {
            try {
                $strSql = "SELECT c.id_clase, c.fecha, p.id_plan, c.descripcion, p.hora_inicio, p.hora_final, ce.nombre from clase c inner join plancurso p on p.id_plan=c.id_plan inner join centrointeres ce on ce.id_centro=p.id_centro where p.id_curso= :clase";
                $array  = ['clase' => $clase];
                $query  = $this->pdo->select($strSql, $array);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function newClase($data){
            try{
                $this->pdo->insert('clase', $data);
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function validateClase($data)
        {
            try {
                $strSql = "SELECT COUNT(c.fecha) fecha FROM asistencia a INNER join clase c on c.id_clase=a.id_clase inner join plancurso pc on pc.id_plan=c.id_plan inner join inscripcionpersona i on i.id_inscripcion=a.id_inscripcion inner join persona p on p.id_persona=i.id_persona inner join situacion s on s.id_situacion=a.id_situacion inner join centrointeres ce on ce.id_centro=pc.id_centro where c.fecha='{$data['fecha']}' and pc.id_curso={$data['id_curso']} and ce.id_categoria={$data['id_categoria']} and ce.id_centro={$data['id_centro']} ";

                $query = $this->pdo->select($strSql);
                
                if(isset($query[0]->fecha)) {
                    if($query[0]->fecha == 0) {
                        return false;
                    } else {
                        return 'No se podrá hacer otra clase hoy :(';
                    }
                } else {
                    return 'No se Puede realizar';
                }

            } catch (PDOException $e) {
                return $e->getMessage();
            }    
        }
        public function getUltimoId()
		{
			try {
				$strSql= "SELECT MAX(id_clase) as id_clase FROM clase";
				$query= $this->pdo->select($strSql);
				return $query;
			} catch (PDOException $e) {
				return $e->getMessage();
			}
        }
        public function getClaseId($id_clase)
		{
			try {
				$strSql= "SELECT * FROM clase WHERE id_clase= :id_clase";
				$arrayData= ['id_clase' => $id_clase];
				$query= $this->pdo->select($strSql, $arrayData);
				return $query;
			} catch (PDOException $e) {
				die($e->getMessage());
			}
        }
        public function updateClase($dataClase)
		{
			try {
				$strWhere= 'id_clase='.$dataClase['id_clase'];
				$this->pdo->update('clase', $dataClase, $strWhere); 
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}
    }
<?php
    
    class Asistencia
    {
        private $id_asistencia;
        private $situacion;
        private $id_clase;
        private $id_inscripcion;
        

        public function __construct(){
            try{
                $this->pdo= new database;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function index()
        {
            require 'views/dashboard.php';
            $programas= $this->model->getAll();
            $planes= $this->plan->getPlan();
            require 'views/programacion/lista.php';
            require 'views/dashboard_.php';
        }
        public function newAsistencia($data)
        {
            try{
                $this->pdo->insert('asistencia', $data);
                return true;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function existClase($id, $categoria)
        {
            try {
                $strSql = "SELECT COUNT(c.id_clase) count from clase c inner join plancurso pc on pc.id_plan=c.id_plan inner join centrointeres ce on ce.id_centro=pc.id_centro where pc.id_curso=:id and ce.id_categoria=".$categoria;
                $array= ['id' => $id];
                $query = $this->pdo->select($strSql, $array);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function lastCurso($id, $categoria)
        {
            try {
                $strSql = "SELECT max(c.id_clase) max from clase c inner join plancurso p on p.id_plan=c.id_plan inner join centrointeres ce on ce.id_centro=p.id_centro where p.id_curso=:id and ce.id_categoria=".$categoria;
                $array= ['id' => $id];
                $query = $this->pdo->select($strSql, $array);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function lastCursoMax($id, $categoria, $centro)
        {
            try {
                $strSql = "SELECT max(c.id_clase) max from clase c inner join plancurso p on p.id_plan=c.id_plan inner join centrointeres ce on ce.id_centro=p.id_centro where p.id_curso=:id and ce.id_categoria=".$categoria." and ce.id_centro=".$centro;
                $array= ['id' => $id];
                $query = $this->pdo->select($strSql, $array);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function lastCursoMin($id, $categoria, $centro)
        {
            try {
                $strSql = "SELECT max(c.id_clase) max from clase c inner join plancurso p on p.id_plan=c.id_plan inner join centrointeres ce on ce.id_centro=p.id_centro where p.id_curso=:id and ce.id_categoria=".$categoria." and ce.id_centro=".$centro;
                $array= ['id' => $id];
                $query = $this->pdo->select($strSql, $array);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function dateCursoMax($id, $categoria)
        {
            try {
                $strSql = "SELECT * from clase c inner join plancurso p on p.id_plan=c.id_plan inner join centrointeres ce on ce.id_centro=p.id_centro where ce.id_categoria=".$categoria." and c.estado='activo' and c.id_clase=".$id;
                $query = $this->pdo->select($strSql);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function dateCursoMin($id, $categoria)
        {
            try {
                $strSql = "SELECT * from clase c inner join plancurso p on p.id_plan=c.id_plan inner join centrointeres ce on ce.id_centro=p.id_centro where ce.id_categoria=".$categoria." and c.estado='activo' and c.id_clase=".$id;
                $query = $this->pdo->select($strSql);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function dateCurso($id, $categoria)
        {
            try {
                $strSql = "SELECT * from clase c inner join plancurso p on p.id_plan=c.id_plan inner join centrointeres ce on ce.id_centro=p.id_centro where ce.id_categoria=".$categoria." and c.estado='activo' and c.id_clase=".$id;
                $query = $this->pdo->select($strSql);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function dateTercer($id)
        {
            try {
                $strSql = "SELECT c.id_clase, c.fecha fecha, p.id_plan plan, ce.nombre centro from clase c inner join plancurso p on p.id_plan=c.id_plan inner join centrointeres ce on ce.id_centro=p.id_centro where p.id_curso=:id and ce.id_categoria=3 limit 5";
                $array= ['id' => $id];
                $query = $this->pdo->select($strSql, $array);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function centroTercer($id)
        {
            try {
                $strSql = "SELECT c.nombre centro, pc.id_plan plan FROM plancurso pc inner join centrointeres c on c.id_centro=pc.id_centro where pc.id_curso=:id and c.id_categoria=3";
                $array= ['id' => $id];
                $query = $this->pdo->select($strSql, $array);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function deporteMax($id)
        {
            try {
                $strSql = "SELECT max(pc.id_plan) max from inscripcionpersona i inner join persona p on p.id_persona=i.id_persona inner join plancurso pc on pc.id_plan=i.id_plan where pc.id_curso= :id";
                $array= ['id' => $id];
                $query = $this->pdo->select($strSql, $array);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function deporteMin($id)
        {
            try {
                $strSql = "SELECT min(pc.id_plan) min from inscripcionpersona i inner join persona p on p.id_persona=i.id_persona inner join plancurso pc on pc.id_plan=i.id_plan where pc.id_curso= :id";
                $array= ['id' => $id];
                $query = $this->pdo->select($strSql, $array);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function centroCurso($curso)
        {
            try {
                $strSql = "SELECT DISTINCT c.nombre centro, c.id_centro, cu.numero_curso curso, p.id_plan plan, c.id_categoria categoria from plancurso p inner join centrointeres c on c.id_centro=p.id_centro inner join curso cu on cu.id_curso=p.id_curso inner join categoriacentro ca on ca.id_categoria=c.id_categoria where cu.id_curso= :curso group by c.nombre asc";
                $array  = ['curso' => $curso];
                $query  = $this->pdo->select($strSql, $array);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function countCentro($curso)
        {
            try {
                $strSql = "SELECT COUNT(cu.id_curso) centros from plancurso p inner join centrointeres c on c.id_centro=p.id_centro inner join curso cu on cu.id_curso=p.id_curso where cu.id_curso= :curso";
                $array  = ['curso' => $curso];
                $query  = $this->pdo->select($strSql, $array);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function situacion()
        {
            try {
                $strSql = "SELECT * from situacion";
                $query  = $this->pdo->select($strSql);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function dateEspecifica($fecha, $curso, $categoria, $centro)
        {
            try {
                $strSql = "SELECT c.descripcion, p.nombre, p.apellido, p.documento, s.situacion, c.fecha, ce.nombre centro FROM asistencia a INNER join clase c on c.id_clase=a.id_clase inner join plancurso pc on pc.id_plan=c.id_plan inner join inscripcionpersona i on i.id_inscripcion=a.id_inscripcion inner join persona p on p.id_persona=i.id_persona inner join situacion s on s.id_situacion=a.id_situacion inner join centrointeres ce on ce.id_centro=pc.id_centro where c.fecha='".$fecha."' and pc.id_curso='".$curso."' and ce.id_categoria='".$categoria."' and ce.id_centro='".$centro."' order by p.apellido";
                $query  = $this->pdo->select($strSql);
                return $query;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

    }
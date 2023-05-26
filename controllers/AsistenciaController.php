<?php
    require 'models/Asistencia.php';
    require 'models/Estudiante.php';
    require 'models/Curso.php';
    require 'models/Plan.php';
    require 'models/Clase.php';
    require 'models/Inscripcion.php';

    class AsistenciaController
    {
        //hacer DESPUES las demas variables de estado y demas..
        private $model;
        private $estudiante;
        private $curso;
        private $plan;
        private $clase;
        private $inscripcion;

        public function __construct()
        {
            //hacer los demas procesos con estado y demas..
            $this->model     = new Asistencia;
            $this->estudiante= new Estudiante;
            $this->curso     = new Curso;
            $this->plan      = new Plan;
            $this->clase     = new Clase;
            $this->inscripcion = new Inscripcion;
        }
        public function add()
        {
            require 'views/dashboard.php';
            require 'views/profesor/nuevo.php';
            require 'views/dashboard_.php';
        }
        
        public function view()
		{
			if (isset($_REQUEST['id'])) {
                $curso= $_REQUEST['id'];
                $categoria= $_REQUEST['ca'];

                $clase= $this->model->existClase($curso, $categoria);
                $cuenta= $clase[0]->count;

                if($cuenta == 0){
                    $fechas=      false;
                    $cursos=      $this->curso->getById($curso);
                    $centro=      $this->model->centroCurso($curso);
                    $estudiantes= $this->estudiante->viewCurso($curso);
                    $inscripciones= $this->estudiante->viewInscripcion($curso);
                    $planes=      $this->plan->getPlan($curso);

                }else{
                    $situacion=   $this->model->situacion();
                    $lastFecha=   $this->model->lastCurso($curso, $categoria);
                    $fechas=      $this->model->dateCurso($lastFecha[0]->max, $categoria);
                    $cursos=      $this->curso->getById($curso);
                    $centro=      $this->model->centroCurso($curso);
                    $estudiantes= $this->estudiante->viewCurso($curso);
                    $inscripciones= $this->estudiante->viewInscripcion($curso);
                    $planes=      $this->plan->getPlan($curso);    
    
                }

                require 'views/dashboard.php';
                require 'views/asistencia/lista.php';
                require 'views/dashboard_.php';
                
			}elseif(isset($_REQUEST['plan'])){
                $curso= $_REQUEST['id_curso'];
                $categoria= $_REQUEST['id_categoria'];

                $clase= $this->model->existClase($curso, $categoria);
                $cuenta= $clase[0]->count;

                $validateClase= $this->clase->validateClase($_POST);
                $plan= $_REQUEST['plan'];

                if($validateClase === false){
                    $dataClase=[
                        'fecha'        => $_POST['fecha'],
                        'descripcion'  => $_POST['descripcion'],
                        'id_plan'      => $plan,
                        'estado'       => 'activo'
                    ];
        
                    $this->clase->newClase($dataClase);
        
                    header ('Location: ' . $_SERVER['HTTP_REFERER']);
                }else{
                    
                    if($cuenta == 0){
                        $error = [
                            'errorMessage' => $validateClase
                        ];
                        $fechas=      false;
                        $cursos=      $this->curso->getById($curso);
                        $centro=      $this->model->centroCurso($curso);
                        $estudiantes= $this->estudiante->viewCurso($curso);
                        $inscripciones= $this->estudiante->viewInscripcion($curso);
                        $planes=      $this->plan->getPlan($curso);
    
                    }else{
                        $error = [
                            'errorMessage' => $validateClase
                        ];
                        $situacion=   $this->model->situacion();
                        $lastFecha=   $this->model->lastCurso($curso, $categoria);
                        $fechas=      $this->model->dateCurso($lastFecha[0]->max, $categoria);
                        $cursos=      $this->curso->getById($curso);
                        $centro=      $this->model->centroCurso($curso);
                        $estudiantes= $this->estudiante->viewCurso($curso);
                        $inscripciones= $this->estudiante->viewInscripcion($curso);
                        $planes=      $this->plan->getPlan($curso);   
                        
                        header("Refresh: 3; URL=http://localhost:8080/JornadaExtendida1/?controller=asistencia&method=view&id=".$curso."&ca=2");
                    }
    
                    require 'views/dashboard.php';
                    require 'views/asistencia/lista.php';
                    require 'views/dashboard_.php';
                }
            }else{
				echo "No se puede realizar la operación";
			}
        }
        public function save()	
		{   
			if(isset($_POST['situacion'])) {

                $clase= $_POST['id_clase'];
                $item1= $_POST['id_persona']; 
                $item2= $_POST['situacion'];
                
                for($i = 0; $i < count($item1); $i++){
                    $array[$i]= [
                        'id_inscripcion' => $item1[$i], 
                        'id_situacion' =>  $item2[$i],
                        'id_clase' => $clase
                    ];
                }
                $parts = array_chunk($array, count($item1), true);
                foreach ($array as $item) { 
                    
                    echo '<pre>';
                    var_dump($item);
                    echo '</pre>';
                    
                    $asistencia= $this->model->newAsistencia($item);
                }
                if($asistencia == true){
                    $data=[
                        'id_clase' => $_POST['id_clase'],
                        'estado' => "inactivo"
                    ];

                    $inactivar= $this->clase->updateClase($data);

                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }else{
                $asistencia= false;
            }
            /*
            $arrayResp= [];

            if($asistencia == true){
                $arrayResp= [
                    'success' => true,
                    'message' => "Llamado de asistencia realizada"
                ];
            }else{
                $arrayResp= [
                    'error'   => false,
                    'message' => "Error creando el Profesor, No se han asignado cursos"
                ];
            }
            echo json_encode($arrayResp);
            return;
            */
        }
        public function tercer()
		{
            if (isset($_REQUEST['id'])) {
                $curso= $_REQUEST['id'];
                $categoria= $_REQUEST['ca'];

                $clase= $this->model->existClase($curso, $categoria);
                $cuenta= $clase[0]->count;

                if($cuenta == 0){
                    $fechas=      false;
                    $cursos=      $this->curso->getById($curso);
                    $centro=      $this->model->centroCurso($curso);
                    $estudiantes= $this->estudiante->viewCurso($curso);
                    $inscripciones= $this->estudiante->viewInscripcion($curso);
                    $planes=      $this->plan->getPlan($curso);

                }else{
                    $situacion=   $this->model->situacion();
                    $lastFecha=   $this->model->lastCurso($curso, $categoria);
                    $fechas=      $this->model->dateCurso($lastFecha[0]->max, $categoria);
                    $cursos=      $this->curso->getById($curso);
                    $centro=      $this->model->centroCurso($curso);
                    $estudiantes= $this->estudiante->viewCurso($curso);
                    $inscripciones= $this->estudiante->viewInscripcion($curso);
                    $planes=      $this->plan->getPlan($curso);    
    
                }

                require 'views/dashboard.php';
                require 'views/asistencia/tercer.php';
                require 'views/dashboard_.php';
                
			}else{
				echo "No se puede realizar la operación";
			}
        }
        public function deporte()
		{
            if(isset($_REQUEST['id'])){
                $curso= $_REQUEST['id'];
                $categoria= $_REQUEST['ca'];
                //echo $curso;
                $clase= $this->model->existClase($curso, $categoria);
                $cuenta= $clase[0]->count;
                if($cuenta == 0){
                    $situacion=   $this->model->situacion();
                    $centroId= $this->inscripcion->getById($curso);
                    $countInscripcionMin= $this->estudiante->countInscripcion($curso, $centroId[0]->id_centro);
                    $countInscripcionMax= $this->estudiante->countInscripcion($curso, $centroId[1]->id_centro);

                    if($countInscripcionMin[0]->count == 0) {
                        $max= false;
                        $min= false;
                        $numMax= false;
                        //echo $numMax;
                        $numMin= false;
                        //echo $numMin;

                        $deporteMin= false;
                        $deporteMax= false;

                        $fechaMax=  false;
                        $fechaMin=  false;

                        $inscripciones= $this->estudiante->viewInscripcion($curso);
                        $cursos= $this->curso->getById($curso);

                        
                        $centro= $this->model->centroCurso($curso);
                        //|| $countInscripcionMax[0]->count == 0
                    }else{
                        $max= $this->model->deporteMax($curso);
                        $min= $this->model->deporteMin($curso);
                        $numMax= $max[0]->max;
                        //echo $numMax;
                        $numMin= $min[0]->min;
                        //echo $numMin;
    
                        $deporteMin= $this->estudiante->viewDeporteMin($curso, $numMax);
                        $deporteMax= $this->estudiante->viewDeporteMax($curso, $numMin);
    
                        $fechaMax=  false;
                        $fechaMin=  false;
    
                        $inscripciones= $this->estudiante->viewInscripcion($curso);
                        $cursos= $this->curso->getById($curso);
    
                        
                        $centro= $this->model->centroCurso($curso);

                    }

                    
                    require 'views/dashboard.php';
                    require 'views/asistencia/deporte.php';
                    require 'views/dashboard_.php';
                }else{
                    $situacion=   $this->model->situacion();
                    $max= $this->model->deporteMax($curso);
                    $min= $this->model->deporteMin($curso);
                    $numMax= $max[0]->max;
                    //echo $numMax;
                    $numMin= $min[0]->min;
                    //echo $numMin;
                    $deporteMin= $this->estudiante->viewDeporteMin($curso, $numMax);
                    $deporteMax= $this->estudiante->viewDeporteMax($curso, $numMin);
        
                    $lastFechaMax=   $this->model->lastCursoMax($curso, $categoria, $deporteMax[0]->id_centro);
                    $lastFechaMin=   $this->model->lastCursoMin($curso, $categoria, $deporteMin[0]->id_centro);
                    
                    if($lastFechaMax[0]->max == NULL){
                        $fechaMax=  false;
                        $fechaMin=  $this->model->dateCursoMin($lastFechaMin[0]->max, $categoria);;

                        
                        $inscripcion= $this->estudiante->viewInscripcion($curso);
                        $cursos= $this->curso->getById($curso);

                        
                        $centro= $this->model->centroCurso($curso);

                    }elseif($lastFechaMin[0]->max == NULL){
                        $fechaMax=  $this->model->dateCursoMax($lastFechaMax[0]->max, $categoria);;
                        $fechaMin=  false;

                        
                        $inscripciones= $this->estudiante->viewInscripcion($curso);
                        $cursos= $this->curso->getById($curso);

                        
                        $centro= $this->model->centroCurso($curso);
                    }else{

                        $fechaMax=      $this->model->dateCursoMax($lastFechaMax[0]->max, $categoria);
                        $fechaMin=      $this->model->dateCursoMin($lastFechaMin[0]->max, $categoria);
                        
                        $inscripciones= $this->estudiante->viewInscripcion($curso);
                        $cursos= $this->curso->getById($curso);
    
                        
                        $centro= $this->model->centroCurso($curso);

                    }

                    require 'views/dashboard.php';
                    require 'views/asistencia/deporte.php';
                    require 'views/dashboard_.php';

                }
            }
        }
        public function fecha()
		{
            if(isset($_REQUEST['fe'])){
                $fecha= $_REQUEST['fe'];
                $curso= $_REQUEST['id'];
                $categoria= $_REQUEST['ca'];
                $centro= $_REQUEST['ce'];
                
                $fechaEscogida= $this->model->dateEspecifica($fecha, $curso, $categoria, $centro);

                require 'views/asistencia/fecha.php';

            }else{
                echo 'Error';
            }
        }
        public function inactivar()
		{
			$profesor= $this->model->getProfesorId($_REQUEST['id_persona']);
			$data= [];
			if ($profesor[0]->id_estado == 1) {
				$data=[
                        'id_persona' => $profesor[0]->id_persona, 
                        'id_estado'  =>2
					  ];
			}
			$this->model->updateProfesor($data);
			header('Location: ?controller=profesor');
		}
    }
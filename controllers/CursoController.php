<?php
    require 'models/Curso.php';
    require 'models/Estudiante.php';
    require 'models/Grado.php';

    class CursoController
    {
        //hacer DESPUES las demas variables de estado y demas..
        private $model;
        private $estudiante;
        private $erado;

        public function __construct()
        {
            //hacer los demas procesos con estado y demas..
            $this->model= new Curso;
            $this->estudiante= new Estudiante;
            $this->erado= new Grado;

        }
        public function index()
        {
            require 'views/dashboard.php';
            $cursos= $this->model->getAll();
            $centros= $this->model->getAllCentro();
            require 'views/curso/lista.php';
            require 'views/dashboard_.php';
        }
        public function new()
        {
            require 'views/dashboard.php';
            $grados= $this->model->getAll();
            $curso= $this->model->getAll();
            require 'views/curso/nuevo.php';
            require 'views/dashboard_.php';
        }
        public function allCentro()
        {
            require 'views/dashboard.php';
            $centros= $this->model->getAllCentro();
            require 'views/curso/nuevo.php';
            require 'views/dashboard_.php';
        }
        public function save()
        {
            $dataCurso=[
                'numero_curso' => $_POST['numero_curso'],
                'id_grado'     => $_POST['id_grado'],
                'estado'       => 'activo'
            ];

            $numeros= '/^[0-9]/i';

            $arrayPlanes= isset($_POST['centros']) ? $_POST['centros'] : [];

            if(!empty($arrayPlanes) && isset($_POST['id_grado'])){
                $respCurso= $this->model->newCurso($dataCurso);

                $ultimoCurso= $this->model->getUltimoCurso();

                $respCentros= $this->model->saveCentros($arrayPlanes, $ultimoCurso[0]->id_curso);
            }else{
                $respCurso= false;
                $ultimoCurso= false;
                $respCentros= false;
            }
            $arrayResp= [];

            if($respCentros == true && $respCurso == true) {
                $arrayResp= [
                    'success' => true,
                    'message' => "Curso Creado Exitosamente"
                ];
            }elseif($_POST['numero_curso'] == '' ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo Curso es requerido"
                ];
            }elseif(strlen ($_POST['numero_curso']) > 3 ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "Un curso no tiene mas de 3 digitos"
                ];
            }elseif(strlen ($_POST['numero_curso']) < 2 ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "Un curso tiene mas de 2 digitos"
                ];
            }elseif(!preg_match($numeros, $_POST['numero_curso']) ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo Curso se requieren solo Números"
                ];
            }
            else{
                $arrayResp= [
                    'error'   => false,
                    'message' => "Error creando el Curso"
                ];
            }
            echo json_encode($arrayResp);
            return;

        }

        public function getCurso()
        {   
            if(isset($_REQUEST['id'])){
                $id= $_REQUEST['id'];

                $data= $this->model->getById($id);

                require 'views/dashboard.php';
                require 'views/curso/editar.php';
                require 'views/dashboard_.php';
            }else{
                echo 'Error';
            }
        }
        
        public function update()	
		{
			if (isset($_POST['id_curso'])) {

                $data= [
                    'id_curso'     => $_POST['id_curso'],
                    'numero_curso' => $_POST['numero_curso']
                ];

                $this->model->updateCurso($data);

				header('Location: ?controller=grado&method=getById&id_grado='. $_POST['id_grado']);	
			}else{
				echo "Error";
			}
		}
    }
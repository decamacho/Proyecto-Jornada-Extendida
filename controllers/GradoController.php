<?php
    require 'models/Grado.php';
    require 'models/Curso.php';

    class GradoController
    {
        //hacer DESPUES las demas variables de estado y demas..
        private $model;
        private $curso;

        public function __construct()
        {
            //hacer los demas procesos con estado y demas..
            $this->model= new Grado;
            $this->curso= new Curso;

        }
        public function index()
        {
            require 'views/dashboard.php';
            $grados= $this->model->getAll();
            require 'views/grado/lista.php';
            require 'views/dashboard_.php';
        }
        public function new()
        {
            require 'views/dashboard.php';
            $curso= $this->model->getAll();
            require 'views/curso/nuevo.php';
            require 'views/dashboard_.php';
        }
        public function save()
        {
            $this->model->newCurso($_REQUEST);
            header('location:?controller=curso');

        }
        public function getById()
        { 

            if(isset($_REQUEST['id_grado'])){
                $id_grado=$_REQUEST['id_grado'];

                $data=$this->model->getById($id_grado);
                $cursos=$this->curso->getIdG($id_grado);
                $centros= $this->curso->getAllCentro();
                
                require 'views/dashboard.php';
                require 'views/curso/lista.php';
                require 'views/dashboard_.php';
            }else{
                echo "Error, no se realizo.";
            }
        }
        public function getGrado()
            { 

                if(isset($_REQUEST['id'])){
                    $id=$_REQUEST['id'];

                    $data=$this->model->getById($id);

                    require 'views/dashboard.php';
                    require 'views/grado/editar.php';
                    require 'views/dashboard_.php';
                }else{
                    echo "Error, no se realizo.";
                }
            }
        public function update()	
		{
			if (isset($_POST['id_grado'])) {
                
                $data=[
                    'id_grado'  => $_POST['id_grado'],
                    'nombre'  => $_POST['nombre'],
                    'jornada'  => $_POST['jornada']
                ];

                $this->model->updateGrado($data);;

                header('Location: ?controller=grado');
                	
			}else{
				echo "Error";
			}
		}
    }
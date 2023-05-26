<?php
    require 'models/Estudiante.php';
    require 'models/Curso.php';
    require 'models/Usuario.php';
    require 'models/Centrointeres.php';
    require 'models/Clase.php';
    require 'models/Grado.php';
    require 'models/Asistencia.php';

    class EstudianteController
    {
        //hacer DESPUES las demas variables de estado y demas..
        private $model;
        private $usuario;
        private $curso;
        private $centroineres;
        private $clase;
        private $grado;
        private $asistencia;

        public function __construct()
        {
            //hacer los demas procesos con estado y demas..
            $this->model= new Estudiante;
            $this->curso= new Curso;
            $this->usuario= new Usuario;
            $this->centrointeres= new Centrointeres;
            $this->clase= new Clase;
            $this->grado = new Grado;
            $this->asistencia= new Asistencia;
        }
        /*
        public function index()
        {
            require 'views/dashboard.php';
            $estudiantes= $this->model->getAll();
            $cursos= $this->curso->getCentroActivo();
            require 'views/lista/lista.php';
            require 'views/dashboard_.php';
        }
        */
        function view()
        {
            if(isset($_REQUEST['id'])){
                $curso=$_REQUEST['id'];
                $estudiantes=$this->model->viewCurso($curso);
                //$fechas=$this->model->viewDate($curso);
                $cursos=$this->curso->getById($curso);
                $programas= $this->model->getAll();
                $count= $this->asistencia->countCentro($curso);

                require 'views/dashboard.php';
                require 'views/lista/lista.php';
                require 'views/dashboard_.php';

            }else{
                echo "Error, no se realizo.";
            }
        }
        public function new()
        {
            require 'views/dashboard.php';
            $centros= $this->centro->getCentroActivo();
            $estudiante= $this->model->getAll();
            require 'views/profesor/nuevo.php';
            require 'views/dashboard_.php';
        }
        public function save()
        {    
           
            $dataUsuario=[
                'email'  => $_POST['email'],
                'clave'  => $_POST['documento'],
                'estado' => "activo",
                'id_rol' => 2
            ];

            $this->usuario->newUsuario($dataUsuario);

            $id_usuario= $this->usuario->getUltimoId();
            $dataPersona= [
                'nombre'           => $_POST['nombre'],
                'apellido'         => $_POST['apellido'],
                'documento'        => $_POST['documento'],
                'telefono'         => $_POST['telefono'],
                'fecha_nacimiento' => $_POST['fecha_nacimiento'],
                'eps'              => $_POST['eps'],
                'rh'               => $_POST['rh'],
                'id_usuario'       => $id_usuario[0]->id_usuario,   
                'id_estado'        => 1,
                'id_curso'         => $_POST['id_curso']
            ];
            $this->model->newEstudiante($dataPersona);
            header ('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    public function edit()
    {
        if(isset($_REQUEST['id'])){
            $id=$_REQUEST['id'];

            $data=$this->model->getById($id);
            //var_dump($data);

            require 'views/dashboard.php';
            require 'views/lista/editar.php';
            require 'views/dashboard_.php';
        }else{
            echo "Error, no se realizo.";
        }
    }
    public function update()	
    {
        if (isset($_POST)) {
            
            $dataUsuario=[
                'email'  => $_POST['email'],
                'id_usuario' => $_POST['id_usuario']
            ];

            $this->usuario->updateUsuario($dataUsuario);

            $dataPersona= [
                'id_persona'       => $_POST['id_persona'],
                'nombre'           => $_POST['nombre'],
                'apellido'         => $_POST['apellido'],
                'documento'        => $_POST['documento'],
                'telefono'         => $_POST['telefono'],
                'fecha_nacimiento' => $_POST['fecha_nacimiento'],
                'eps'              => $_POST['eps'],
                'rh'               => $_POST['rh']
            ];

            $this->model->updateEstudiante($dataPersona);

            header ('Location: ?controller=estudiante&method=view&id='.$_POST['id_curso']);	
        }else{
            echo "Error";
        }
    }
       public function updateStatus()
    {
        $movie = $this->model->getById($_REQUEST['id']);

        $data = [];

        if($movie[0]->id_estado == 1) { 
            $data = [
                'id' => $movie[0]->id,
                'id_estado' => 2
            ];
        } elseif($movie[0]->id_estado == 2) {
            $data = [
                'id' => $movie[0]->id,
                'id_estado' => 3
            ];
        }elseif($movie[0]->id_estado == 3) {
            $data = [
                'id' => $movie[0]->id,
                'id_estado' => 1
            ];
        }
       
        $this->model->editStatus($data);
         header ('Location: ' . $_SERVER['HTTP_REFERER']);  


    
    }
}
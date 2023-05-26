<?php
    require 'models/Profesor.php';
    require 'models/Centro.php';
    require 'models/Usuario.php';
    require 'models/Curso.php';

    class ProfesorController
    {
        //hacer DESPUES las demas variables de estado y demas..
        private $model;
        private $usuario;
        private $centro;
        private $curso;

        public function __construct()
        {
            //hacer los demas procesos con estado y demas..
            $this->model= new Profesor;
            $this->centro= new Centro;
            $this->usuario= new Usuario;
            $this->curso= new Curso;
        }
        public function index()
        {
            
            require 'views/dashboard.php';
            $profesores= $this->model->getAll();
            $profesorI= $this->model->getAllInactive();
            $centros= $this->centro->getCentroActivo();
            $cursos= $this->curso->getAll();
            require 'views/profesor/lista.php';
            require 'views/dashboard_.php';
        }
        public function add()
        {
            require 'views/dashboard.php';
            require 'views/profesor/nuevo.php';
            require 'views/dashboard_.php';
        }
        public function save()
        {    
            $dataUsuario=[
                'email'  => $_POST['email'],
                'clave'  => "",
                'estado' => "activo",
                'id_rol' => 3
            ];

            $id_usuario= $this->usuario->getUltimoId();
            $email= $_POST['email'];
            
            $dataPersona= [
                'nombre'           => $_POST['nombre'],
                'apellido'         => $_POST['apellido'],
                'documento'        => $_POST['documento'],
                'telefono'         => $_POST['telefono'],
                'fecha_nacimiento' => $_POST['fecha_nacimiento'],
                'eps'              => $_POST['eps'],
                'rh'               => $_POST['rh'],
                'id_usuario'       => $id_usuario[0]->id_usuario,
                'id_centro'        => $_POST['id_centro'],
                'id_estado'        => 1
            ];

            $letras= '/^[á é í ó ú a b c d e f g h i j k l m n ñ o p q r s t u v w x y z A B C D E F G H I J K L M N Ñ O P Q R S T U V W X Y Z]+$/i';
            $numeros= '/^[0-9]/i';
            
            $arrayCursos = isset($_POST['cursos']) ? $_POST['cursos'] : [];
            
            if(!empty($arrayCursos) && isset($_POST['nombre'])) {
                
                $repetido= $this->model->getRepetido($email);

                $respUsuario= $this->usuario->newUsuario($dataUsuario);
                $respPersona= $this->model->newProfesor($dataPersona);

                $ultimaPersona= $this->model->getUltimoId();

                $respCursos=  $this->model->saveCursos($arrayCursos, $ultimaPersona[0]->id_persona);
            }else{
                $respPersona= false;
                $respUsuario= false;
                $respCursos= false;
            }

            $arrayResp= [];

            if($respCursos == true && $respPersona == true) {
                $arrayResp= [
                    'success' => true,
                    'message' => "Profesor Creado Exitosamente"
                ];
            }
            elseif($_POST['nombre'] == '' ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo NOMBRE es requerido"
                ];
            }
            elseif(strlen ($_POST['nombre']) > 30 ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo NOMBRE debe tener menos de 30 Letras"
                ];
            }
            elseif(strlen ($_POST['nombre']) < 4 ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo NOMBRE debe tener al menos 4 Letras"
                ];
            }
            elseif(!preg_match($letras, $_POST['nombre']) ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo NOMBRE se requieren solo Letras"
                ];
            }
            elseif($_POST['apellido'] == '' ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo APELLIDO es requerido"
                ];
            }
            elseif(strlen ($_POST['apellido']) > 30 ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo APELLIDO debe tener menos de 30 Letras"
                ];
            }
            elseif(strlen ($_POST['apellido']) < 4 ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo APELLIDO debe tener al menos 4 Letras"
                ];
            }
            elseif(!preg_match($letras, $_POST['apellido']) ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo APELLIDO se requieren solo Letras"
                ];
            }
            elseif($_POST['documento'] == '' ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo DOCUMENTO es requerido"
                ];
            }
            elseif(strlen ($_POST['documento']) < 8 || strlen ($_POST['documento']) > 10  ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo DOCUMENTO debe tener al menos 10 u 8 números"
                ];
            }
            elseif(!preg_match($numeros, $_POST['documento']) ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo DOCUMENTO se requieren solo Números"
                ];
            }
            elseif($_POST['telefono'] == '' ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo TELÉFONO es requerido"
                ];
            }
            elseif(strlen ($_POST['telefono']) != 10){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo TELÉFONO debe tener 10 números"
                ];
            }
            elseif(!preg_match($numeros, $_POST['telefono']) ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo TELÉFONO se requieren solo Números"
                ];
            }
            elseif($_POST['eps'] == '' ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo EPS es requerido"
                ];
            }
            elseif($_POST['rh'] == '' ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo RH es requerido"
                ];
            }
            elseif($_POST['fecha_nacimiento'] == '' ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "La FECHA DE NACIMIENTO es requerido"
                ];
            }
            
            elseif($_POST['email'] == '' ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "El campo EMAIL es requerido"
                ];
            }
            elseif($_POST['id_centro'] == '' ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "Se edebe escoger un DEPORTE"
                ];
            }
            elseif($arrayCursos == '' ){
                $arrayResp= [
                    'error'   => false,
                    'message' => "Se deben asignar Cursos al Profesor"
                ];
            }
            else{
                $arrayResp= [
                    'error'   => false,
                    'message' => "Error creando el Profesor, No se han asignado cursos"
                ];
            }
            echo json_encode($arrayResp);
            return;
            
        }
        public function view()
		{
			if (isset($_REQUEST['persona'])) {
                $id_persona= $_REQUEST['persona'];
                $id_usuario= $_REQUEST['usuario'];
                $data= $this->model->getProfesorId($id_persona);
                $dataUsuario= $this->usuario->getUsuarioId($id_usuario);
                $centros= $this->centro->getCentroActivo();
                $cursos= $this->curso->getAll();
                $asigCursos= $this->model->getCursos($id_persona);

				require 'views/dashboard.php';
                require 'views/profesor/editar.php';
                require 'views/dashboard_.php';
			}else{
				echo "Error";
			}
        }
        public function update()	
		{
            $arrayResp = [];

			if (isset($_POST)) {
                
                $dataUsuario=[
                    'id_usuario' => $_POST['id_usuario'],
                    'email'  => $_POST['email'],
                    'clave' => "",
                    'estado' => "activo",
                    'id_rol' => 3

                ];
                $email= $_POST['email'];
                $dataPersona= [
                    'id_persona'       => $_POST['id_persona'],
                    'nombre'           => $_POST['nombre'],
                    'apellido'         => $_POST['apellido'],
                    'documento'        => $_POST['documento'],
                    'telefono'         => $_POST['telefono'],
                    'fecha_nacimiento' => $_POST['fecha_nacimiento'],
                    'eps'              => $_POST['eps'],
                    'rh'               => $_POST['rh'],
                    'id_usuario'       => $_POST['id_usuario'],
                    'id_centro'        => $_POST['id_centro'],
                    'id_estado'        => 1
                ];

                $letras= '/^[á é í ó ú a b c d e f g h i j k l m n ñ o p q r s t u v w x y z A B C D E F G H I J K L M N Ñ O P Q R S T U V W X Y Z]+$/i';
                $numeros= '/^[0-9]/i';

                $arrayCursos= isset($_POST['cursos']) ? $_POST['cursos'] : [];

                if(!empty($arrayCursos)) {

                    $repetido= $this->model->getRepetido($email);   
                    $respUsuario= $this->usuario->updateUsuario($dataUsuario);
                    $respPersona= $this->model->updateProfesor($dataPersona);

                    $this->model->deleteDetalle($_POST['id_persona']);

                    $respCursos=  $this->model->saveCursos($arrayCursos, $_POST['id_persona']);
                }else{
                    $respPersona= false;
                    $respUsuario= false;
                    $respCursos= false;
                }
                $arrayResp= [];
                if($respCursos == true && $respPersona == true) {
                    $arrayResp= [
                        'success' => true,
                        'message' => "Profesor Creado Exitosamente"
                    ];
                }
                elseif($_POST['nombre'] == '' ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo NOMBRE es requerido"
                    ];
                }
                elseif(strlen ($_POST['nombre']) > 30 ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo NOMBRE debe tener menos de 30 Letras"
                    ];
                }
                elseif(strlen ($_POST['nombre']) < 4 ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo NOMBRE debe tener al menos 4 Letras"
                    ];
                }
                elseif(!preg_match($letras, $_POST['nombre']) ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo NOMBRE se requieren solo Letras"
                    ];
                }
                elseif($_POST['apellido'] == '' ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo APELLIDO es requerido"
                    ];
                }
                elseif(strlen ($_POST['apellido']) > 30 ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo APELLIDO debe tener menos de 30 Letras"
                    ];
                }
                elseif(strlen ($_POST['apellido']) < 4 ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo APELLIDO debe tener al menos 4 Letras"
                    ];
                }
                elseif(!preg_match($letras, $_POST['apellido']) ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo APELLIDO se requieren solo Letras"
                    ];
                }
                elseif($_POST['documento'] == '' ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo DOCUMENTO es requerido"
                    ];
                }
                elseif(strlen ($_POST['documento']) < 8 || strlen ($_POST['documento']) > 10  ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo DOCUMENTO debe tener al menos 10 u 8 números"
                    ];
                }
                elseif(!preg_match($numeros, $_POST['documento']) ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo DOCUMENTO se requieren solo Números"
                    ];
                }
                elseif($_POST['telefono'] == '' ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo TELÉFONO es requerido"
                    ];
                }
                elseif(strlen ($_POST['telefono']) != 10){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo TELÉFONO debe tener 10 números"
                    ];
                }
                elseif(!preg_match($numeros, $_POST['telefono']) ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo TELÉFONO se requieren solo Números"
                    ];
                }
                elseif($_POST['eps'] == '' ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo EPS es requerido"
                    ];
                }
                elseif($_POST['rh'] == '' ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo RH es requerido"
                    ];
                }
                elseif($_POST['fecha_nacimiento'] == '' ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "La FECHA DE NACIMIENTO es requerido"
                    ];
                }
                elseif($_POST['email'] == '' ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "El campo EMAIL es requerido"
                    ];
                }
                elseif($_POST['id_centro'] == '' ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "Se edebe escoger un DEPORTE"
                    ];
                }
                elseif($arrayCursos == '' ){
                    $arrayResp= [
                        'error'   => false,
                        'message' => "Se deben asignar Cursos al Profesor"
                    ];
                }
                echo json_encode($arrayResp);
                return;

            }else{
                echo 'error';
            }
        }
        public function inactivar()
		{
			$profesor= $this->model->getProfesorId($_REQUEST['persona']);
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
        public function activar()
		{
			$profesor= $this->model->getProfesorId($_REQUEST['persona']);
			$data= [];
			if ($profesor[0]->id_estado == 2) {
				$data=[
                        'id_persona' => $profesor[0]->id_persona, 
                        'id_estado'  =>1
					  ];
			}
			$this->model->updateProfesor($data);
			header('Location: ?controller=profesor');
		}
    }
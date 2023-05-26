<?php
	
	/**
	 * Clase InscripcionController
	 */

	require 'models/Usuario.php';
	require 'models/Profesor.php';
	

	class UsuarioController
	{
		private $model;
		private $persona;

		public function __construct()
		{
			$this->model = new Usuario;
			$this->persona = new Profesor;
		}

		public function index() 
		{
			$usuariopersona = $this->model->getAll();	
			require 'views/dashboard.php';
			require 'views/usuario/lista.php';
			require 'views/dashboard_.php';
		}

		//muestra la vista de crear
		public function add() 
		{
			require 'views/dashboard.php';       
			require 'views/usuario/nuevo.php';
		}

		// Realiza el proceso de guardar
		public function save()
		{
			$this->model->newUsuario($_REQUEST);			
			header('Location: ?controller=usuario');
		}

		//muestra la vista de editar
		public function view()
		{
			if(isset($_REQUEST['id_usuario'])) {
				$id = $_REQUEST['id_usuario'];
				$data = $this->model->getById($id);
				$rolusuario = $this->model->getActiveRol();

				require 'views/dashboard.php';
				require 'views/usuario/editar.php';
				require 'views/dashboard_.php';
			} else {
				echo "Error";
			}
		}
		public function info()
		{
			if(isset($_REQUEST['id'])) {
				$id= $_REQUEST['id'];
				$persona= $this->model->getPersona($id);

				require 'views/dashboard.php';
				require 'views/usuario/info.php';
				require 'views/dashboard_.php';
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function update()
		{
			
			if(isset($_POST)) {

				$data=[
					'id_usuario' => $_POST['id_usuario'],
					'email'    	 => $_POST['email'],
				];
				$this->model->updateUsuario($data);	
				//var_dump($data);

				$dataPersona=[
					'id_persona'       => $_POST['id_persona'],
					'nombre'    	   => $_POST['nombre'],
					'apellido'    	   => $_POST['apellido'],
					'documento'    	   => $_POST['documento'],
					'telefono'    	   => $_POST['telefono'],
					'fecha_nacimiento' => $_POST['fecha_nacimiento']

				];			
				$this->persona->updateProfesor($dataPersona);	
				//var_dump($dataPersona);	

				header('Location:' . $_SERVER['HTTP_REFERER']);
			} else {
				echo "Error";
			}
		}


		// Realiza el proceso de borrar
		public function delete()
		{			
			$this->model->deleteUsuario($_REQUEST);		
			header('Location: ?controller=usuario');
		}



	}

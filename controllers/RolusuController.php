<?php
	
	/**
	 * Clase RolusuarioController
	 */

	require 'models/Rolusu.php';
	

	class RolusuController
	{
		private $model;
		
		public function __construct()
		{
			$this->model = new Rolusu;
			
		}

		public function index() 
		{
			$rolusuario = $this->model->getAll();
			
			require 'views/dashboard.php';
			require 'views/rol/lista.php';
			require 'views/dashboard_.php';
		}

		//muestra la vista de crear
		public function add() 
		{
			require 'views/dashboard.php';       
			require 'views/rol/nuevo.php';
		}

		// Realiza el proceso de guardar
		public function save()
		{
			$this->model->newRolusu($_REQUEST);			
			header('Location: ?controller=rolusu');
		}

		//muestra la vista de editar
		public function view()
		{
			if(isset($_REQUEST['id_rol'])) {
				$id = $_REQUEST['id_rol'];
				$data = $this->model->getById($id);

				require 'views/dashboard.php';
				require 'views/rol/editar.php';
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
				'id_rol' => $_POST['id_rol'],
				'nombre' => $_POST['nombre']
				
			];
				$this->model->updateRolusu($data);			
				header('Location: ?controller=rolusu');				
			} else {
				echo "Error";
			}
		}


		// Realiza el proceso de borrar
		public function delete()
		{			
			$this->model->deleteRolusu($_REQUEST);		
			header('Location: ?controller=rolusu');
		}
	}

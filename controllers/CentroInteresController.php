<?php

	require 'models/Centrointeres.php';

	class CentroInteresController
	{
		private $model;
		/*private $categoriacen;*/
		
		public function __construct()
		{
			$this->model = new Centrointeres;
			/*$this->categoriacen = new Categoriacen;*/
		}

		public function index() 
		{
			require 'views/dashboard.php';
			//Llamado al metodo que trae todos los usuarios
			$centrointeres = $this->model->getAll();
			$categoriacentro = $this->model->getActiveCategoriacen();
			require 'views/centro/lista.php';
			require 'views/dashboard_.php';
		}

		//muestra la vista de crear
		public function add() 
		{
			require 'views/dashboard.php';       
			require 'views/centro/nuevo.php';
			require 'views/dashboard_.php';
		}

		// Realiza el proceso de guardar
		public function save()
		{
			if(isset($_POST['nombre'])){
				$data= [
					'nombre'           => $_POST['nombre'],
					'id_categoria'     => $_POST['id_categoria'],
					'cupos'            => $_POST['cupos'],
					'hora_inicio'      => $_POST['hora_inicio'],
					'hora_final'       => $_POST['hora_final'],
					'estado'		   => 'activo'
				];
				
				$centro= $this->model->newCentroIntere($data);
				header('Location: ?controller=centrointeres');
			}else{
				$centro= false;
			}
		}

		//muestra la vista de editar
		public function view()
		{
			if(isset($_REQUEST['id_centro'])) {
				$id = $_REQUEST['id_centro'];
				$data = $this->model->getById($id);
				$categoriacentro = $this->model->getActiveCategoriacen();

				require 'views/dashboard.php';
				require 'views/centro/editar.php';
				require 'views/dashboard_.php';
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function update()
		{
			if(isset($_POST)) {				
				$data= [
					'id_centro'        => $_POST['id_centro'],
                    'nombre'           => $_POST['nombre'],
                    'id_categoria'     => $_POST['id_categoria'],
                    'cupos'            => $_POST['cupos'],
					'hora_inicio'      => $_POST['hora_inicio'],
					'hora_final'       => $_POST['hora_final'],
					'estado'		   => $_POST['estado']
				];
				$this->model->updateCentrointere($data);

				header('Location: ?controller=centrointeres');
			} else {
				echo "Error";
			}
		}


		// Realiza el proceso de borrar
		public function delete()
		{			
			$this->model->deleteCentroIntere($_REQUEST);		
			header('Location: ?controller=centrointeres');
		}
	}   


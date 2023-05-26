<?php

	require 'models/Inscripcion.php';
	
	class InscripcionController
	{
		private $model;
		/*private $curso;*/
		
		public function __construct()
		{
			$this->model = new Inscripcion;
			/*$this->curso= new Curso;*/
		}

		public function index() 
		{
			require 'views/dashboard.php';
			$inscripcion = $this->model->getAll();
			require 'views/inscripcion/lista.php';
			require 'views/dashboard_.php';
		}

		public function view()
		{
			if(isset($_REQUEST['id'])) {
				$curso = $_REQUEST['id'];
				$estudiante = $_REQUEST['persona'];
				$cursos = $this->model->getById($curso);
				$idpersona = $this->model->getActivePers($estudiante);
				$count= $this->model->countPersona($estudiante);

				require 'views/dashboard.php';
				require 'views/inscripcion/nuevo.php';
				require 'views/dashboard_.php';
			} else {
				echo "Error";
			}
		}
		public function save() 
		{
			if (isset($_REQUEST['id_persona'])) {
				$persona=$_REQUEST['id_persona'];
				$data=[
					'fecha'=>$_POST['fecha'],
					'anualidad'=>$_POST['anualidad'],
					'id_persona'=>$persona,
					'id_plan'=>$_POST['id_plan'],
					'estado'=>"estado"
				];
				
				$newpersona=$this->model->newInscrip($data);
				header('Location: ?controller=inscripcion');
			}
		}
		public function mostrar() 
		{
			if(isset($_REQUEST['curso'])) {
				$curso = $_REQUEST['curso'];
				$estudiante = $_REQUEST['id'];
				$cursos = $this->model->getById($curso);
				$centros = $this->model->getCentro($curso);
				$idpersona = $this->model->getAllPerson($estudiante);

				require 'views/dashboard.php';
				require 'views/inscripcion/editar.php';
				require 'views/dashboard_.php';
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function update()
		{
			if(isset($_POST['id_inscripcion'])) {				
				$data= [
					'id_inscripcion'   => $_POST['id_inscripcion'],
                    'id_plan'          => $_POST['id_plan']
				];
				$this->model->updateInscrip($data);

				header('Location: ?controller=inscripcion');
			} else {
				echo "Error";
			}
		}

		public function delete()
		{			
			$this->model->deleteInscrip($_REQUEST);		
			header('Location: ?controller=inscrip');
		}
	}

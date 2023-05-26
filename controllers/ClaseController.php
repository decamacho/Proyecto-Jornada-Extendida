<?php
    require 'models/Clase.php';
    require 'models/Plan.php';

    class ClaseController
    {
        private $model;
        private $plan;

        public function __construct()
        {
            $this->model= new Clase;
            $this->plan = new Plan;
        }
        
        public function add()
        {
            require 'views/dashboard.php';
            require 'views/programacion/lista.php';
            require 'views/dashboard_.php';
        }

        public function view()
		{
			if (isset($_REQUEST['clase'])) {
                $clase= $_REQUEST['clase'];

                $clase= $this->model->getClase($clase);
                require 'views/dashboard.php';
                require 'views/asistencia/detalle.php';
                require 'views/dashboard_.php';
			}else{
				echo "No se puede realizar la operación";
			}
        }
        public function save()
        {    
            if(isset($_REQUEST['plan'])){

                $validateClase= $this->model->validateClase($_POST);
                $plan= $_REQUEST['plan'];

                if($validateClase === false){
                    $dataClase=[
                        'fecha'        => $_POST['fecha'],
                        'descripcion'  => $_POST['descripcion'],
                        'id_plan'      => $plan,
                        'estado'       => 'activo'
                    ];
        
                    $this->model->newClase($dataClase);
        
                    header ('Location: ' . $_SERVER['HTTP_REFERER']);
                }else{
                    $error = [
                        'errorMessage' => $validateClase
                    ];
                    require 'views/dashboard.php';
                    require 'views/asistencia/detalle.php';
                    require 'views/dashboard_.php';
                }   
            }
        }
        public function savemax()
        {    
            if(isset($_REQUEST['plan']))
            $plan= $_REQUEST['plan'];

            $dataClase=[
                'fecha'        => $_POST['fecha'],
                'descripcion'  => $_POST['descripcion'],
                'id_plan'      => $plan,
                'estado'       => 'activo'
            ];

            $this->model->newClase($dataClase);

            header ('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        public function savemin()
        {    
            if(isset($_REQUEST['plan']))
            $plan= $_REQUEST['plan'];

            $dataClase=[
                'fecha'        => $_POST['fecha'],
                'descripcion'  => $_POST['descripcion'],
                'id_plan'      => $plan,
                'estado'       => 'activo'
            ];

            $this->model->newClase($dataClase);

            header ('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
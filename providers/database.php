<?php

    class Database extends PDO
    {
        private $driver= 'mysql';
        private $host= 'localhost';
        private $dbname= 'jornadaextendida';
        private $charset= 'utf8';
        private $user= 'root';
        private $password= '';

        public function __construct()
        {
            try{
                parent::__construct("{$this->driver}: host={$this->host}; dbname={$this->dbname}; charset={$this->charset}", $this->user, $this->password);
                $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch (PDOException $e) {
                echo "Conexion Fallida {$e->getMessage()}";
            }
        }
        public function select($strSql, $arraydata=array(), $fetchMode= PDO::FETCH_OBJ)
        {
            $query= $this->prepare($strSql);

            foreach($arraydata as $key => $value){
                $query->bindParam(":$key", $value);
            }
            if(!$query->execute()){
                echo "Error, la consulta no se realizo";
            }else{
                return $query->fetchAll($fetchMode);
            }
        }

        public function insert($table, $data)
        {
            try{
                ksort($data);
                unset($data['controller'], $data['method']);

                $fieldNames= implode('`,`', array_keys($data));
                $fieldValues= ':' . implode(', :', array_keys($data));
                $strSql= $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

                foreach($data as $key => $value){
                    $strSql->bindValue(":$key", $value);
                }
                $strSql->execute();

            }catch (PDOException $e){
                die($e->getMessage());
            }
        }

        public function update($table, $data, $where)
        {
            try{
                ksort($data);
				$fieldDetails= null;

                foreach ($data as $key => $value) {
                    $fieldDetails.= "`$key`=:$key, ";
                }
                $fieldDetails= rtrim($fieldDetails, ', ');

                $strSql= $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

                foreach ($data as $key => $value) {
                    $strSql->bindValue(":$key", $value);
                }
                $strSql->execute();
                
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        public function delete($table, $where){
            try{
                return $this->exec("DELETE FROM $table WHERE $where");
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
    }
    
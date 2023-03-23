<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    
    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }

        public function listInfoUser($id){
                $sql = "SELECT *
                FROM '.$this->tableName.'
                WHERE user_id = :id";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id], true), 
            $this->className
                    );

        }
    }
<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    //use Model\Managers\UserManager; //

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";


        public function __construct(){
            parent::connect();
        }

        public function findPostByTopic($id){

            $sql="SELECT *
                    FROM ".$this->tableName."
                    WHERE topic_id=:id"
            
            return $this->getMultipleResults(
                DAO::select($sql,['id'=>$id]),
                $this->className
            );
        }

    }
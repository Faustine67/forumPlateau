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

            $sql="SELECT postDate,content,nickname
                    FROM ".$this->tableName."
                    INNER JOIN user ON post.user_id=user.id_user
                    WHERE topic_id=:id
                    ORDER BY postDate DESC";
            
            return $this->getMultipleResults(
                DAO::select($sql,['id'=>$id]),
                $this->className
            );
        }

    }
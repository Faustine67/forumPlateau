<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";

        public function __construct(){
            parent::connect();
        }

        //Affichage des topics d'une categorie, classés par date
        public function listPostSelected($id){
            $sql="SELECT *
            FROM ".$this->tableName."
            WHERE topic_id = :id
            ORDER BY postDate DESC";

            return $this-> getMultipleResults(
                DAO::select($sql,['id'=>$id],true),
                $this->className
            );
        }

        //Ajouter une nouveau post dans un topic
        public function addNewPost($id){
            $sql="INSERT INTO post (content)
            VALUES (:post)";
            
            return $this-> getMultipleResults(
                DAO::select($sql,['id'=>$id],true),
                $this->className
            );
        }

          //Supprimer un post
          public function deletePost($id){
            $this->delete($id);    
        }
        }
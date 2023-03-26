<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    //use Model\Managers\TopicManager;

    class CategoryManager extends Manager{

        protected $className = "Model\Entities\Category";
        protected $tableName = "category";


        public function __construct(){
            parent::connect();
        }

        //Afficher toutes les categories
        public function findAllCategories(){
            $sql="SELECT *
            FROM category
            ORDER BY categoryName ASC";

        return $this->getMultipleResults(
            DAO::select($sql),$this->className);
        }

        //AJouter une category
        public function addNewCategory(){
            $sql="INSERT INTO category (categoryName)
            VALUES (:categoryName)";

            return $this-> getMultipleResults(
                DAO::select($sql,['id'=>$id],true),
                $this->className
            );
        }
    }
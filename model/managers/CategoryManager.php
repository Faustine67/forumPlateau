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

        //AJouter une category
        public function addNewCategory(){
            // $sql="INSERT INTO category (categoryName)
            // VALUES (:categoryName)";

           
        }
    }
<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\CategoryManager;

    class CategoryManager extends Manager{

        protected $className = "Model\Entities\Category";
        protected $tableName = "category";


        public function __construct(){
            parent::connect();
        }

        // public function find
        public function findAllCategory(){
            $sql="SELECT *
            FROM category
            ORDER BY categoryName ASC";

            return $this->getMultipleResults(
                DAO::select($sql,['id'=>$id]),
                $this->className
            );
        }

    }
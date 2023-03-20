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

        //Afficher toutes les categories
        public function findAllCategories(){
            $sql="SELECT *
            FROM category
            ORDER BY categoryName ASC";

        return $this->getOneOrNullResult(
            DAO::select($sql,['categoryName'=>$CategoryName],false),
            $this->className
             );
        }

    }
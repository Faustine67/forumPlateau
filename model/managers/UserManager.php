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
			$this->className);
		}

		public function findOnebyEmail($email){
            $sql = "SELECT *
            FROM ".$this->tableName." a
            WHERE email = :email";

            return $this->getOneorNullResult(
                DAO::select($sql, ['email' => $email],false),
                $this->className);
        }
		
		public function addNewUser (){

			$sql = "INSERT INTO user (nickname,email,password) 
					VALUES (:nickname,:email,:password)";

					return $this-> getMultipleResults(
						DAO::select($sql, ['id'=>$id], true),
						$this->className);
		}
    }

// Dans UserManager

// --On stocke la requête dans une variable $sql

// --On passe par la méthode "getOneOrNullResult" qui nous renvoie soit un objet User 
//(ce qui voudrait dire que l'utilisateur a été retrouvé en BDD) soit "NULL" (ce qui veut dire qu'il n'a pas été trouvé)

// --dans la méthode "select" de la classe DAO, 
//on fait bien passer un tableau associatif nous permettant d'exécuter la requête dans les bonnes conditions 
//et de ne pas s'exposer à la faille de l'injection SQL
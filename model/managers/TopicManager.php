<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

class TopicManager extends Manager
{
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";


    public function __construct()
    {
        parent::connect();
    }

    //Affichage des topics d'une categorie, classés par date
    public function topicSelectedByCategory($id)
    {
        $sql="SELECT *
            FROM ".$this->tableName."
            WHERE category_id = :id
            ORDER BY topicDate DESC";

        return $this-> getMultipleResults(
            DAO::select($sql, ['id'=>$id], true),
            $this->className
        );
    }
    // Ajouter un nouveau topic
     public function addNewTopic($id)
     {
         $sql="INSERT INTO topic (topicName)
            VALUES (:topicName)";

         return $this-> getMultipleResults(
             DAO::select($sql, ['id'=>$id], true),
             $this->className
         );
     }

    //Supprimer un topic
    public function deleteTopic($id)
    {
        $this->delete($id);
    }
}
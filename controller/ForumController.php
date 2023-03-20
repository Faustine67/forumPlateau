<?php
// Les controllers se contentent de réceptionner la requête demandée par le client, 
//interrogent le manager adéquat et envoient les informations à la vue
    
namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\CategoryManager;
    use Model\Managers\PostManager;
    use Model\Managers\TopicManager;
    use Model\Managers\UserManager;


    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          

           $topicManager = new TopicManager();
    //Il faudra aussi comprendre que la méthode "findAll" est une méthode générique qui provient de Manager.php
    //dont hérite chaque controller de l'application)
            return [
                "view" => VIEW_DIR."forum_faustine/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["topicName", "DESC"])
                ]
            ];
        
        }
        public function listeCategories(){
            $categoryManager = new CategoryManager();

            return[
                "view" => VIEW_DIR."forum_faustine/listCategories.php",
                "data"=>["category"=> $categoryManager => findAll(["categoryName","DESC"])
                ]
                ];
        }

        public function listeTopicsSelected($id){
            $topicManager = new TopicManager();

            return[
                "view" =>VIEW_DIR."forum_faustine/listTopics.php",
                "data"=>["topic"=>$topicManager->listeTopicsSelected($id)
                ]
            ]
        }

        public function listePostsSelected($id){
            $postManager = new PostManager();

            return[
                "view"=> VIEW_DIR."forum_faustine/listPost.php",
                "data"=>["post"=>$PostManager->listePostsSelected($id)
                ]
            ]
        }
        

    }

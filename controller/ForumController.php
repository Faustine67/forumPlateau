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
           $categoryManager = new CategoryManager();
    //Il faudra aussi comprendre que la méthode "findAll" est une méthode générique qui provient de Manager.php
    //dont hérite chaque controller de l'application)
            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data"=> [
                    "categories"=>$categoryManager->findAll(["categoryName", "DESC"])
                ]
            ];
        }
        public function listTopics($id) {
            $categoryManager = new CategoryManager();
            $categories = $categoryManager->findAll(["categoryName", "DESC"]);
            
            $topicManager = new TopicManager();
            if(isset($id)) {
                $topics = $topicManager->findTopicSelected($id);
            } else {
                $topics = $topicManager->findAll(["topicName", "DESC"]);
            }
            
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "categories" => $categories,
                    "topics" => $topics
                ]
            ];
        }
        // public function listTopics(){
        //     $topicManager = new TopicManager();
        //     $categoryManager= new CategoryManager();
        //     return[
        //         "view"=> VIEW_DIR."forum/listTopics.php",
        //         "data"=>[
        //             "topics"=>$topicManager->findAll(["topicName","DESC"]),
        //             "categories"=>$categoryManager->findAll(["categoryName","DESC"])
        //         ]
        //     ];
        // }

        public function TopicSelected($id){
            $categoryManager= new CategoryManager();
            $topicManager = new TopicManager();
            if($id){
        
            return[
                "view"=>VIEW_DIR."forum/listTopics.php",
                "data"=>[
                    "category"=>$categoryManager->findAll(["categoryName","DESC"]),
                    "topics"=>$topicManager->listTopicSelected($id),
                ]
            ];
            } else{
                return[
                    "view"=>VIEW_DIR."forum/listTopics.php",
                    "data"=>[
                        "category"=>$categoryManager->findAll(["categoryName","DESC"]),
                        "topics"=>$topicManager->findAll(["topicName","DESC"]),
                    ]
                    ];
                }
            }

        // public function listePostsSelected($id){
        //     $postManager = new PostManager();

        //     return[
        //         "view"=> VIEW_DIR."forum/listPosts.php",
        //         "data"=>[
        //             "posts"=>$postManager->listePostsSelected($id),
        //         ]
        //     ];
        // }
        
        }

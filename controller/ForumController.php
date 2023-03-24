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
            $categorie = $categoryManager->findONeById($id);
            
            $topicManager = new TopicManager();
            if(isset($id)) {
                $topics = $topicManager->findTopicSelected($id);
            } else {
                $topics = $topicManager->findAll(["topicName", "DESC"]);
            }
            
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "categorie" => $categorie,
                    "topics" => $topics
                ]
            ];
        }

        public function topicSelected($id){
            $categoryManager= new CategoryManager();
            $topicManager = new TopicManager();

            if($id){
        
                return[
                    "view"=>VIEW_DIR."forum/listTopics.php",
                    "data"=>[
                        "categorie"=>$categoryManager->findAll(["categoryName","DESC"]),
                        "topics"=>$topicManager->listTopicSelected($id),
                    ]
                ];
            } else{

                return[
                    "view"=>VIEW_DIR."forum/listTopics.php",
                    "data"=>[
                        "categorie"=>$categoryManager->findAll(["categoryName","DESC"]),
                        "topics"=>$topicManager->findAll(["topicName","DESC"]),
                    ]
                 ];
            }
        }

        public function postSelected($id){
            $topicManager= new TopicManager();
            $postManager = new PostManager();

            if($id){

                return[
                    "view"=> VIEW_DIR."forum/listPosts.php",
                    "data"=>[
                        "topics"=>$topicManager->findOnebyId($id),
                        "posts"=>$postManager->listPostSelected($id),
                    ]
                ];

            } else{
                return[
                    "view"=>VIEW_DIR."forum/listTopics.php",
                    "data"=>[
                        "topics"=>$topicManager->findAll(["topicName","DESC"]),
                        "posts"=>$postManager->findAll(["content","DESC"]),
                        "error"=>"Le topic n'existe pas",
                    ]

                ];
            }
        }

        public function addNewTopic($id){
          
            $TopicManager = new TopicManager();
            $PostManager = new PostManager();
 
            if(isset($_POST['submit'])) {

                $topicName = filter_input(INPUT_POST, "topicName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if($topicName && $user) {

                    $newTopic = $TopicManager->add(["topicName" => $topicName, "category_id" => $id,"user_id" => $user]);                    $this->redirectTo('topic', $newTopic);
                }
            }
         
        }


        // public function detailUser($id){
          
        //     $userManager = new UserManager();
        //     $PostManager = new PostManager();
 
        //      return [
        //          "view" => VIEW_DIR."forum/detailUser.php",
        //          "data" => [
        //              "user" => $userManager->findOneById($id),
        //              "posts" => $postManager->listPostSelected($id)
        //          ]
        //      ];
         
        // }

    }

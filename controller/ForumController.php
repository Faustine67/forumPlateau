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
                    "categories"=>$categoryManager->findAllCategories()
                ]
            ];
        }

        //Afficher tous les topics par catégorie
        public function listTopics($id) {
            $categoryManager = new CategoryManager();
            $categorie = $categoryManager->findONeById($id);
            
            $topicManager = new TopicManager();
            //'if(isset($id) = Si l'id de category est different de nul alors premier if, sinon on utilise else
            // Si le parametre id (de category) n'est pas null, alors on affiche les topics qui lui appartiennent, sinon on affiche tous les topics
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
                        "categorie"=>$categoryManager->findOneById($id),
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

        public function addNewCategory(){
            $CategoryManager = new CategoryManager();
 
            if(isset($_POST['submit'])) {
                
                $categoryName = filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $user = 1;
                
                if($categoryName && $user) {
                    
                    $newCategory = $CategoryManager->add(["categoryName" => $categoryName,"user_id" => $user]);                    
                    $this->redirectTo('category', $newCategory);
                }
            }
         
        }

        public function addNewTopic($id){
            $TopicManager = new TopicManager();
 
            if(isset($_POST['submit'])) {
                
                $topicName = filter_input(INPUT_POST, "topicName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $user = 1;
                
                if($topicName && $user) {
                    
                    $newTopic = $TopicManager->add(["topicName" => $topicName, "category_id" => $id,"user_id" => $user]);                    
                    $this->redirectTo('topic', $newTopic);
                }
            }
         
        }

        public function addNewPost($id){
            $TopicManager = new TopicManager();
            $PostManager = new PostManager();
 
            if(isset($_POST['submit'])) {
                
                $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $user = 1;
                
                if($content && $user) {
                    
                    $newPost = $PostManager->add(["content" => $content, "topic_id" => $id,"user_id" => $user]);                    
                    $this->redirectTo('post', $newPost);
                }
            }
         
        }

        public function deleteTopic($id){
        $TopicManager = new TopicManager();
 
        if(isset($_POST['submit'])) {
            
            // $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $user = 1;
                
                $newTopic = $TopicManager->deleteTopic($id);                    
                $this->redirectTo('topic', $newTopic);
            
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

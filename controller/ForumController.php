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



class ForumController extends AbstractController implements ControllerInterface
{
	// La méthode index est égale à listCategories. Conformement à l'architecture du Forum, il est obligatoire que cette méthode existe.
	// La méthode index peut soit etre vide ( public function index{}), soit reprendre les paramètres d'une autre fonction, en l'occurence, ceux de listCategories
	// Ainsi, on aura la même vue que l'on soit sur indec ou sous listCategories	
public function index(){
		$categoryManager = new CategoryManager();
		//Il faudra aussi comprendre que la méthode "findAll" est une méthode générique qui provient de Manager.php
		//dont hérite chaque controller de l'application)
		return [
			"view" => VIEW_DIR . "forum/listCategories.php",
		// ON reprendra cette data dans la view listCategories.php
			"data" => [
				"categories" => $categoryManager->findAll(["categoryName", "DESC"])
			]
		];
	}

	public function listCategories(){
		$categoryManager = new CategoryManager();
		//Il faudra aussi comprendre que la méthode "findAll" est une méthode générique qui provient de Manager.php
		//dont hérite chaque controller de l'application)
		return [
			"view" => VIEW_DIR . "forum/listCategories.php",
			"data" => [
				"categories" => $categoryManager->findAll()
			]
		];
	}

	//Afficher tous les topics par catégorie
	public function topicSelectedByCategory($id){
		$categorieManager = new CategoryManager();
		$categorie = $categorieManager->findOneById($id);
		$topicsManager = new TopicManager();
		//if(isset($id) = Si l'id de category est different de nul alors premier if, sinon on utilise else
		// Si le parametre id (de category) n'est pas null, alors on affiche les topics qui lui appartiennent, sinon on affiche tous les topics
		if (isset($id)) {
			$topics = $topicsManager->topicSelectedByCategory($id);
		} else {
			$topics = null;
		}

		return [
			"view" => VIEW_DIR . "forum/listTopics.php",
			"data" => [
				"categorie" => $categorie,
				"topics" => $topics,
				"error" => "Le topic n'existe pas",


			]
		];
	}

	public function postSelectedbyTopic($id){
		$topicManager = new TopicManager();
		$postManager = new PostManager();

		if ($id) {

			return [
				"view" => VIEW_DIR . "forum/listPosts.php",
				"data" => [
					"topic" => $topicManager->findOnebyId($id),
					"posts" => $postManager->listPostSelected($id),
				]
			];
		} 
		else {
			return [
				"view" => VIEW_DIR . "forum/listTopics.php",
				"data" => [
					"topics" => $topicManager->findAll(["topicName", "DESC"]),
					"posts" => $postManager->findAll(["content", "DESC"]),
					"error" => "Le topic n'existe pas",
				]

			];
		}
	
            return [
                "view" => VIEW_DIR."forum/listSujets.php",
                "data" => [
                    "categories" => $categorieManager->findAll(["nom", "DESC"]),
                    "sujets" => $sujetManager->listSujets(),
                    "error" => "Aucun utilisateur n'est connecté"   
                ]
            ];
            
    }
	public function addNewCategory(){
		$CategoryManager = new CategoryManager();
		// var_dump($CategoryManager);die;

		if (isset($_POST['submit'])) {
			
			$categoryName = filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			// $user = 1;
			if ($categoryName) {
				
				$newCategory = $CategoryManager->add(["categoryName" => $categoryName]);
				$this->redirectTo('forum','listCategories',$newCategory);
			}
		}
	}

	public function addNewTopic($id){
		$TopicManager = new TopicManager();
		$PostManager = new PostManager();
		$user= Session::getUser();


		// On verifie que l'utilisateur est connecté 
		if(isset($_SESSION['user'])){
			if (isset($_POST['submit'])) {

				$topicName = filter_input(INPUT_POST, "topicName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$content = filter_input(INPUT_POST, "postName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$user = Session::getUser()->getId();

			if ($topicName && $user && $content) {

				$newTopic = $TopicManager->add(["topicName" => $topicName, "category_id" => $id, "user_id" => $user]);
				$newPost = $PostManager->add(["content" => $content, "topic_id" => $newTopic, "user_id" => $user]);
				$this->redirectTo('forum', 'postSelectedbyTopic', $newTopic);
			}
		}
		}
	}

	public function addNewPost($id){
		$TopicManager = new TopicManager();
		$PostManager = new PostManager();
		$user= Session::getUser();


		// On verifie que l'utilisateur est connecté 
        if(isset($_SESSION['user'])) {
			if (isset($_POST['submit'])) {

				$content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$user =Session::getUser()->getId();

				if ($content && $user) {

					$newPost = $PostManager->add(["content" => $content, "topic_id" => $id, "user_id" => $user]);
					$this->redirectTo('forum', 'postSelectedbyTopic', $TopicManager->findOneById($id)->getId());
				}
			}
		}
	}
            
	public function deleteTopic($id){
		$TopicManager = new TopicManager();
		$PostManager = new PostManager();
		$listPost = $PostManager->listPostSelected($id);
		$user= Session::getUser();
		
		if(isset($_SESSION['user'])){
		// foreach qui supprime tous les posts enfants
			if (isset($listPost) && !empty($listPost)) {

				foreach ($listPost as $post) {
					$PostManager->delete($post->getId());
				}
				$TopicManager->delete($id);
				$this->redirectTo('forum', "listCategories");
			}
		}
	}

	public function deletePost($id){
		$PostManager = new PostManager();
		$post = $PostManager->findOneById($id);
		$user= Session::getUser();

		if(isset($_SESSION['user'])){
		$PostManager->delete($id);
		//Poru redirectTo 1er argument= le controller, 2eme=la méthode,3eme=l'id (le 3eme est facultatif)  //     
		$this->redirectTo("forum", "postSelected", $post->getTopic()->getId());
		}
	}


        //  public function detailUser($id){
          
        //     $userManager = new UserManager();
        //      $PostManager = new PostManager();
 
        //      return [
        //          "view" => VIEW_DIR."forum/detailUser.php",
        //          "data" => [
        //               "user" => $userManager->findOneById($id),
        //              // "posts" => $postManager->listPostSelected($id)
        //          ]
        //      ];
         
        }

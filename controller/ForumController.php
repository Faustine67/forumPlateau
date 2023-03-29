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

	public function index()
	{
		$categoryManager = new CategoryManager();
		//Il faudra aussi comprendre que la méthode "findAll" est une méthode générique qui provient de Manager.php
		//dont hérite chaque controller de l'application)
		return [
			"view" => VIEW_DIR . "forum/listCategories.php",
			"data" => [
				"categories" => $categoryManager->findAll(["categoryName", "DESC"])
			]
		];
	}

	//Afficher tous les topics par catégorie
	public function topicSelectedByCategory($id)
	{
		$categorie = new CategoryManager();
		$topics = new TopicManager();
		$posts = new PostManager();

		//'if(isset($id) = Si l'id de category est different de nul alors premier if, sinon on utilise else
		// Si le parametre id (de category) n'est pas null, alors on affiche les topics qui lui appartiennent, sinon on affiche tous les topics
		if (isset($id)) {
			$topics = $topics->findOneById($id);
		} else {
			$topics = $topics->findAll(["topicName", "DESC"]);
		}

		return [
			"view" => VIEW_DIR . "forum/listTopics.php",
			"data" => [
				"categories" => $categorie,
				"topics" => $topics,
				"posts" => $posts,
			]
		];
	}

	// public function topicSelectedByCategory($id)
	// {
	// 	$categoryManager = new CategoryManager();
	// 	$topic =$topicManager->findOnebyID($id);
	// 	$post = new PostManager();

	// 	if ($id) {

	// 		return [
	// 			"view" => VIEW_DIR . "forum/listTopics.php",
	// 			"data" => [
	// 				"categorie" => $categoryManager->findOneById($id),
	// 				"topics" => $topicManager->listTopicSelected($id),
	// 				"posts" => $postManager->listTopicSelected($id),


	// 			]
	// 		];
	// 	} else {

	// 		return [
	// 			"view" => VIEW_DIR . "forum/listTopics.php",
	// 			"data" => [
	// 				"categorie" => $categoryManager->findAll(["categoryName", "DESC"]),
	// 				"topics" => $topicManager->findAll(["topicName", "DESC"]),
	// 				"posts" => $postManager->findAll(["postName", "DESC"]),
	// 			]
	// 		];
	// 	}
	// }

	public function postSelectedbyTopic($id)
	{
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
		} else {
			return [
				"view" => VIEW_DIR . "forum/listTopics.php",
				"data" => [
					"topics" => $topicManager->findAll(["topicName", "DESC"]),
					"posts" => $postManager->findAll(["content", "DESC"]),
					"error" => "Le topic n'existe pas",
				]

			];
		}
	}

	public function addNewCategory()
	{
		$CategoryManager = new CategoryManager();

		if (isset($_POST['submit'])) {

			$categoryName = filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$user = 1;

			if ($categoryName && $user) {

				$newCategory = $CategoryManager->add(["categoryName" => $categoryName, "user_id" => $user]);
				$this->redirectTo('category', $newCategory);
			}
		}
	}

	public function addNewTopic($id)
	{
		$TopicManager = new TopicManager();

		if (isset($_POST['submit'])) {

			$topicName = filter_input(INPUT_POST, "topicName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$user = 1;

			if ($topicName && $user) {

				$newTopic = $TopicManager->add(["topicName" => $topicName, "category_id" => $id, "user_id" => $user]);
				$this->redirectTo('topic', $newTopic);
			}
		}
	}

	public function addNewPost($id)
	{
		$TopicManager = new TopicManager();
		$PostManager = new PostManager();

		if (isset($_POST['submit'])) {

			$content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$user = 1;

			if ($content && $user) {

				$newPost = $PostManager->add(["content" => $content, "topic_id" => $id, "user_id" => $user]);
				$this->redirectTo('post', $newPost);
			}
		}
	}

	public function deleteTopic($id)
	{
		$TopicManager = new TopicManager();
		$PostManager = new PostManager();


		$listPost = $PostManager->listPostSelected($id);

		// foreach qui supprime tous les posts enfants
		if (isset($listPost) && !empty($listPost)) {

			foreach ($listPost as $post) {
				$PostManager->delete($post->getId());
			}
			$TopicManager->delete($id);
			$this->redirectTo('forum', "listCategories");
		}
	}

	public function deletePost($id)
	{
		$PostManager = new PostManager();
		$post = $PostManager->findOneById($id);

		$PostManager->delete($id);
		//Poru redirectTo 1er argument= le controller, 2eme=la méthode,3eme=l'id (le 3eme est facultatif)  //     
		$this->redirectTo("forum", "postSelected", $post->getTopic()->getId());
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

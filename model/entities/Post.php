<?php
    namespace Model\Entities;

    use App\Entity;

    final class Post extends Entity{

        private $id;
        private $postDate;
        private $content;
        private $topic;
        private $user;

        public function __construct($data){         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        
        public function getPostdate(){
                $formattedDate = $this->postDate->format("d/m/Y, H:i:s");
                return $postDate;
        }
        
        public function setPostdate($postdate){
                $this->postDate = new \DateTime($date);
                return $this;
        }
        
        /**
         * Get the value of content
         */ 
        public function getContent()
        {
                return $this->content;
        }
        
        /**
         * Set the value of content
         *
         * @return  self
         */ 
        public function setContent($content)
        {
                $this->content = $content;
                
                return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getTopic()
        {
                return $this->topic;
        }
        
        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setTopic($topic)
        {
                $this->topic = $topic;
        
                return $this;
        }

        /**
        *Get the value of category 
        */
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of category
         */
        public function setUser($user)
        {
                $this->user = $user;
        
                return $this;
        }
}

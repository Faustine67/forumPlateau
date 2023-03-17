<?php
    namespace Model\Entities;

    use App\Entity;

    final class Topic extends Entity{

        private $topic;
        private $topicName;
        private $topicDate;
        private $locked;
        private $user;
        private $category;


        public function __construct($data){         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->topic;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($topic)
        {
                $this->topic = $topic;

                return $this;
        }

        /**
         * Get the value of Topic Name
         */ 
        public function getTopicName()
        {
                return $this->topicName;
        }

        /**
         * Set the value of Topic Name
         *
         * @return  self
         */ 
        public function setTopicName($topicName)
        {
                $this->topicName = $topicName;

                return $this;
        }

        
        public function getTopicDate(){
                $formattedDate = $this->topicDate->format("d/m/Y, H:i:s");
                return $formattedDate;
        }
        
        public function setTopicDate($topicDate){
                $this->topicDate = new \DateTime($topicDate);
                return $this;
        }
        
        /**
         * Get the value of Locked
         */ 
        public function getLocked()
        {
                return $this->locked;
        }
        
        /**
         * Set the value of Locked
         *
         * @return  self
         */ 
        public function setLocked($locked)
        {
                $this->locked = $locked;
                
                return $this;
        }

        /**
         * Get the value of user_id
         */ 
        public function getUser()
        {
                return $this->user;
        }
        
        /**
         * Set the value of user_id
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;
        
                return $this;
        }

        /**
        *Get the value of category 
        */
        public function getCategory()
        {
                return $this->category;
        }

        /**
         * Set the value of category
         */
        public function setCategory($category)
        {
                $this->category = $category;
        
                return $this;
        }

}

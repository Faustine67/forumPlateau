<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $nickname;
        private $email;
        private $password;
        private $inscriptionDate;


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

        /**
         * Get the value of nickname
         */ 
        public function getNickname()
        {
                return $this->nickname;
        }

        /**
         * Set the value of Nickname
         *
         * @return  self
         */ 
        public function setNickname($nickname)
        {
                $this->nickname = $nickname;

                return $this;
        }

        
        
        /**
         * Get the value of EMail
         */ 
        public function getEmail()
        {
            return $this->email;
        }
        
        /**
         * Set the value of Email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
            $this->email = $email;
            
            return $this;
        }
        
        /**
         * Get the value of Password
         */ 
        public function getPassword()
        {
            return $this->password;
        }
        
        /**
         * Set the value of Password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
            $this->password = $password;
            
            return $this;
        }
        
         /**
         * Get the value of Inscription Date
         */ 
        public function getInscriptionDate(){
                $formattedDate = $this->inscriptionDate->format("d/m/Y, H:i:s");
                return $inscriptionDate;
        }
         /**
         * Set the value of Inscription Date
         */ 
        
        public function setInscriptiondate($inscriptionDate){
                $this->inscriptionDate = new \DateTime($inscriptionDate);
                return $this;
        }

        public function getBan()
        {
                return $this->$ban;
        }
        public function setBan($ban):self
        {
                $this->ban =$ban;
                return $this;
        }

        public function getRole()
        {
                return $this->$role;
        }
        public function setRole($role):self
        {
                $this->role =$role;
                return $this;
        }
}
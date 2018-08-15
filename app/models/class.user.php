<?php
    class User{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //Register user
        public function register($data){
            $this->db->query("INSERT INTO users (user_name, user_surname, user_password, user_email, user_mobile_number, user_role) VALUES(:name, :surname, :password, :email, :mobile_number, :role)");
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':surname', $data['surname']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':mobile_number', $data['mobile_number']);
            $this->db->bind(':role', $data['role']);

            //execute
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //Find user by email
        public function find_user_by_email($email){
            $this->db->query('SELECT * FROM users WHERE user_email = :email');
            $this->db->bind(':email', $email);
            $row = $this->db->single();

            if($this->db->row_count() > 0){
                return true;
            }
            else{
                return false;
            }
        }

        //Get randSalt
        public function get_randSalt(){
            $this->db->query('SELECT randSalt FROM users');
            return $this->db->single();
        }

        //Get next id
        public function get_next_id(){
            $this->db->query('SHOW TABLE STATUS LIKE "users"');
            return $this->db->single();
        }
    }
?>
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

        //Login user
        public function login($data){
            $this->db->query('SELECT * FROM users WHERE user_email = :email');
            $this->db->bind(':email', $data['email']);

            $row = $this->db->single();
            $password = crypt($data['password'], $row->user_password);
            if($password === $row->user_password){
                return $row;
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
            $this->db->query('SELECT randSalt FROM randSalt');
            return $this->db->single();
        }

        //Get next id
        public function get_next_id(){
            $this->db->query('SHOW TABLE STATUS LIKE "users"');
            return $this->db->single();
        }

        //Set the user token for resetting password
        public function set_token($token, $email){
            $this->db->query('UPDATE users SET token= :token WHERE user_email= :email');
            $this->db->bind(':token', $token);
            $this->db->bind(':email', $email);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //Check that the user exists & that tokens match
        public function check_token($token, $email){
            $this->db->query('SELECT * FROM users WHERE token= :token AND user_email= :email');
            $this->db->bind(':token', $token);
            $this->db->bind(':email', $email);
            $row = $this->db->single();

            if($this->db->row_count() > 0){
                return true;
            }
            else{
                return false;
            }
        }
        
        //Update the user's password
        public function update_password($password, $email){
            $this->db->query('UPDATE users SET user_password= :password WHERE user_email= :email');
            $this->db->bind(':password', $password);
            $this->db->bind(':email', $email);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }
    }
?>
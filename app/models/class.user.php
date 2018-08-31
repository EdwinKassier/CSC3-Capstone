<?php
    class User{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //Register user
        public function register($data){
            $this->db->query("INSERT INTO users (user_name, user_surname, user_password, user_email, user_mobile_number, user_role, user_organization_name, user_organization_number) VALUES(:name, :surname, :password, :email, :mobile_number, :role, :organization_name, :organization_number)");
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':surname', $data['surname']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':mobile_number', $data['mobile_number']);
            $this->db->bind(':role', $data['role']);
            $this->db->bind(':organization_name', $data['organization_name']);
            $this->db->bind(':organization_number', $data['organization_number']);

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

        //Edit user
        public function edit_user($data){
            $this->db->query("UPDATE users SET user_name = :name, user_surname = :surname, user_mobile_number = :mobile_number, user_email = :email WHERE user_id = :id");
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':surname', $data['surname']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':mobile_number', $data['mobile_number']);
            $this->db->bind(':id', $_SESSION['user_id']);

            //execute
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //Get a users data
        public function get_user_data(){
            $this->db->query('SELECT * FROM users WHERE user_id = :id');
            $this->db->bind(':id', $_SESSION['user_id']);

            if($row = $this->db->single()){
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
            $this->db->single();

            if($this->db->row_count() > 0){
                return true;
            }
            else{
                return false;
            }
        }

        //Check if the new email is the same as the old email.
        public function check_new_email_vs_old_email($email){
            $this->db->query('SELECT * FROM users WHERE user_id = :id');
            $this->db->bind(':id', $_SESSION['user_id']);
            $row = $this->db->single();

            if($row->user_email === $email){
                return 'true';
            }
            else{
                return $row->user_email;
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

        //Set the user token for resetting password and verifying email
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

        //remove the user token
        public function remove_token($email){
            $this->db->query('UPDATE users SET token= "" WHERE user_email= :email');
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

        //Update the user's verified status
        public function email_verified($email){
            $this->db->query('UPDATE users SET verified= "1" WHERE user_email= :email');
            $this->db->bind(':email', $email);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //Update the user's verified status
        public function email_unverified($email){
            $this->db->query('UPDATE users SET verified= "0" WHERE user_email= :email');
            $this->db->bind(':email', $email);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //check email verified
        public function check_verified($email){
            $this->db->query('SELECT * FROM users WHERE verified= "1" AND user_email= :email');
            $this->db->bind(':email', $email);
            $row = $this->db->single();

            if($this->db->row_count() > 0){
                return true;
            }
            else{
                return false;
            }
        }

        //check user approved
        public function check_approved($email){
            $this->db->query('SELECT * FROM users WHERE approved= "1" AND user_email= :email');
            $this->db->bind(':email', $email);
            $row = $this->db->single();

            if($this->db->row_count() > 0){
                return true;
            }
            else{
                return false;
            }
        }

        //add a pin to the database
        public function add_pin($role, $latitude, $longitude, $name){
            $this->db->query('INSERT INTO pins (user_id, latitude, longitude, role, name) VALUES(:id,:latitude,:longitude,:role, :name)');
            $this->db->bind(':id', $_SESSION['user_id']);
            $this->db->bind(':latitude', $latitude);
            $this->db->bind(':longitude', $longitude);
            $this->db->bind(':role', $role);
            $this->db->bind(':name', $name);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //get all pins of a user
        public function get_pins($role){
            $this->db->query('SELECT * FROM pins WHERE role= :role AND user_id= :id');
            $this->db->bind(':id', $_SESSION['user_id']);
            $this->db->bind(':role', $role);

            if($row = $this->db->result_set()){
                return $row;
            }
            else{
                return false;
            }
        }
    }
?>
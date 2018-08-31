<?php
    class Admin{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        // //Register admin
        // public function register($data){
        //     $this->db->query("INSERT INTO admins (admin_name, admin_surname, admin_password, admin_email, admin_mobile_number, admin_username) VALUES(:name, :surname, :password, :email, :mobile_number, :username)");
        //     $this->db->bind(':name', $data['name']);
        //     $this->db->bind(':surname', $data['surname']);
        //     $this->db->bind(':password', $data['password']);
        //     $this->db->bind(':email', $data['email']);
        //     $this->db->bind(':mobile_number', $data['mobile_number']);
        //     $this->db->bind(':username', $data['username']);

        //     //execute
        //     if($this->db->execute()){
        //         return true;
        //     }
        //     else{
        //         return false;
        //     }
        // }

        //Login admin
        public function login($data){
            $this->db->query('SELECT * FROM admins WHERE admin_username = :email');
            $this->db->bind(':email', $data['email']);

            $row = $this->db->single();
            $password = crypt($data['password'], $row->admin_password);
            if($password === $row->admin_password){
                return $row;
            }
            else{
                return false;
            }
        }

        //Find admin by email
        public function find_admin_by_email($email){
            $this->db->query('SELECT * FROM admins WHERE admin_username = :email');
            $this->db->bind(':email', $email);
            $this->db->single(); 

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

        //Return pending users
        public function get_pending_users(){
            $this->db->query('SELECT * FROM users WHERE approved = :number');
            $this->db->bind(':number', '0');

            if($row = $this->db->result_set()){
                return $row;
            }
            else{
                return false;
            }
        }

        //Return all admins
        public function get_all_admins(){
            $this->db->query('SELECT * FROM admins');

            if($row = $this->db->result_set()){
                return $row;
            }
            else{
                return false;
            }
        }
        
        //Return all users
        public function get_all_users(){
            $this->db->query('SELECT * FROM users WHERE removed = :number');
            $this->db->bind(':number', '0');

            if($row = $this->db->result_set()){
                return $row;
            }
            else{
                return false;
            }
        }

        //Return amount of pending users
        public function amount_pending_users(){
            $this->db->query('SELECT * FROM users WHERE approved = :number AND removed = :number');
            $this->db->bind(':number', '0');
            $this->db->single();

            if($this->db->row_count() > 0){
                return $this->db->row_count();
            }
            else{
                return "0";
            }
        }

        //Return amount of nests
        public function amount_nests(){
            $this->db->query('SELECT * FROM pins WHERE role = :number');
            $this->db->bind(':number', '0');
            $this->db->single();

            if($this->db->row_count() > 0){
                return $this->db->row_count();
            }
            else{
                return "0";
            }
        }

        //Return amount of ornothologists
        public function amount_ornothologists(){
            $this->db->query('SELECT * FROM users WHERE user_role = :number AND removed != :number');
            $this->db->bind(':number', '1');
            $this->db->single();

            if($this->db->row_count() > 0){
                return $this->db->row_count();
            }
            else{
                return "0";
            }
        }

        //Return amount of wind farms
        public function amount_wind_farms(){
            $this->db->query('SELECT * FROM users WHERE user_role = :number AND removed = :number');
            $this->db->bind(':number', '0');
            $this->db->single();

            if($this->db->row_count() > 0){
                return $this->db->row_count();
            }
            else{
                return "0";
            }
        }

        //Return amount of admins
        public function amount_admins(){
            $this->db->query('SELECT * FROM admins');
            $this->db->single();

            if($this->db->row_count() > 0){
                return $this->db->row_count();
            }
            else{
                return "0";
            }
        }

        //validates a user
        public function validate_user($user){
            $this->db->query("UPDATE users SET approved = :approved WHERE user_id = :id");
            $this->db->bind(':approved', '1');
            $this->db->bind(':id', $user);

            //execute
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //rejects a user
        public function reject_user($user){
            $this->db->query("DELETE FROM users WHERE user_id = :id");
            $this->db->bind(':id', $user);

            //execute
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //removes a user
        public function remove_user($user){
            $this->db->query("UPDATE users SET removed = :removed WHERE user_id = :id");
            $this->db->bind(':removed', '1');
            $this->db->bind(':id', $user);

            //execute
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }
    }
?>
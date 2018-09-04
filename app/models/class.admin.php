<?php
    class Admin{
        private $db;
        
        //Creates a new Database object
        public function __construct(){
            $this->db = new Database;
        }

        //Register admin
        public function register($data){
            $this->db->query("INSERT INTO admins (admin_name, admin_surname, admin_password, admin_email, admin_mobile_number, admin_username) VALUES(:name, :surname, :password, :email, :mobile_number, :username)");
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':surname', $data['surname']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':mobile_number', $data['mobile_number']);
            $this->db->bind(':username', $data['username']);

            //execute
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }
        
        //Edit admin
        public function edit_admin($data){
            $this->db->query("UPDATE admins SET admin_name = :name, admin_surname = :surname, admin_mobile_number = :mobile_number, admin_email = :email, admin_username = :username WHERE admin_id = :id");
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':surname', $data['surname']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':mobile_number', $data['mobile_number']);
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':username', $data['username']);

            //execute
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //Update the admin's password
        public function update_password($password, $username){
            $this->db->query('UPDATE admins SET admin_password= :password WHERE admin_username= :username');
            $this->db->bind(':password', $password);
            $this->db->bind(':username', $username);

            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //Get a admin data
        public function get_admin_data($admin_id){
            $this->db->query('SELECT * FROM admins WHERE admin_id = :id');
            $this->db->bind(':id', $admin_id);

            if($row = $this->db->single()){
                return $row;
            }
            else{
                return false;
            }
        }

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

        //Find admin by username
        public function find_admin_by_username($username){
            $this->db->query('SELECT * FROM admins WHERE admin_username = :username');
            $this->db->bind(':username', $username);
            $this->db->single(); 

            if($this->db->row_count() > 0){
                return true;
            }
            else{
                return false;
            }
        }

        //Check if the new username is the same as the old username.
        public function check_new_username_vs_old_username($username, $admin_id){
            $this->db->query('SELECT * FROM admins WHERE admin_id = :id');
            $this->db->bind(':id', $admin_id);
            $row = $this->db->single();

            if($row->admin_username === $username){
                return 'true';
            }
            else{
                return $row->admin_username;
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

        //removes a admin
        public function remove_admin($admin){
            $this->db->query("DELETE FROM admins WHERE admin_id = :id");
            $this->db->bind(':id', $admin);

            //execute
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
        }

        //get all nests of a user
        public function get_nests(){
            $this->db->query('SELECT * FROM pins WHERE role= :role');
            $this->db->bind(':role', '0');

            if($row = $this->db->result_set()){
                return $row;
            }
            else{
                return false;
            }
        }
    }
?>
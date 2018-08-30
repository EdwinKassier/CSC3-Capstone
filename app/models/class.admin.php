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
    }
?>
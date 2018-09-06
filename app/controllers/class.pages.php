<!--This is the pages controller class, it inherits from the main controller class-->
<?php
    class Pages extends Controller{
        //Loads the about view
        public function about(){
            $this->view('pages/about');
        }

        //Loads the contact view
        public function contact(){
            $this->view('pages/contact');
        }

        //Loads the FAQ view
        public function FAQ(){
            $this->view('pages/FAQ');
        }
    }
?>
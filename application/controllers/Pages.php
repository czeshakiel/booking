<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit','2048M');
date_default_timezone_set('Asia/Manila');
    class Pages extends CI_Controller{

        //===============================User Module=========================================
        public function index(){
            $page = "index";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                                                 
            $this->load->view('pages/'.$page);                 
        }  
        public function signup(){
            $page = "signup";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            }                                                 
            $this->load->view('pages/'.$page);                 
        }
        public function registration(){            
            $result = $this->Booking_model->register();
            if($result){
                $this->session->set_flashdata('success', 'Registration successful. Please login.');
                redirect(base_url());
            }else{
                $this->session->set_flashdata('error', 'Registration failed. Please try again.');
                redirect(base_url('signup'));
            }
        }
        public function user_authenticate(){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->Booking_model->user_authentication($username,$password);
            if($user){
                // Set session data
                $userdata=array(                    
                    'username' => $user['username'],
                    'fullname' => $user['fullname'],
                    'user_login' => TRUE
                );
                $this->session->set_userdata($userdata);
                redirect(base_url('main'));
            }else{
                $this->session->set_flashdata('error', 'Invalid username or password.');
                redirect(base_url());
            }
        }
        public function main(){
            $page = "main";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            } 
            if(!$this->session->user_login){
                redirect(base_url());
            }
            if($this->input->post('month')=="" && $this->input->post('year')==""){
                $data['month'] = date('m');
                $data['year'] = date('Y');
            }else{
                $data['month'] = $this->input->post('month');
                $data['year'] = $this->input->post('year');
            }
            $this->load->view('includes/header');            
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);                 
            $this->load->view('includes/modal');
            $this->load->view('includes/footer'); 
        }
        public function logout(){
            $this->session->sess_destroy();
            redirect(base_url());
        }
        //===============================User Module=========================================
}
?>

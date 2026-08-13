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
        public function view_available($date){
            $page = "view_available";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            } 
            if(!$this->session->user_login){
                redirect(base_url());
            }
            $data['datearray'] = $date;
            $data['courts'] = $this->Booking_model->getAllCourts();
            $data['booking_times'] = array();      
            $data['timesettings'] = $this->Booking_model->getAllBookingTime();   
            $data['search'] = 0;
            $this->load->view('includes/header');            
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);                 
            $this->load->view('includes/modal');
            $this->load->view('includes/footer'); 
        }
        public function search_view_available(){
            $page = "view_available";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            } 
            if(!$this->session->user_login){
                redirect(base_url());
            }
            $date=$this->input->post('datearray');
            $data['datearray'] = $date;
            $data['courts'] = $this->Booking_model->getAllCourts();
            $data['booking_times'] = $this->Booking_model->getBookingTimesByCourt($this->input->post('court_id'),$date);          
            $data['timesettings'] = $this->Booking_model->getAllBookingTime();
            $data['search'] = 1;
            $data['selected_court'] = $this->Booking_model->get_court($this->input->post('court_id'));
            $this->load->view('includes/header');            
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);                 
            $this->load->view('includes/modal');
            $this->load->view('includes/footer'); 
        }
        public function save_booking(){
            $result = $this->Booking_model->save_booking();
            if($result){
                echo "<script>alert('Booking saved successfully.'); window.location.href='".base_url('my_bookings')."';</script>";
            } else {
                $this->session->set_flashdata('error', 'Failed to save booking.');
                redirect(base_url('view_available/'.$this->input->post('datearray')));
            }            
        }
        public function my_bookings(){
            $page = "my_bookings";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            } 
            if(!$this->session->user_login){
                redirect(base_url());
            }
            $data['bookings'] = $this->Booking_model->getBookingsByUser($this->session->username);
            $this->load->view('includes/header');            
            $this->load->view('includes/navbar');
            $this->load->view('includes/sidebar');
            $this->load->view('pages/'.$page,$data);                 
            $this->load->view('includes/modal');
            $this->load->view('includes/footer'); 
        }
        public function upload_payment(){
            $result = $this->Booking_model->upload_payment();
            if($result){
                $this->session->set_flashdata('success', 'Payment proof uploaded successfully.');                
            } else {
                $this->session->set_flashdata('error', 'Failed to upload payment proof.');                
            }            
            redirect(base_url('my_bookings'));
        }
        public function view_payment($booking_id){
            $page = "view_payment";
            if(!file_exists(APPPATH.'views/pages/'.$page.".php")){
                show_404();
            } 
            // if(!$this->session->user_login){
            //     redirect(base_url());
            // }
            $data['document'] = $this->Booking_model->getBookingById($booking_id);            
            $this->load->view('pages/'.$page,$data);                             
        }
        public function cancel_bookings($booking_id,$id){
            $result = $this->Booking_model->cancel_booking($booking_id);
            if($result){
                $this->session->set_flashdata('success', 'Booking cancelled successfully.');                
            } else {
                $this->session->set_flashdata('error', 'Failed to cancel booking.');                
            }
            if($this->session->user_login){
               redirect(base_url('my_bookings'));
            }                   

            if($this->session->admin_login){
                redirect(base_url('manage_bookings/'.$id));
            }
        }
        public function confirm_booking($booking_id,$id){
            $result = $this->Booking_model->confirm_booking($booking_id);
            if($result){
                $this->session->set_flashdata('success', 'Booking confirmed successfully.');                
            } else {
                $this->session->set_flashdata('error', 'Failed to confirm booking.');                
            }
            redirect(base_url('manage_bookings/'.$id));            
        }
        //===============================User Module=========================================
        //===============================Admin Module=========================================
        public function admin(){
            $page = "index";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            }                                                 
            $this->load->view('pages/admin/'.$page);                 
        }  
        public function admin_authenticate(){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->Booking_model->admin_authentication($username,$password);
            if($user){
                // Set session data
                $userdata=array(                    
                    'username' => $user['username'],
                    'fullname' => $user['fullname'],
                    'admin_login' => TRUE
                );
                $this->session->set_userdata($userdata);
                redirect(base_url('adminmain'));
            }else{
                $this->session->set_flashdata('error', 'Invalid username or password.');
                redirect(base_url('admin'));
            }
        }
        public function adminmain(){
            $page = "main";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            } 
            if(!$this->session->admin_login){
                redirect(base_url('admin'));
            }
            $data['totalbooking'] = $this->Booking_model->getAllBookings();
            $data['confirmedbooking'] = $this->Booking_model->getBookingStatus('confirmed');
            $data['pendingbooking'] = $this->Booking_model->getBookingStatus('pending');
            $data['cancelledbooking'] = $this->Booking_model->getBookingStatus('cancelled');
            $data['todaysbooking'] = $this->Booking_model->getTodaysBookings(date('Y-m-d'));
            if($this->input->post('month')=="" && $this->input->post('year')==""){
                $data['month'] = date('m');
                $data['year'] = date('Y');
            }else{
                $data['month'] = $this->input->post('month');
                $data['year'] = $this->input->post('year');
            }
            $this->load->view('includes/header');            
            $this->load->view('includes/admin/navbar');
            $this->load->view('includes/admin/sidebar');
            $this->load->view('pages/admin/'.$page,$data);                 
            $this->load->view('includes/admin/modal');
            $this->load->view('includes/footer'); 
        }
        public function manage_settings(){
            $page = "manage_settings";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            } 
            if(!$this->session->admin_login){
                redirect(base_url('admin'));
            }            
            $this->load->view('includes/header');            
            $this->load->view('includes/admin/navbar');
            $this->load->view('includes/admin/sidebar');
            $this->load->view('pages/admin/'.$page);                 
            $this->load->view('includes/admin/modal');
            $this->load->view('includes/footer'); 
        }
        public function adminlogout(){
            $this->session->sess_destroy();
            redirect(base_url('admin'));
        }
        public function manage_court(){
            $page = "manage_court";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            } 
            if(!$this->session->admin_login){
                redirect(base_url('admin'));
            }            
            $data['courts'] = $this->Booking_model->getAllCourts();
            $this->load->view('includes/header');            
            $this->load->view('includes/admin/navbar');
            $this->load->view('includes/admin/sidebar');
            $this->load->view('pages/admin/'.$page,$data);                 
            $this->load->view('includes/admin/modal');
            $this->load->view('includes/footer'); 
        }
        public function get_court($id){
            $court = $this->Booking_model->get_court($id);
            echo json_encode($court);
        }            
        public function save_court(){
            $result = $this->Booking_model->save_court();
            if($result){
                $this->session->set_flashdata('success', 'Court saved successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to save court.');
            }
            redirect(base_url('manage_court'));
        }
        public function delete_court($id){
            $result = $this->Booking_model->delete_court($id);
            if($result){
                $this->session->set_flashdata('success', 'Court deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete court.');
            }
            redirect(base_url('manage_court'));
        }
        public function get_booking_time($id){
            $bookingTime = $this->Booking_model->get_booking_time($id);
            echo json_encode($bookingTime);
        }
        public function save_booking_time(){
            $result = $this->Booking_model->save_booking_time();
            if($result){
                $this->session->set_flashdata('success', 'Booking time saved successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to save booking time.');
            }
            redirect(base_url('manage_time'));
        }
        public function delete_booking_time($id){
            $result = $this->Booking_model->delete_booking_time($id);
            if($result){
                $this->session->set_flashdata('success', 'Booking time deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete booking time.');
            }
            redirect(base_url('manage_time'));
        }
        public function manage_time(){
            $page = "manage_time";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            } 
            if(!$this->session->admin_login){
                redirect(base_url('admin'));
            }            
            $data['courts'] = $this->Booking_model->getAllBookingTime();
            $this->load->view('includes/header');            
            $this->load->view('includes/admin/navbar');
            $this->load->view('includes/admin/sidebar');
            $this->load->view('pages/admin/'.$page,$data);                 
            $this->load->view('includes/admin/modal');
            $this->load->view('includes/footer'); 
        }
        public function manage_bookings($id){
            $page = "manage_bookings";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            } 
            if(!$this->session->admin_login){
                redirect(base_url('admin'));
            }            
            if($id=="all"){
                $data['bookings'] = $this->Booking_model->getAllBookings();
            }else{
                $data['bookings'] = $this->Booking_model->getAllBookingByDate($id);
            }
            $data['id'] = $id;
            $this->load->view('includes/header');            
            $this->load->view('includes/admin/navbar');
            $this->load->view('includes/admin/sidebar');
            $this->load->view('pages/admin/'.$page,$data);                 
            $this->load->view('includes/admin/modal');
            $this->load->view('includes/footer'); 
        }
        public function booking_map(){
            $page = "booking_map";
            if(!file_exists(APPPATH.'views/pages/admin/'.$page.".php")){
                show_404();
            } 
            if(!$this->session->admin_login){
                redirect(base_url('admin'));
            }            
            if($this->input->post('datearray')==""){
                $data['datearray'] = date('Y-m-d');
            }else{
                $data['datearray'] = $this->input->post('datearray');                
            }
            $this->load->view('includes/header');            
            $this->load->view('includes/admin/navbar');
            $this->load->view('includes/admin/sidebar');
            $this->load->view('pages/admin/'.$page,$data);                 
            $this->load->view('includes/admin/modal');
            $this->load->view('includes/footer'); 
        }
        //===============================Admin Module=========================================
}
?>

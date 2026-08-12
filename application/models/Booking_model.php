<?php
    date_default_timezone_set('Asia/Manila');
    class Booking_model extends CI_model{
        public function __construct(){
            $this->load->database();
        }
        public function register(){
            $username = $this->input->post('username');

            $data = array(
                'fullname' => $this->input->post('fullname'),
                'username' => $this->input->post('username'),
                'contactno' => $this->input->post('contactno'),
                'password' => base64_encode($this->input->post('password'))
            );
            $check=$this->db->where('username',$username)->get('users')->num_rows();
            if($check > 0){
                $this->session->set_flashdata('error', 'Username already exists. Please choose a different username.');
                redirect(base_url('signup'));
            }
            $result=$this->db->insert('users', $data);
            if($result){
                return true;
            }else{
                return false;
            }  
        }
        public function user_authentication($username,$password){
            $this->db->where('username',$username);
            $this->db->where('password',base64_encode($password));
            $query=$this->db->get('users');
            if($query->num_rows() > 0){
                return $query->row_array();
            }else{
                return false;
            }
        }
        public function admin_authentication($username,$password){
            $this->db->where('username',$username);
            $this->db->where('password',$password);
            $query=$this->db->get('admin');
            if($query->num_rows() > 0){
                return $query->row_array();
            }else{
                return false;
            }
        }
        public function getBookingStatus($status){
            $this->db->where('status',$status);
            $query=$this->db->get('booking');
            return $query->result_array();
        }
        public function getAllBookings(){            
            $query=$this->db->query("SELECT b.*,c.courtname FROM booking b INNER JOIN court c ON c.id=b.court_id ORDER BY b.datearray ASC");
            return $query->result_array();
        }
        public function getTodaysBookings($date){
            $this->db->where('book_date',$date);
            $query=$this->db->get('booking');
            return $query->result_array();
        }
        public function getAllCourts(){
            $query=$this->db->get('court');
            return $query->result_array();
        }
        public function get_court($id){
            $this->db->where('id',$id);
            $query=$this->db->get('court');
            return $query->row_array();
        }
        public function save_court(){
            $id=$this->input->post('id');
            $data = array(
                'courtname' => $this->input->post('courtname'),
                'court_rate_am' => $this->input->post('court_rate_am'),
                'court_rate_pm' => $this->input->post('court_rate_pm')                
            );
            if($id <> ""){
                $this->db->where('id', $id);
                $result=$this->db->update('court', $data);
            }else{
                $result=$this->db->insert('court', $data);
            }
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function delete_court($id){
            $this->db->where('id', $id);
            $result=$this->db->delete('court');
            if($result){
                return true;
            }else{
                return false;
            }
        }        
        public function get_booking_time($id){
            $this->db->where('id',$id);
            $query=$this->db->get('timesettings');
            return $query->row_array();
        }
        public function getAllBookingTime(){
            $this->db->order_by('time_id', 'ASC');
            $query=$this->db->get('timesettings');
            return $query->result_array();
        }
        public function save_booking_time(){
            $id=$this->input->post('id');
            $data = array(
                'time_id' => $this->input->post('time_id'),
                'time_description' => $this->input->post('time_description'),
                'time_shift' => $this->input->post('time_shift')                
            );
            if($id <> ""){
                $this->db->where('id', $id);
                $result=$this->db->update('timesettings', $data);
            }else{
                $result=$this->db->insert('timesettings', $data);
            }
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function delete_booking_time($id){
            $this->db->where('id', $id);
            $result=$this->db->delete('timesettings');
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function getBookingTimesByCourt($court_id,$date){
            $this->db->where('court_id',$court_id);
            $this->db->where('book_date',$date);
            $query=$this->db->get('booking');
            return $query->result_array();
        }
        public function save_booking(){
            $username=$this->session->username;
            $query=$this->db->where('username',$username)->get('users');
            $user=$query->row_array();
            $court_id = $this->input->post('court_id');
            $datearray = $this->input->post('datearray');
            $selected_times = $this->input->post('time_check');
            //$selected_times = sort($this->input->post('time_check'));
            $date=date('Y-m-d');
            $time=date('H:i:s');
            if(!empty($selected_times)){
                $book_time="";
                foreach($selected_times as $time_id){
                    $book_time .= $time_id . ";";
                }
                $book_id=date('YmdHis').rand(1000,9999);
                $data = array(
                        'booking_id' => $book_id,
                        'username' => $user['username'],
                        'fullname' => $user['fullname'],
                        'contactno' => $user['contactno'],
                        'court_id' => $court_id,
                        'book_date' => $datearray,
                        'book_time' => $book_time,
                        'datearray' => $date,
                        'timearray' => $time,
                        'status' => 'pending'
                    );
                    $this->db->insert('booking', $data);
                return true;
            }else{
                return false;
            }
        }
        public function getBookingsByUser($username){            
            $query=$this->db->query('SELECT b.*, c.courtname FROM booking b LEFT JOIN court c ON b.court_id = c.id WHERE b.username = "'.$username.'" ORDER BY b.book_date DESC, b.timearray DESC');
            return $query->result_array();
        }
        public function upload_payment(){
            $booking_id = $this->input->post('booking_id');
            $fileName=basename($_FILES["file"]["name"]);
            $fileType=pathinfo($fileName, PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg','gif','pdf');
            if(in_array($fileType,$allowTypes)){
                $image = $_FILES["file"]["tmp_name"];
                $imgContent=addslashes(file_get_contents($image));                
                $result=$this->db->query("UPDATE booking SET payment='$imgContent' WHERE booking_id='$booking_id'");
                
            }
            
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function getBookingById($booking_id){
            $this->db->where('booking_id',$booking_id);
            $query=$this->db->get('booking');
            return $query->row_array();
        }
        public function cancel_booking($booking_id){
            $this->db->where('booking_id', $booking_id);
            $result=$this->db->update('booking', array('status' => 'cancelled'));
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function confirm_booking($booking_id){
            $this->db->where('booking_id', $booking_id);
            $result=$this->db->update('booking', array('status' => 'confirmed'));
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function getAllBookingsByDate($date,$court_id){
            $result=$this->db->query("SELECT * FROM booking WHERE book_date='$date' AND court_id='$court_id' AND `status`='confirmed'");
            return $result->result_array();
        }
    }
?>

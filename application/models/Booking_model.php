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
            $query=$this->db->get('booking');
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
    }
?>

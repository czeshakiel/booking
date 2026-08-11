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
    }
?>

<?php
class Cron extends CI_Controller{
 
public function __construct() {
parent::__construct();
}

function index(){
redirect(404);
}

function reminder_orderan(){
$input = $this->input->post();
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset']  = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;

$this->load->library('email',$config);
$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$this->email->from('admin@guepedia.com');
$this->email->to("dedyibrahym23@gmail.com");
$this->email->subject('Tes cronjob');
$data_kirim ="<h3>CRONJOB BERHASIL </h3><br>";
$this->email->message($data_kirim);

if (!$this->email->send()){    
echo $this->email->print_debugger();
}else{
echo "Reminder Email orderan berhasil";    
}    
}

}


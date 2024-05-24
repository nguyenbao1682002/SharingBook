<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Contact_model');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->helper('url');
    }

    public function index() {
        $data['title'] = 'Liên Hệ';
        $data['config'] = $this->Contact_model->get_config();

        // Load the contact view
        $this->load->view('web/contact', $data);
    }

    public function send() {
        if ($this->input->post()) {
            $name = $this->input->post('hoten');
            $email = $this->input->post('email');
            $phone = $this->input->post('sodienthoai');
            $subject = $this->input->post('tieude');
            $message = $this->input->post('noidung');

            $this->form_validation->set_rules('hoten', 'Họ tên', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('sodienthoai', 'Số điện thoại', 'required');
            $this->form_validation->set_rules('tieude', 'Tiêu đề', 'required');
            $this->form_validation->set_rules('noidung', 'Nội dung', 'required');

            if ($this->form_validation->run() == TRUE) {
                $contact_data = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'subject' => $subject,
                    'message' => $message
                );

                if ($this->Contact_model->insert_contact($contact_data)) {
                    // Send email
                    $this->send_email($name, $email, $phone, $subject, $message);
                    $data['success'] = 'Cảm ơn bạn đã liên hệ với chúng tôi!';
                } else {
                    $data['error'] = 'Đã có lỗi xảy ra, vui lòng thử lại sau!';
                }
            } else {
                $data['error'] = validation_errors();
            }
        }

        $data['title'] = 'Liên Hệ';
        $data['config'] = $this->Contact_model->get_config();

        // Reload the contact view with data
        $this->load->view('web/contact', $data);
    }

    private function send_email($name, $email, $phone, $subject, $message) {
        $this->email->from($email, $name);
        $this->email->to('your-email@example.com'); // Change this to your email address
        $this->email->subject('New Contact Form Submission: ' . $subject);

        $email_message = "
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Phone:</strong> {$phone}</p>
        <p><strong>Subject:</strong> {$subject}</p>
        <p><strong>Message:</strong><br>{$message}</p>
        ";

        $this->email->message($email_message);

        if ($this->email->send()) {
            return true;
        } else {
            log_message('error', $this->email->print_debugger());
            return false;
        }
    }
}
?>


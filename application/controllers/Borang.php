<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Borang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pemohon_model');
        $this->load->model('Data_model');
    }

    public function index() {
 
        $data['captchaImg'] = $this->generate_captcha();
        $this->load->view('v_borang', $data);
    }

    public function hantar() {
        // Check form submit or not
        if ($this->input->post()) {

            $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('ic_no', 'KP No/Passport', 'trim|required|min_length[8]|max_length[12]');
            $this->form_validation->set_rules('no_tel', 'No Telefon', 'trim|required|min_length[5]|max_length[12]');
            $this->form_validation->set_rules('emel', 'Emel', 'trim|required|valid_email');
            $this->form_validation->set_rules('comment', 'Keterangan', 'required|min_length[5]');

            if ($this->form_validation->run() == FALSE) {
                
                $this->session->set_flashdata('err', 'Form Validation Failure');
                //redirect('/borang/index', 'refresh');
                $this->index();
                
            } else {

                $captcha_insert = $this->input->post('captcha');
                $contain_sess_captcha = $this->session->userdata('valuecaptchaCode');

                if ($captcha_insert === $contain_sess_captcha) {

                    $data = [
                        'nama' => $this->input->post('nama'),
                        'kp' => $this->input->post('ic_no'),
                        'notel' => $this->input->post('no_tel'),
                        'emel' => $this->input->post('emel'),
                        'keterangan' => $this->input->post('comment'),
                        'jenis_permohonan' => $this->input->post('jenis_permohonan'),
                    ];

                    $pemohon_id = $this->Pemohon_model->permohonan_baru($data);

                    foreach ($this->input->post('jenis_data_chkbox') as $value) {

                        $this->Pemohon_model->jenis_data(array('id_pemohon' => $pemohon_id, 'jenis' => $value));
                        
                        //Get & Send Email to Officer
                        $pic[] = $this->get_pic_email($value);

                    }

                    //Create Upload Path
                    if (!is_dir('uploads/pemohon_' . $pemohon_id . '/')) {

                        mkdir('uploads/pemohon_' . $pemohon_id . '/', 0777, true);
                    }

                    $path = 'uploads/pemohon_' . $pemohon_id . '/';

                    // Count total files
                    $countfiles = count($_FILES['files']['name']);

                    // Looping all files
                    for ($i = 0; $i < $countfiles; $i++) {

                        if (!empty($_FILES['files']['name'][$i])) {

                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                            // Set preference
                            $config['upload_path'] = $path;
                            $config['allowed_types'] = 'jpg|jpeg|png';
                            $config['max_size'] = '5000'; // max_size in kb
                            //$config['file_name'] = $_FILES['files']['name'][$i];
                            //Load upload library
                            $this->load->library('upload', $config);

                            // File upload
                            if ($this->upload->do_upload('file')) {
                                // Get data about the file
                                $uploadData = $this->upload->data();
                                $filename = $uploadData['file_name'];

                                // Initialize array
                                $data['filenames'][] = $filename;

                                //Insert into db
                                $this->Pemohon_model->lampiran(array('id_pemohon' => $pemohon_id, 'filename' => $filename, 'path' => $path));
                            }
                        }
                    }
                    
                    $this->send_email($pic);

                    // print_r($this->input->post());
                } else {
                    $this->session->set_flashdata('err', 'Captcha Failure');
                    redirect('/borang/index', 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('err', 'Form Submission Failure');
            redirect('/borang/index', 'refresh');
        }

        

        $this->output->enable_profiler(true); //<--Debug
    }
    
    public function get_pic_email($jenis_data){ //string
        
        $data = $this->db->get_where('data_pic', array('jenis_data' => $jenis_data))->row();
        
        return $data;
    }
    
    public function send_email($emails){
        
        foreach($emails as $email){
            mail($email->emel, 'Requesting data', 'Requesting data ' . $email->jenis_data);
            
            echo 'Email has been send to ' . $email->emel;
        }
        
    }

    
    
    
    
    
    
    
    
    public function list_permohonan(){
        
        $data['pemohon'] = $this->Pemohon_model->get_all_permohonan();
        
        foreach ($data['pemohon'] as $key => $pemohon) {
            $data['pemohon'][$key]['lampiran'] = $this->Pemohon_model->get_lampiran_by_id($pemohon['id']);
            $data['pemohon'][$key]['jenis_data'] = $this->Pemohon_model->get_jenisdata_by_id($pemohon['id']);

        }
        
        $this->output->enable_profiler(true);
        $this->load->view('v_senarai', $data);
    }

    function generate_captcha() {
        $config = array(
            'img_url' => base_url() . 'image_for_captcha/',
            'img_path' => 'image_for_captcha/',
            // 'img_height' => 45,
            // 'word_length' => 5,
            // 'img_width' => '45',
            // 'font_size' => 10
            'word' => $this->rand_gen->generate(8, 'alpha-numeric'),
            // 'img_path'      => './captcha/',
            // 'img_url'       => 'http://example.com/captcha/',
            'font_path' => base_url() . 'assets/fonts/grunja.ttf',
            'img_width' => '150',
            'img_height' => 50,
            'expiration' => 7200,
            'word_length' => 8,
            'font_size' => 20,
            'img_id' => 'Imageid',
            'pool' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            // White background and border, black text and red grid
            'colors' => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );

        $captcha = create_captcha($config);
        $this->session->unset_userdata('valuecaptchaCode');
        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
        //$data['captchaImg'] = $captcha['image'];

        return $captcha['image'];
    }
    

    //REFRESH CAPTCHA
    public function refresh() {
        $config = array(
            'img_url' => base_url() . 'image_for_captcha/',
            'img_path' => 'image_for_captcha/',
            // 'img_height' => 45,
            // 'word_length' => 5,
            // 'img_width' => '45',
            // 'font_size' => 10
            'word' => $this->rand_gen->generate(8, 'alpha-numeric'),
            // 'img_path'      => './captcha/',
            // 'img_url'       => 'http://example.com/captcha/',
            'font_path' => base_url() . 'assets/fonts/grunja.ttf',
            'img_width' => '150',
            'img_height' => 50,
            'expiration' => 7200,
            'word_length' => 8,
            'font_size' => 20,
            'img_id' => 'Imageid',
            'pool' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            // White background and border, black text and red grid
            'colors' => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );
        $captcha = create_captcha($config);
        $this->session->unset_userdata('valuecaptchaCode');
        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
        echo $captcha['image'];
    }

    public function email(){
        //mail('hairi.nordin@gmail.com', 'Hi leokhoa', 'I like Mail Sender feature.');
        
        $this->email_pic("Data kualiti air");
    }

}

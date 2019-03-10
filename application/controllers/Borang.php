<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Headers:Content-Type, X-Requested-With, X-PINGOTHER, X-File-Name, Cache-Control');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS");

class Borang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
				//$this->load->helper(array('form', 'url', 'file'));
				$this->load->model('Pemohon_model');

    }

    public function index()
    {
        $this->load->view('v_borang');
    }

    public function hantar()
    {
				$data = [
					'nama' => $this->input->post('nama'),
					'kp' => $this->input->post('ic_no'),
					'notel' => $this->input->post('no_tel'),
					'emel' => $this->input->post('emel'),
					'keterangan' => $this->input->post('comment'),
					'jenis_permohonan' => $this->input->post('jenis_permohonan'),
				];

				$pemohon_id = $this->Pemohon_model->permohonan_baru($data);

				foreach($this->input->post('jenis_data_chkbox') as $value){

					$this->Pemohon_model->jenis_data(array('id_pemohon' => $pemohon_id, 'jenis' => $value));
				
				}

        // print_r($this->input->post());
        $this->output->enable_profiler(true); //<--Debug
    }

    // File upload
    public function fileupload()
    {

        $target_dir = "uploads/"; // Upload directory
        $request = 1;

        if (isset($_POST['request'])) {
            $request = $_POST['request'];
        }

        // Upload file
        if ($request == 1) {
            if (!empty($_FILES['file']['name'])) {

                // Set preference
                $config['upload_path'] = $target_dir;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '1024'; // max_size in kb
                $config['file_name'] = $_FILES['file']['name'];

                //Load upload library
                $this->load->library('upload', $config);

                // File upload
                if ($this->upload->do_upload('file')) {
                    // Get data about the file
                    $uploadData = $this->upload->data();
                }
            }

        }
        // Remove file
        if ($request == 2) {
            $filename = $target_dir . $_POST['name'];
            unlink($filename);exit;
        }
    }

    //REFRESH CAPTCHA
    public function refresh()
    {
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
            'img_height' => 30,
            'expiration' => 7200,
            'word_length' => 8,
            'font_size' => 16,
            'img_id' => 'Imageid',
            'pool' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and red grid
            'colors' => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40),
            ),
        );
        $captcha = create_captcha($config);
        $this->session->unset_userdata('valuecaptchaCode');
        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
        echo $captcha['image'];
    }
}

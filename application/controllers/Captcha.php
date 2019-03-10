<?php
defined('BASEPATH') OR exit('your exit message');
class Captcha extends CI_Controller
{
    
    function __construct(){
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('captcha');
}
    public function index(){
        if ($this->input->post('submit')) {
            $captcha_insert = $this->input->post('captcha');
            $contain_sess_captcha = $this->session->userdata('valuecaptchaCode');
            if ($captcha_insert === $contain_sess_captcha) {
                echo 'Success';
            } else {
                echo 'Failure';
            }
        }
        $config = array(
            'img_url' => base_url() . 'image_for_captcha/',
            'img_path' => 'image_for_captcha/',
            // 'img_height' => 45,
            // 'word_length' => 5,
            // 'img_width' => '45',
            // 'font_size' => 10

            'word'          => $this->rand_gen->generate(8, 'alpha-numeric'),
            // 'img_path'      => './captcha/',
            // 'img_url'       => 'http://example.com/captcha/',
            'font_path'     => base_url() . 'assets/fonts/grunja.ttf',
            'img_width'     => '150',
            'img_height'    => 50,
            'expiration'    => 7200,
            'word_length'   => 8,
            'font_size'     => 20,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and red grid
            'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 40, 40)
            )
        );
        $captcha = create_captcha($config);
        $this->session->unset_userdata('valuecaptchaCode');
        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
        $data['captchaImg'] = $captcha['image'];
        $this->load->view('captcha/index', $data);
    }
    public function refresh()
    {
        $config = array(
            'img_url' => base_url() . 'image_for_captcha/',
            'img_path' => 'image_for_captcha/',
            // 'img_height' => 45,
            // 'word_length' => 5,
            // 'img_width' => '45',
            // 'font_size' => 10

            'word'          => $this->rand_gen->generate(8, 'alpha-numeric'),
            // 'img_path'      => './captcha/',
            // 'img_url'       => 'http://example.com/captcha/',
            'font_path'     => base_url() . 'assets/fonts/grunja.ttf',
            'img_width'     => '150',
            'img_height'    => 30,
            'expiration'    => 7200,
            'word_length'   => 8,
            'font_size'     => 16,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and red grid
            'colors'        => array(
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
}
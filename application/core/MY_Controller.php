<?php

class MY_Controller extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        
    }

    public function render($view, $data = []) {
        $data['content'] = $view;
        $this->load->view('v_layout', $data);
    }
   
}

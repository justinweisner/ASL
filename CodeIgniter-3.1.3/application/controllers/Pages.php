<?php
class Pages extends CI_Controller {
	
	public function view($page = 'home'){
		
		if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
		{
			//Show error if page isn't there
			show_404();
		}
		
	$data['title'] = ucfirst($page); //ucfirst = Capitialize the first letter.
	
		
		
	//Load Pages
	$this->load->view('templates/header', $data);
	$this->load->view('pages/'.$page, $data);
	$this->load->view('templates/footer', $data);
	}
}
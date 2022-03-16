<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->data = array();
		$this->load->model("User_model", "m_user");
		$this->load->library("BuildCardUser");
	}

	private function buildMenu(){
		$this->load->library("BuildMenu");
		$this->data['menu']	=  $this->buildmenu->getHtml();
	}

	private function updateSession( ){
		$user			= $this->m_user->getSelf();
		$login			= (object)$this->session->userdata("user_logged");
		$login->user_id		= $user->id;
		$login->first_name	= $user->first_name;
		$login->type		= $user->type;
		$this->session->set_userdata("user_logged",  $login);
	}

	public function index( ){
		$this->login->isForbidden();
		$this->login->isDontLogged();

		$findUser	= $this->input->post("findUser");
		$user		= $this->m_user->getAll();
		$user		= findWordOnObjectArray( $user , $findUser);

		$this->buildcarduser->build($user);
		
		$this->buildMenu();
		$this->data['profile']		= $this->buildcarduser->getHtml();
		$this->data['findUser']		= $findUser;
		$this->data['path']		= "Gerenciar Usuários";
		$this->data['js']		= "";
		$this->data['header']		= $this->load->view("common/header", $this->data, true);
		$this->data['navbar']		= $this->load->view("common/navbar", $this->data, true);
		$this->data['header']		= $this->load->view("common/header", $this->data, true);
		$this->data['navbar']		= $this->load->view("common/navbar", $this->data, true);
		$this->data['content']		= $this->load->view("pages/profile", $this->data, true);
		$this->data['footer']		= $this->load->view("common/footer", $this->data, true);
		
		$this->load->view("page", $this->data);	
	}

	public function create(){
		$this->login->isDontLogged();
		$this->login->isForbidden();

		if( $this->m_user->create( (Object)$this->input->post() ) ){
			redirect('Profile', 'refresh');
		}

		$this->buildMenu();
		$this->data['path']	= "Criar Usuário";
		$this->data['js']	= "";
		$this->data['header']	= $this->load->view("common/header", $this->data, true);
		$this->data['navbar']	= $this->load->view("common/navbar", $this->data, true);
		$this->data['header']	= $this->load->view("common/header", $this->data, true);
		$this->data['navbar']	= $this->load->view("common/navbar", $this->data, true);
		$this->data['content']	= $this->load->view("pages/profile_create", $this->data, true);
		$this->data['footer']	= $this->load->view("common/footer", $this->data, true);

		$this->load->view("page", $this->data);	


	}

	public function update(){
		$this->login->isDontLogged();

		$user = $this->m_user->getSelf();

		if(!$user) {
			$this->session->unset_userdata("user_logged");
			redirect('Profile/sign_in', 'refresh');			
		}

		if($this->m_user->updateSelf( (object)$this->input->post() )){
			$this->updateSession();
			redirect('Sensor', 'refresh');			
		}

		$this->load->library("BuildMenu");
				
		$this->buildMenu();
		$this->data['menu']	= $this->buildmenu->getHtml();
		$this->data['js']	= "";
		$this->data['user']	= $user;
		$this->data['path']	= "Atualizar conta";
		$this->data['header']	= $this->load->view("common/header", $this->data, true);
		$this->data['navbar']	= $this->load->view("common/navbar", $this->data, true);
		$this->data['content']	= $this->load->view("pages/profile_update", $this->data, true);
		$this->data['footer']	= $this->load->view("common/footer", $this->data, true);

		$this->load->view("page", $this->data);
	}
	
	public function sign_in(){
		$this->login->isLogged();
		$ans = $this->m_user->authenticate((object)$this->input->post());
		$this->session->set_userdata("user_logged",  $ans);
		$this->login->isLogged();

		$this->data['js']	= "";
		$this->data['navbar']	= "";
		$this->data['header']	= $this->load->view("common/header", $this->data, true);
		$this->data['content']	= $this->load->view("pages/sign_in", $this->data, true);
		$this->data['footer']	= $this->load->view("common/footer", $this->data, true);

		$this->load->view("page", $this->data);
	}

	public function delete($id=0){

		if($id <= 1){
			redirect('Profile/sign_in', 'refresh');
		}

		$this->login->isForbidden();
		$this->login->isDontLogged();
		$this->m_user->delete($id);

		redirect('Profile', 'refresh');

	}

	public function sign_out(){
		$this->session->unset_userdata("user_logged");
		redirect('Profile/sign_in', 'refresh');
	}
}

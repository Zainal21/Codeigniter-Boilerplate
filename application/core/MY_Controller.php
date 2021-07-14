  <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  /**
   *  used for load view templating
   *  @param null
   *  @return int
   */
	public function view($data = [])
	{
		$this->load->view('layouts/main', $data);
	}
	/**
   * used for check if user authenticated
   *  @param null
   *  @return int
   */
	public function is_auth()
	{
		if($this->session->userdata('is_logged') == FALSE){
			redirect(base_url('panel/login'));
		}
	}


}

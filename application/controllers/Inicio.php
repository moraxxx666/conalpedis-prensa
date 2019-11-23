<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inicio extends CI_Controller
{
	function __construct()
	{
		// Construct the parent class
		parent::__construct();

		// Configure limits on our controller methods
		// Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
		$this->load->model('administrador_model', '', TRUE);
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($page = 'Noticias')
	{
		if (!file_exists(APPPATH . 'views/publico/' . $page . '.php')) {

			show_404();
		}
		$data['titulo'] = ucfirst($page);
		switch ($page) {

			case "Noticias":

				$data['colecciones'] = $this->administrador_model->ObtenerNoticias();

				$this->load->view('publico/Header', $data);
				$this->load->view('publico/Styles');
				$this->load->view('publico/FloatingButton');
				$this->load->view('publico/NavBar');
				$this->load->view('publico/Noticias', $data);
				$this->load->view('publico/Footer');
				$this->load->view('publico/Scripts');
				break;
		}
	}
	public function VerNoticia($id)
	{
		$data['id'] = $id;
		if (is_numeric($id) &&  $this->administrador_model->ObtenerNoticia($id) != null) {
			$data['noticia'] = $this->administrador_model->ObtenerNoticia($id);
			$data['imagenes'] = $this->administrador_model->ObtenerImagenesNoticia($id);
		} else {
			$this->session->set_flashdata('mensaje', "No se Encuentra la Noticia");
			redirect('/Noticias');
		}
		$data['titulo'] = ucfirst($data['noticia']['titulo']);
		$this->load->view('publico/Header', $data);
		$this->load->view('publico/Styles');
		$this->load->view('publico/FloatingButton');
		$this->load->view('publico/NavBar');
		$this->load->view('publico/Noticia', $data);
		$this->load->view('publico/Footer');
		$this->load->view('publico/Scripts');
	}
}

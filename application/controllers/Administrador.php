<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Administrador extends CI_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->load->model('administrador_model', '', TRUE);
    }
    public function login()
    {
        $usuario =  $this->input->post('usuario');
        $contrasena = $this->input->post('contrasena');
        if ($this->ion_auth->login($usuario, $contrasena, false) && $this->ion_auth->is_admin()) {
            redirect('Administrador/AgregarNoticia');
        } else {
            $this->session->set_flashdata('mensaje', 'Usuario o Contraseña incorrecta intentalo de nuevo');
            redirect('/Noticias');
        }
    }
    public function logout()
    {

        $this->ion_auth->logout();
        redirect('/Noticias');
    }
    public function AgregarNoticia()
    {
        if ($this->ion_auth->logged_in()) {
            $data['usuario'] = $this->ion_auth->user()->row();




            $this->load->view('administrador/Header', $data);
            $this->load->view('administrador/Styles');
            $this->load->view('administrador/NavBar');
            $this->load->view('administrador/Inicio');
            $this->load->view('publico/Footer');
            $this->load->view('administrador/Scripts');
        } else {
            $this->session->set_flashdata('mensaje', 'Necesitas Iniciar Sesion');
            redirect('/Noticias');
        }
    }
    public function GuardarNoticia()
    {
        if ($this->ion_auth->logged_in()) {
            $titulo = $this->input->post('titulo');
            $noticia = $this->input->post('noticia');


            if (empty($titulo) || empty($noticia) || empty($_FILES['file']['name'][0])) {
                $this->session->set_flashdata('mensaje', 'TODOS LOS CAMPOS SON NECESARIOS');
                redirect('Administrador/AgregarNoticia');
            } else {
                //GuardarNoticia
                $noticia = array(
                    "titulo" => $titulo,
                    "noticia" => $noticia
                );
                $id_noticia = $this->administrador_model->AgregarNoticia($noticia);
                if ($id_noticia != null) {
                    //Subir fotos al servidor
                    $NumeroFotos = count($_FILES['file']['name']);
                    for ($i = 0; $i < $NumeroFotos; $i++) {
                        $_FILES['tmp']['name'] = $_FILES['file']['name'][$i];
                        $_FILES['tmp']['type'] = $_FILES['file']['type'][$i];
                        $_FILES['tmp']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                        $_FILES['tmp']['error'] = $_FILES['file']['error'][$i];
                        $_FILES['tmp']['size'] = $_FILES['file']['size'][$i];

                        $config['upload_path'] = 'uploads/noticias';
                        $config['allowed_types'] = '*';
                        $config['max_size'] = '0'; // max_size in kb
                        $config['file_name'] = $_FILES['file']['name'][$i];
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('tmp')) {
                            //*** ocurrio un error

                            //echo $this->upload->display_errors();
                            $this->session->set_flashdata('mensaje', 'ERROR AL SUBIR LAS FOTOS');
                            redirect('Administrador/AgregarNoticia');
                        } else {
                            $data['uploadSuccess'] = $this->upload->data();
                            $array = array(

                                "nombre_imagen" => $data['uploadSuccess']['file_name'],
                                "id_noticia" => $id_noticia,

                            );
                            $this->administrador_model->AgregarFoto($array);
                        }
                    }
                    $this->session->set_flashdata('mensaje', 'NOTICA GUARDADA CORRECTAMENTE');
                    redirect('Administrador/AgregarNoticia');
                } else {
                    $this->session->set_flashdata('mensaje', 'ERROR AL GUARDAR LA NOTICIA');
                    redirect('Administrador/AgregarNoticia');
                }
            }
        } else {
            $this->session->set_flashdata('mensaje', 'Necesitas Iniciar Sesion');
            redirect('/Noticias');
        }
    }
    public function NoticiasAdmin()
    {
        if ($this->ion_auth->logged_in()) {
            $data['usuario'] = $this->ion_auth->user()->row();

            $data['noticias'] = $this->administrador_model->ObtenerNoticiasAdmin();


            $this->load->view('administrador/Header', $data);
            $this->load->view('administrador/Styles');
            $this->load->view('administrador/NavBar');
            $this->load->view('administrador/Noticias', $data);
            $this->load->view('publico/Footer');
            $this->load->view('administrador/Scripts');
        } else {
            $this->session->set_flashdata('mensaje', 'Necesitas Iniciar Sesion');
            redirect('/Noticias');
        }
    }
    public function EliminarNoticia()
    {
        if ($this->ion_auth->logged_in()) {
            $id_noticia = $this->input->post('id_noticia');
            if (!empty($id_noticia)) {
                if ($this->administrador_model->EliminarNoticia($id_noticia)) {
                    $this->session->set_flashdata('mensaje', 'Noticia Eliminada Correctamente');
                    redirect('/Administrador/NoticiasAdmin');
                } else {
                    $this->session->set_flashdata('mensaje', 'Error al Eliminar la Noticia');
                    redirect('/Administrador/NoticiasAdmin');
                }
            } else {
                $this->session->set_flashdata('mensaje', 'No se encuentra la noticia');
                redirect('/Administrador/NoticiasAdmin');
            }
        } else {
            $this->session->set_flashdata('mensaje', 'Necesitas Iniciar Sesion');
            redirect('/Noticias');
        }
    }
    public function Noticia($id_noticia)
    {
        if ($this->ion_auth->logged_in()) {

            if (is_numeric($id_noticia) && $this->administrador_model->ObtenerNoticia($id_noticia)!=null) {
                $noticia = $this->administrador_model->ObtenerNoticia($id_noticia);
                $data['usuario'] = $this->ion_auth->user()->row();
                $data['imagenes'] = $this->administrador_model->ObtenerImagenesNoticia($id_noticia);
                $data['noticia'] = $noticia;


                $this->load->view('administrador/Header', $data);
                $this->load->view('administrador/Styles');
                $this->load->view('administrador/NavBar');
                $this->load->view('administrador/Noticia', $data);
                $this->load->view('publico/Footer');
                $this->load->view('administrador/Scripts');
            } else {
                $this->session->set_flashdata('mensaje', 'No se encuentra la noticia');
                redirect('/Administrador/NoticiasAdmin');
            }
        } else {
            $this->session->set_flashdata('mensaje', 'Necesitas Iniciar Sesion');
            redirect('/Noticias');
        }
    }
}

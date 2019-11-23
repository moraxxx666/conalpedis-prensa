<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Administrador_model extends CI_Model
{
    public function AgregarNoticia($noticia)
    {
        if ($this->db->insert('prensa_noticia', $noticia)) {
            return $this->db->insert_id();
        } else return null;
    }
    public function ObtenerNoticiasAdmin()
    {
        $query = $this->db->query("SELECT noti.id_noticia,noti.titulo,noti.fecha,ima.nombre_imagen
        FROM prensa_noticia noti, prensa_imagenes ima
        WHERE noti.id_noticia = ima.id_noticia
        GROUP by noti.id_noticia
        ORDER by noti.fecha DESC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else return array();
    }
    public function EliminarNoticia($id)
    {

        if ($this->db->delete('prensa_noticia', array('id_noticia' => $id))) {
            return true;
        } else return false;
    }
    public function AgregarFoto($foto)
    {
        if ($this->db->insert('prensa_imagenes', $foto)) {
            return true;
        } else return false;
    }
    public function ObtenerNoticia($id_noticia)
    {
        $query = $this->db->query("SELECT * FROM prensa_noticia WHERE id_noticia = $id_noticia");
        if ($query->num_rows() === 1) {
            return $query->row_array();
        } else {
            return null;
        }
    }
    public function ObtenerImagenesNoticia($id_noticia)
    {
        $query = $this->db->query("SELECT * FROM prensa_imagenes WHERE id_noticia = $id_noticia");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    public function ObtenerNoticias()
    {
        $query = $this->db->query("SELECT noti.id_noticia,noti.titulo,noti.fecha,ima.nombre_imagen
        FROM prensa_noticia noti, prensa_imagenes ima
        WHERE noti.id_noticia = ima.id_noticia
        GROUP by noti.id_noticia
        ORDER by noti.fecha DESC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else return array();
    }
}

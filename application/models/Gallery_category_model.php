<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_category_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'album_id' => $this->input->post('album_id', true),
            'name' => $this->input->post('name', true)
        );
        return $data;
    }

    public function input_values_cat()
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'audio_album_id' => $this->input->post('album_id', true),
            'name' => $this->input->post('name', true)
        );
        return $data;
    }
     // video categories add
    public function input_values_cat_video()
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'cate_id' => $this->input->post('album_id', true),
            'name' => $this->input->post('name', true)
        );
        return $data;
    }
   // video categories add
    public function add_audio_cat_video()
    {
        $data = $this->input_values_cat_video();
        return $this->db->insert('video_categories', $data);
    }

    public function add_audio_cat()
    {
        $data = $this->input_values_cat();
        return $this->db->insert('audio_categories', $data);
    }

    //add category
    public function add()
    {
        $data = $this->input_values();
        return $this->db->insert('gallery_categories', $data);
    }

    //get all gallery categories
    public function get_all_categories()
    {
        $query = $this->db->query("SELECT * FROM gallery_categories ORDER BY id DESC");
        return $query->result();
    }
     
     //get all audio categories
     public function get_all_audio_categories()
    {
        $query = $this->db->query("SELECT * FROM audio_categories ORDER BY id DESC");
        return $query->result();
    }

    //get all video categories
     public function get_all_video_categories()
    {
        $query = $this->db->query("SELECT * FROM video_categories ORDER BY id DESC");
        return $query->result();
    }

    //get gallery categories
    public function get_categories_by_selected_lang()
    {
        $sql = "SELECT * FROM gallery_categories WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($this->selected_lang->id)));
        return $query->result();
    }

    //get gallery categories by lang
    public function get_categories_by_lang($lang_id)
    {
        $sql = "SELECT * FROM gallery_categories WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }

    //get gallery categories by album
    public function get_categories_by_album($cate_id)
    {
        $sql = "SELECT * FROM  video_categories WHERE cate_id = ?";
        $query = $this->db->query($sql, array(clean_number($cate_id)));
        return $query->result();
    }

    public function get_categories_by_album_image($cate_id)
    {
        $sql = "SELECT * FROM  gallery_albums WHERE cate_id = ?";
        $query = $this->db->query($sql, array(clean_number($cate_id)));
        return $query->result();
    }
    //get audio categories by album
     public function get_categories_by_audio_album($cate_id)
    {
        $sql = "SELECT * FROM audio_categories WHERE audio_album_id = ?";
        $query = $this->db->query($sql, array(clean_number($cate_id)));
        return $query->result();
    }

    //    public function get_categories_by_video_album($video_album_id)
    // {
    //     $sql = "SELECT * FROM video_categories WHERE cate_id = ?";
    //     $query = $this->db->query($sql, array(clean_number($video_album_id)));
    //     return $query->result();
    // }

    //get category count
    public function get_category_count()
    {
        $sql = "SELECT COUNT(id) AS count FROM gallery_categories WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->row()->count;
    }

    //get category
    public function get_category($id)
    {
        $sql = "SELECT * FROM gallery_categories WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

    public function get_audio_category($id)
    {
        $sql = "SELECT * FROM audio_categories WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

     public function get_video_category($id)
    {
        $sql = "SELECT * FROM video_categories WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

    //update category
    public function update($id)
    {
        $id = clean_number($id);
        $data = $this->input_values();

        $this->db->where('id', $id);
        return $this->db->update('gallery_categories', $data);
    }

    public function update_audio_cat($id)
    {
        $id = clean_number($id);
        $data = $this->input_values_cat();

        $this->db->where('id', $id);
        return $this->db->update('audio_categories', $data);
    }

    public function update_video_cat($id)
    {
        $id = clean_number($id);
        $data = $this->input_values_cat_video();

        $this->db->where('id', $id);
        return $this->db->update('video_categories', $data);
    }

    //delete category
    public function delete($id)
    {
        $category = $this->get_category($id);
        if (!empty($category)) {
            $this->db->where('id', $category->id);
            return $this->db->delete('gallery_categories');
        } else {
            return false;
        }
    }

    /*
     * ------------------------------------------------------------------------------
     * GALLERY ALBUMS
     * ------------------------------------------------------------------------------
     */

    //add album
    public function add_album()
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'name' => $this->input->post('name', true)
        );
        return $this->db->insert('gallery_albums', $data);
    }

   //add audio album
    public function add_audio_album()
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'name' => $this->input->post('name', true)
        );
        return $this->db->insert('audio_albums', $data);
    }

    //add audio album
    public function add_infographic_category()
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'name' => $this->input->post('name', true)
        );
        return $this->db->insert('infographic_category', $data);
    }


    //add video album
    public function add_video_album()
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'name' => $this->input->post('name', true)
        );
        return $this->db->insert('video_albums', $data);
    }

    public function update_audio_album($id)
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'name' => $this->input->post('name', true)
        );
        $this->db->where('id', $id);
        return $this->db->update('audio_albums', $data);
    }

     public function update_infographic_category($id)
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'name' => $this->input->post('name', true)
        );
        $this->db->where('id', $id);
        return $this->db->update('infographic_category', $data);
    }
    
    //add video album
    public function update_video_album($id)
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'name'    => $this->input->post('name', true)
        );
        $this->db->where('id', $id);
        return $this->db->update('video_albums', $data);
    }



    //update album
    public function update_album($id)
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'name' => $this->input->post('name', true)
        );
        $this->db->where('id', $id);
        return $this->db->update('gallery_albums', $data);
    }


    //get albums
    public function get_albums()
    {
        $query = $this->db->query("SELECT * FROM gallery_albums ORDER BY id DESC");
        return $query->result();
    }

    //get albums by lang
    public function get_albums_by_lang($lang_id)
    {
        $sql = "SELECT * FROM gallery_albums WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }

   

     public function get_audio_albums_by_lang($lang_id)
    {
        $sql = "SELECT * FROM audio_albums WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }

     public function get_infographic_by_lang($lang_id)
    {
        $sql = "SELECT * FROM infographic_category WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }

      public function get_logo_gallery_by_lang($lang_id)
    {
        $sql = "SELECT * FROM logo_gallery WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }

      public function get_event_by_lang($lang_id)
    {
        $sql = "SELECT * FROM event WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }

     public function get_media_by_lang($lang_id)
    {
        $sql = "SELECT * FROM media WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }

      public function get_video_albums_by_lang($lang_id)
    {
        $sql = "SELECT * FROM video_albums WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }


     //get audio
    public function get_audio_albums($lang_id)
    {   
        if(empty($lang_id)){
            $query = $this->db->query("SELECT * FROM audio_albums ORDER BY id DESC");
        }
        else{
        $query = $this->db->query("SELECT * FROM audio_albums where lang_id = $lang_id ORDER BY id DESC");
        }
        return $query->result();       
    }

     //get infographic category
    public function get_infographic_category()
    {
        $query = $this->db->query("SELECT * FROM infographic_category ORDER BY id DESC");
        return $query->result();
    }

    public function regional_pro_name($id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->result();
    }


       //get video
    public function get_video_albums()
    {
        $query = $this->db->query("SELECT * FROM video_albums ORDER BY id DESC");
        return $query->result();
    }

    //get audio by lang

    //get album category count
    public function get_album_category_count($album_id)
    {
        $sql = "SELECT COUNT(id) AS count FROM gallery_categories WHERE lang_id = ? AND album_id= ?";
        $query = $this->db->query($sql, array(clean_number($this->selected_lang->id), clean_number($album_id)));
        return $query->row()->count;
    }

    public function get_audio_album_category_count($album_id)
    {
    $sql = "SELECT COUNT(id) AS count FROM audio_categories WHERE lang_id = ? AND audio_album_id= ?";
        $query = $this->db->query($sql, array(clean_number($this->selected_lang->id), clean_number($album_id)));
        return $query->row()->count;
    }
    //get video album category count
    public function get_video_album_category_count($album_id)
    {
        $sql = "SELECT COUNT(id) AS count FROM video_categories WHERE lang_id = ? AND cate_id= ?";
        $query = $this->db->query($sql, array(clean_number($this->selected_lang->id), clean_number($album_id)));
        return $query->row()->count;
    }
    //get album
    public function get_album($id)
    {
        $sql = "SELECT * FROM gallery_albums WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

    public function get_audio_album($id)
    {

        $sql = "SELECT * FROM audio_albums WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        //echo $this->last_query($query);die();
        return $query->row();
    }

    public function get_infographic_category_edit($id)
    {

        $sql = "SELECT * FROM infographic_category WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        //echo $this->last_query($query);die();
        return $query->row();
    }


    public function get_video_album($id)
    {

        $sql = "SELECT * FROM video_albums WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        //echo $this->last_query($query);die();
        return $query->row();
    }

    //delete album
    public function delete_album($id)
    {
        $album = $this->get_album($id);
        if (!empty($album)) {
            $this->db->where('id', $album->id);
            return $this->db->delete('gallery_albums');
        }
        return false;
    }

    public function delete_audio_album($id)
    {
        $album = $this->get_audio_albums($id);
        if (!empty($album)){
            $this->db->where('id', $album->id);
            return $this->db->delete('audio_albums');
        }
        return false;
    }
/*delete infographic category*/ 
    public function delete_infographic_category($id)
    {
        //$album = $this->get_audio_albums($id);
        if (!empty($id)){
            $this->db->where('id', $id);
            return $this->db->delete('infographic_category');
        }
        return false;
    }

    public function delete_video_album($id)
    {
        $album = $this->get_video_albums($id);
        if (!empty($album)) {
            $this->db->where('id', $album->id);
            return $this->db->delete('video_albums');
        }
        return false;
    }

}
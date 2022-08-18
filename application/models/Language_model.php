<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Language_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'name' => $this->input->post('name', true),
            'short_form' => $this->input->post('short_form', true),
            'language_code' => $this->input->post('language_code', true),
            'language_order' => $this->input->post('language_order', true),
            'text_direction' => $this->input->post('text_direction', true),
            'text_editor_lang' => $this->input->post('text_editor_lang', true),
            'status' => $this->input->post('status', true)
        );
        return $data;
    }

    //add language
    public function add_language()
    {
        $data = $this->input_values();
        if ($this->db->insert('languages', $data)) {
            $language_id = $this->db->insert_id();
            //insert translations
            $translations = $this->get_language_translations(1);
            if (!empty($translations)) {
                foreach ($translations as $translation) {
                    $data_translation = array(
                        'lang_id' => $language_id,
                        'label' => $translation->label
                       // 'translation' => $translation->translation
                    );
                    $this->db->insert('language_translations', $data_translation);
                }
            }
            return $language_id;
        }
        return false;
    }


     //add language
    public function update_language_lavel($lang_id)
    {
        $data = $this->input_values();
       // if ($this->db->insert('languages', $data)) {
           //$language_id = $this->db->insert_id();
            //insert translations
            $translations         = $this->get_language_translations(1);
            $translations_two     = $this->get_language_translations($lang_id);
            $count_lang_trans     = count($translations);
            $count_lang_trans_two = count($translations_two);

           // echo $count_lang_trans;
           // echo $count_lang_trans_two;
            
            $translations_label = array();
            $translations_two_label = array();
            $translations_difference = array();
            foreach ($translations as $translation) {
                $translations_label[] = $translation->label;
            }

            foreach ($translations_two as $translation2) {
                $translations_two_label[] = $translation2->label;
            }

           // echo '<pre>'; print_r($translations_label);
           // echo '</pre>';
            
              foreach ($translations_label as $translation) {

                if(!in_array($translation,$translations_two_label)){
                    $data_translation = array(
                        'lang_id' => $lang_id,
                        'label' => $translation,
                        'translation' => ''
                    );
                    $this->db->insert('language_translations', $data_translation);
                }

              }
            
           return true;
       // }
        return false;
    }

    //add language rows
    public function add_language_rows($lang_id)
    {
        //add widgets
        $data = array(
            'lang_id' => $lang_id,
            'content' => "",
            'visibility' => 1,
            'is_custom' => 0,
        );

        $data["title"] = "Follow Us";
        $data["widget_order"] = 1;
        $data["type"] = "follow-us";
        $this->db->insert('widgets', $data);

        $data["title"] = "Popular Posts";
        $data["widget_order"] = 2;
        $data["type"] = "popular-posts";
        $this->db->insert('widgets', $data);

        $data["title"] = "Recommended Posts";
        $data["widget_order"] = 3;
        $data["type"] = "recommended-posts";
        $this->db->insert('widgets', $data);

        $data["title"] = "Random Posts";
        $data["widget_order"] = 4;
        $data["type"] = "random-slider-posts";
        $this->db->insert('widgets', $data);

        $data["title"] = "Tags";
        $data["widget_order"] = 5;
        $data["type"] = "tags";
        $this->db->insert('widgets', $data);

        $data["title"] = "Voting Poll";
        $data["widget_order"] = 6;
        $data["type"] = "poll";
        $this->db->insert('widgets', $data);

        //add settings
        $settings = array(
            'lang_id' => $lang_id,
            'site_title' => "Varient - News Magazine",
            'home_title' => "Index",
            'site_description' => "Varient - News Magazine",
            'keywords' => "Varient, News, Magazine",
            'application_name' => "Varient",
            'primary_font' => 19,
            'secondary_font' => 25,
            'tertiary_font' => 32,
            'facebook_url' => "",
            'twitter_url' => "",
            'instagram_url' => "",
            'pinterest_url' => "",
            'linkedin_url' => "",
            'vk_url' => "",
            'telegram_url' => "",
            'youtube_url' => "",
            'optional_url_button_name' => "Click Here To See More",
            'about_footer' => "",
            'contact_text' => "",
            'contact_address' => "",
            'contact_email' => "",
            'contact_phone' => "",
            'copyright' => "",
            'cookies_warning' => 0,
            'cookies_warning_text' => "",
        );

        $this->db->insert('settings', $settings);
    }

    //add language pages
    public function add_language_pages($lang_id)
    {
        //add pages
        $page = array(
            'lang_id' => $lang_id, 'title' => "Gallery", 'slug' => "gallery", 'description' => "Varient Gallery Page", 'keywords' => "varient, gallery , page", 'is_custom' => 0, 'page_default_name' => 'gallery', 'page_content' => "", 'page_order' => 2, 'visibility' => 1, 'title_active' => 1, 'breadcrumb_active' => 1, 'right_column_active' => 0, 'need_auth' => 0, 'location' => "main", 'link' => '', 'parent_id' => 0, 'page_type' => "page",
        );
        $this->db->insert('pages', $page);
        $page = array(
            'lang_id' => $lang_id, 'title' => "Contact", 'slug' => "contact", 'description' => "Varient Contact Page", 'keywords' => "varient, contact, page", 'is_custom' => 0, 'page_default_name' => 'contact', 'page_content' => "", 'page_order' => 1, 'visibility' => 1, 'title_active' => 1, 'breadcrumb_active' => 1, 'right_column_active' => 0, 'need_auth' => 0, 'location' => "top", 'link' => '', 'parent_id' => 0, 'page_type' => "page",
        );
        $this->db->insert('pages', $page);

        $page = array(
            'lang_id' => $lang_id, 'title' => "Terms & Conditions", 'slug' => "terms-conditions", 'description' => "Varient Terms Conditions Page", 'keywords' => "varient, terms, conditions", 'is_custom' => 0, 'page_default_name' => 'terms_conditions', 'page_content' => "", 'page_order' => 1, 'visibility' => 1, 'title_active' => 1, 'breadcrumb_active' => 1, 'right_column_active' => 0, 'need_auth' => 0, 'location' => "footer", 'link' => '', 'parent_id' => 0, 'page_type' => "page",
        );
        $this->db->insert('pages', $page);
    }

    //update language
    public function update_language($id)
    {
        $language = $this->get_language($id);
        if (!empty($language)) {
            $data = $this->input_values();
            $this->db->where('id', clean_number($id));
            return $this->db->update('languages', $data);
        }
    }

    //get language
    public function get_language($id)
    {
        $sql = "SELECT * FROM languages WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($id)));
        return $query->row();
    }

    //get site language
    public function get_site_language()
    {
        $sql = "SELECT * FROM languages WHERE id = ?";
        $query = $this->db->query($sql, array(clean_number($this->general_settings->site_lang)));
        $row = $query->row();
        if (empty($row)) {
            $query = $this->db->query("SELECT * FROM languages ORDER BY id LIMIT 1");
            $row = $query->row();
        }
        return $row;
    }

    //get languages
    public function get_languages()
    {
        $query = $this->db->query("SELECT * FROM languages ORDER BY language_order");
        return $query->result();
    }

    public function get_languages_press_relase_other($id,$lang_id)
    {

       $query1 = $this->db->query("SELECT * FROM press_release WHERE id = $id");
        $query1->result();
      
       $result1= $query1->row();
       if(isset($result1->translated_id)){
         $check_id = $result1->translated_id;
        }else{
            $check_id = $id;
        }



        $this->db->select('lang_id');
        $this->db->from('press_release');
        $this->db->where('press_release.translated_id',$id);
        $this->db->or_where('press_release.id',$id);
        $this->db->or_where('press_release.id',$check_id);
       

        $query1  = $this->db->get();
        $result1 = $query1->result_array();

        $deviceIds = array();
        foreach ($result1 as $item) {
            $deviceIds[] = $item['lang_id'];
        }
        $str = implode(',', $deviceIds);
    

        $query = $this->db->query("SELECT * FROM languages where id not in ($str) ORDER BY language_order");
       // echo $this->db->last_query();
        return $query->result();

    }


    //get language translations
    public function get_language_translations($lang_id)
    {
        $sql = "SELECT * FROM language_translations WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }

       public function get_language_translations2($lang_id)
    {
        $sql = "SELECT * FROM language_translations WHERE lang_id = ?";
        $query = $this->db->query($sql, array(clean_number($lang_id)));
        return $query->result();
    }


    //get paginated translations
    public function get_paginated_translations($lang_id, $per_page, $offset)
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $like = '%' . $q . '%';
            $sql = "SELECT * FROM language_translations WHERE lang_id = ? AND (label LIKE ? OR translation LIKE ?) ORDER BY id LIMIT ?, ?";
            $query = $this->db->query($sql, array(clean_number($lang_id), $like, $like, clean_number($offset), clean_number($per_page)));
        } else {
            $sql = "SELECT * FROM language_translations WHERE lang_id = ? ORDER BY id LIMIT ?, ?";
            $query = $this->db->query($sql, array(clean_number($lang_id), clean_number($offset), clean_number($per_page)));
        }
        return $query->result();
    }

    //get translations count
    public function get_translation_count($lang_id)
    {
        $q = trim($this->input->get('q', true));
        if (!empty($q)) {
            $like = '%' . $q . '%';
            $sql = "SELECT * FROM language_translations WHERE lang_id = ? AND (label LIKE ? OR translation LIKE ?)";
            $query = $this->db->query($sql, array(clean_number($lang_id), $like, $like));
        } else {
            $sql = "SELECT * FROM language_translations WHERE lang_id = ?";
            $query = $this->db->query($sql, array(clean_number($lang_id)));
        }
        return $query->num_rows();
    }

    //get active languages
    public function get_active_languages()
    {
        $query = $this->db->query("SELECT * FROM languages WHERE status = 1 ORDER BY language_order");
        return $query->result();
    }

    //check short form
    public function check_short_form()
    {
        $short_form = $this->input->post('short_form', true);

        $pages = $this->page_model->get_all_pages();
        foreach ($pages as $page) {
            if ($page->slug == trim($short_form)) {
                return false;
            }
        }
        return true;
    }

    //set language
    public function set_language()
    {
        $data = array(
            'site_lang' => $this->input->post('site_lang', true),
        );

        $lang = $this->language_model->get_language($data["site_lang"]);

        if (!empty($lang)) {
            $this->db->where('id', 1);
            return $this->db->update('general_settings', $data);
        }

        return false;
    }

    //delete language
    public function delete_language($id)
    {
        $language = $this->get_language($id);
        if (!empty($language)) {
            //delete translations
            $sql = "SELECT * FROM language_translations WHERE lang_id = ?";
            $query = $this->db->query($sql, array(clean_number($language->id)));
            $translations = $query->result();
            if (!empty($translations)) {
                foreach ($translations as $translation) {
                    $this->db->where('id', $translation->id);
                    $this->db->delete('language_translations');
                }
            }

            //delete settings
            $this->db->where('lang_id', $language->id);
            $this->db->delete('settings');

            //delete pages
            $this->db->where('lang_id', $language->id);
            $this->db->delete('pages');

            //delete language
            $this->db->where('id', $id);
            return $this->db->delete('languages');
        } else {
            return false;
        }
    }

    //update translation
    public function update_translation($lang_id, $id, $translation)
    {
        $data = array(
            'translation' => $translation
        );
        $this->db->where('lang_id', clean_number($lang_id));
        $this->db->where('id', clean_number($id));
        $this->db->update('language_translations', $data);
    }
}

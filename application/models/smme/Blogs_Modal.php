
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Blogs_Modal extends CI_Model
{
 
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function select_blogs($cat_id,$sub_cat_id) {

        //echo $sub_cat_id;exit;

        $this->db->join('tbl_basecenter_category','tbl_basecenter_category.tbl_basecenter_category_id = tbl_blog.tbl_blog_category_id','LEFT');
        
        $this->db->join('tbl_basecenter_sub_category','tbl_basecenter_sub_category.tbl_basecenter_sub_category_id = tbl_blog.tbl_blog_subcategory_id','LEFT');
        
        if ($sub_cat_id != 0) 
        {

            $this->db->where('tbl_blog_category_id',$cat_id);
            $this->db->where('tbl_blog_subcategory_id',$sub_cat_id);
        }
        if($cat_id != 0 || $cat_id != NULL)
        {
            $this->db->where('tbl_blog_category_id',$cat_id);
        }
        $query=$this->db->get('tbl_blog');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        //print_r($result);exit;
        if ($num_rows > 0) {
            foreach ($result as $key => $value) {
                $this->db->where('tbl_blog_gallery_blog_id',$value->tbl_blog_id);
                $gallery=$this->db->get('tbl_blog_gallery');
                $blog_gallery[$value->tbl_blog_id] = $gallery->result();

            }
        }else{
            $blog_gallery = '';
        }
        
        return array('result' => $result,'blog_gallery' => $blog_gallery);
        //print_r($blog_gallery);exit;
    }

    public function select_blog_id($id) {

        $this->db->join('tbl_basecenter_category','tbl_basecenter_category.tbl_basecenter_category_id = tbl_blog.tbl_blog_category_id','LEFT');
        
        $this->db->join('tbl_basecenter_sub_category','tbl_basecenter_sub_category.tbl_basecenter_sub_category_id = tbl_blog.tbl_blog_subcategory_id','LEFT');

        $this->db->where('tbl_blog_id',$id);
        $query = $this->db->get('tbl_blog');
        $result = $query->result();

        $this->db->where('tbl_blog_gallery_blog_id',$id);
        $gallery = $this->db->get('tbl_blog_gallery');
        $blog_gallery = $gallery->result();

        //print_r($blog_gallery);exit;

        return array('result' => $result,'blog_gallery' => $blog_gallery);
    }

    public function random_blogs($id) {

        $this->db->where('tbl_blog_id',$id);
        $ran = $this->db->get('tbl_blog');
        $result1 = $ran->result();
        //print_r($result1);exit;

        $this->db->join('tbl_basecenter_category','tbl_basecenter_category.tbl_basecenter_category_id = tbl_blog.tbl_blog_category_id','LEFT');
        
        $this->db->join('tbl_basecenter_sub_category','tbl_basecenter_sub_category.tbl_basecenter_sub_category_id = tbl_blog.tbl_blog_subcategory_id','LEFT');

        $this->db->limit(1);
        $this->db->where('tbl_blog_category_id',$result1[0]->tbl_blog_category_id);
        $this->db->where_not_in('tbl_blog_id',$id);
        $query = $this->db->get('tbl_blog');
        $num_rows=$query->num_rows();
        $result = $query->result();

        if ($num_rows > 0) {
            foreach ($result as $key => $value) {
                $this->db->where('tbl_blog_gallery_blog_id',$value->tbl_blog_id);
                $gallery=$this->db->get('tbl_blog_gallery');
                $blog_gallery[$value->tbl_blog_id] = $gallery->result();

            }
        }else {
            $blog_gallery = '';
        }
        
        //print_r($result);exit;
        return array('result' => $result,'blog_gallery' => $blog_gallery);
    }

    function __destruct() {
        $this->db->close();
    }
}
<?php
	
	class Blog_model extends CI_Model {

		var $query;

		public function __construct()
		{
			parent::__construct();

			$this->load->database();
		}

		public function get_articles($ArticleID = FALSE)
		{
			if ($ArticleID === FALSE) 
			{
				$query = $this->db->query("SELECT * FROM lightless_article");
				//$query = $this->db->get('lightless_article');
				return $query->result_array();
			}
			else
			{

				$query = $this->db->query("SELECT * FROM lightless_article WHERE ArticleID = $ArticleID");
				return $query->result_array();
			}
		}

		public function set_articles()
		{
			$this->load->helper('url');
			$this->load->helper('date');

			$t = date("Y-m-d H-i-s",time());

			$artdata = array(
				'ArticleID' => '',
				'ArticleTitle' => $this->input->post('title'),
				'ArticleContent' => $this->input->post('content'),
				'PublishDate' => $t,
				'EditDate' => $t,
				'CommentsNumber' => 0
				);

			$this->db->insert('lightless_article',$artdata);
		}

		public function del_articles($id)
		{
			$this->db->query("DELETE FROM lightless_article WHERE ArticleID=$id");
		}

		public function edit_Article($id)
		{
			$ti = $this->input->post('title');
			$ti = "'".$ti."'";
			$this->db->set('ArticleTitle', $ti,false)
						->where('ArticleID', $id)
						->update('lightless_article');

			$co = $this->input->post('content');
			$co = "'".$co."'";

			$this->db->set('ArticleContent' , $co, false)
						->where('ArticleID', $id)
						->update('lightless_article');
			$t = date("Y-m-d H-i-s", time());
			$t = "'".$t."'";

			$this->db->set('EditDate', $t, false)
						->where('ArticleID', $id)
						->update('lightless_article');

		}

		public function get_ArticleContent($id)
		{
			$query = $this->db->query("SELECT * FROM lightless_article WHERE ArticleID=$id");
			return $query;
		}

		public function get_comments($id = 0)
		{
			$query = $this->db->query("SELECT * FROM lightless_comments WHERE ArticleID=$id");
			if ($query->num_rows > 0) {
				return $query->result_array();
			}
			else return FALSE;
			
		}

		public function set_comment()
		{
			$this->load->helper('url');
			$this->load->helper('date');

			$t = date("Y-m-d H-i-s",time());

			$data = array(
				'CommentID' => '',
				'ArticleID' => $this->input->post('ArticleID'),
				'CommentContent' => $this->input->post('content'),
				'UserEmail' => $this->input->post('email'),
				'PublishDate' => $t,
				'Username' => $this->input->post('name')
				);

			$this->db->insert('lightless_comments', $data);

			$this->db->set('CommentsNumber', 'CommentsNumber+1', false)
							->where('ArticleID', $this->input->post('ArticleID') )
							->update('lightless_article');
		}

		public function get_userinfo($name)
		{
			$query = $this->db->query("SELECT * FROM lightless_user WHERE UserName='$name'");

			return $query;
		}




	}

?>
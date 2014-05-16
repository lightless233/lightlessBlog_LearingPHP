<?php

	class Blog extends CI_Controller {
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('Blog/Blog_model');
			$this->load->helper('url');
			$this->load->helper('form');				// 载入表单辅助函数
			$this->load->library('form_validation');	// 载入表单验证库
			$this->load->library('session');
			//$this->session->set_userdata('username', 'guest');
		}

		public function index()
		{
			//$this->load->library('session');
			$data['articles'] = $this->Blog_model->get_articles();

			$this->load->view('blog/header');
			$this->load->view('blog/index', $data);
			$this->load->view('blog/footer');

		}

		public function showArt($ArtID=FALSE)
		{
			if ($ArtID === FALSE) 
			{
				show_404();
			}
			$ArticlesID = $ArtID;
			$data['articles'] = $this->Blog_model->get_articles($ArticlesID);
			$data['comments'] = $this->Blog_model->get_comments($ArticlesID);

			$this->load->view('blog/header');
			$this->load->view('Blog/showArt', $data);
			$this->load->view('blog/footer');
		}

		public function submitcomment()
		{
			$this->form_validation->set_rules('email','email','required');
			$this->form_validation->set_rules('content', 'content', 'required');
			$this->form_validation->set_rules('name', 'name', 'required');

			if ($this->form_validation->run() === FALSE) 
			{
				$data['success'] = FALSE;
				$data['email'] = $this->input->post('email');
				$data['name'] = $this->input->post('name');
				$data['content'] = $this->input->post('content');

				$this->load->view('blog/header');
				$this->load->view('blog/submitcomment', $data);
				$this->load->view('blog/footer');
			}
			else 
			{
				$data['success'] = TRUE;
				$data['email'] = $this->input->post('email');
				$data['name'] = $this->input->post('name');
				$data['content'] = $this->input->post('content');

				$this->Blog_model->set_comment();

				$this->load->view('blog/header');
				$this->load->view('blog/submitcomment', $data);
				$this->load->view('blog/footer');			
			}

		}

		public function admin()
		{
			$this->load->view('blog/header');
			$this->load->view('blog/admin');
			$this->load->view('blog/footer');
		}

		public function admin_login()
		{

			$this->form_validation->set_rules('username', 'username', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');

			

			if ($this->form_validation->run() === FALSE) 
			{
				$data['success'] = FALSE;
				$data['articles'] = $this->Blog_model->get_articles();
				echo "<script>alert('Empty username/password');</script>";
				header("location:/ci/blog/admin");
			}
			else
			{
				$query = $this->Blog_model->get_userinfo($this->input->post('username'));
				// print_r($query->result());
				// echo $this->input->post('username');
				// echo md5($this->input->post('password'));
				if ($query->num_rows() == 0) 
				{
					$data['success'] = FALSE;
					$data['articles'] = $this->Blog_model->get_articles();
					echo "<script>alert('Wrong username/password');</script>";
					header("location:/ci/blog/admin");
				}
				else
				{
					$row = $query->result_array();
					//echo $row[0]['UserName'];
					if ($row[0]['UserName'] === $this->input->post('username') AND $row[0]['Password'] === md5($this->input->post('password')) ) 
					{
						echo "right";
						$this->session->set_userdata('username', 'lightless');
						$data['success'] = TRUE;
						$data['articles'] = $this->Blog_model->get_articles();
						header("location:/ci/blog");
					}
					else
					{
						$data['success'] = FALSE;
						$data['articles'] = $this->Blog_model->get_articles();
						echo "<script>alert('Wrong username/password');</script>";
						header("location:/ci/blog/admin");
					}
				}
			}
		}

		public function logout()
		{
			$this->session->sess_destroy();
			//$this->session->set_userdata('username', '');
			header("location:/ci/blog");
		}

		public function create()
		{
			$this->load->view('blog/header');
			$this->load->view('blog/createArt');
			$this->load->view('blog/footer');
		}

		public function submitArt()
		{
			$this->form_validation->set_rules('title', 'title', 'required');

			if ($this->form_validation->run() === FALSE) 
			{
				exit(1);
			}
			else
			{
				$u = base_url('blog');
				$this->Blog_model->set_articles();
				echo "Success!<br><a href=$u>Click me to return</a>";
			}

		}

		public function delete($id)	// $id: ArticleID
		{	
			$u = base_url('blog');
			$this->Blog_model->del_articles($id);
			echo "Success!<br><a href=$u>Click me to return</a>";
		}

		public function edit($id)
		{
			$data['id'] = $id;
			$query = $this->Blog_model->get_ArticleContent($id);
			$data['editinfo'] = $query->result_array();

			$this->load->view('blog/header');
			$this->load->view('blog/editArt', $data);
			$this->load->view('blog/footer');
		}

		public function submiteditArt($id)
		{
			$this->Blog_model->edit_Article($id);
			$u = base_url('blog');
			echo "Success!<br><a href=$u>Click me to return</a>";
		}


	}
?>
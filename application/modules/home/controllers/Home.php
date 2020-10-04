<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('migration_home', 'home');
    }

	public function index()
	{
        $config = array();
        $config['base_url'] = base_url('/home/index/');
        $config['total_rows'] = $this->home->count_all_books();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config["full_tag_open"] = '<ul class="pagination pagination-sm no-margin pull-left">';
        $config["full_tag_close"] = '</ul>';	
        $config["first_link"] = "&laquo;";
        $config["first_tag_open"] = "<li>";
        $config["first_tag_close"] = "</li>";
        $config["last_link"] = "&raquo;";
        $config["last_tag_open"] = "<li>";
        $config["last_tag_close"] = "</li>";
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '<li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '<li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ( $this->uri->segment(3) ) ? $this->uri->segment(3) : 0;

        $data['books'] = $this->home->books_lists_by_page($config["per_page"], $page);

        $data['links'] = $this->pagination->create_links();

        $data['title'] = "Book Catalog";
        $data['module'] = "Home"; 
        
        $this->load->view('includes/_head');
        $this->load->view('home_index', $data);
        $this->load->view('includes/_footer');
		
    }
    
    public function add_book()
    {
        $this->form_validation->set_rules('input_title', 'Title', 'required');
        $this->form_validation->set_rules('input_isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('input_author', 'Author', 'required');
        $this->form_validation->set_rules('input_publisher', 'Publisher', 'required');
        $this->form_validation->set_rules('input_year_published', 'Year Published', 'required|numeric');
        $this->form_validation->set_rules('input_category', 'Category', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $book = array(
                'title' => trim($this->input->post('input_title')),
                'isbn' => trim($this->input->post('input_isbn')),
                'author' => trim($this->input->post('input_author')),
                'publisher' => trim($this->input->post('input_publisher')),
                'year_published' => trim($this->input->post('input_year_published')),
                'category' => trim($this->input->post('input_category')),
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            );

            $this->home->addBook($book);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Book Added!';
        }
	    echo json_encode($data);
    }

    public function browse_book()
    {
        $this->form_validation->set_rules('bookID', 'Book ID', 'required|numeric');
        $this->form_validation->set_rules('bookAction', 'Book Action', 'required');

        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $data['browsedBook'] = $this->home->browse_book(trim($this->input->post('bookID')));
            $data['response'] = 'true';
            $data['message'] = 'Browse Book Successful';

            if(trim($this->input->post('bookAction')) == 'edit'){
                $this->load->view('modal/book_edit', $data);
            } elseif(trim($this->input->post('bookAction')) == 'delete'){
                $this->load->view('modal/book_delete', $data);
            }
        }
    }

    public function edit_book()
    {
        $this->form_validation->set_rules('hidden_id', 'ID', 'required');
        $this->form_validation->set_rules('input_title', 'Title', 'required');
        $this->form_validation->set_rules('input_isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('input_author', 'Author', 'required');
        $this->form_validation->set_rules('input_publisher', 'Publisher', 'required');
        $this->form_validation->set_rules('input_year_published', 'Year Published', 'required|numeric');
        $this->form_validation->set_rules('input_category', 'Category', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $book = array(
                'id' => trim($this->input->post('hidden_id')),
                'title' => trim($this->input->post('input_title')),
                'isbn' => trim($this->input->post('input_isbn')),
                'author' => trim($this->input->post('input_author')),
                'publisher' => trim($this->input->post('input_publisher')),
                'year_published' => trim($this->input->post('input_year_published')),
                'category' => trim($this->input->post('input_category')),
                'updated_at' => date('Y-m-d h:i:s'),
            );

            $this->home->edit_book($book);
	        
	        $data['response'] = "true";
	        $data['message'] = 'Book Edited!';
        }
	    echo json_encode($data);
    }

    public function delete_book()
    {
        $this->form_validation->set_rules('bookID', 'Book ID', 'required|numeric');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            $this->home->delete_book(trim($this->input->post('bookID')));
            $data['response'] = 'true';
            $data['message'] = 'Book Deleted!';
        }
        echo json_encode($data);
    }

    public function search_book()
    {
        $this->form_validation->set_rules('searchItem', 'Searched Item', 'trim|required');
        if ($this->form_validation->run() == FALSE){
            $data['response'] = "false";
            $data['message'] = validation_errors();
        } else {
            if( trim($this->input->post('searchItem')) > 0 || !empty(trim($this->input->post('searchItem')))) {
                $data['books'] = $this->home->search_books(trim($this->input->post('searchItem')));
                $data['response'] = 'true';
                $data['message'] = 'Browse book Successful';
                $this->load->view('_searched_books', $data);
            } else {
                $data['response'] = 'false';
                $data['message'] = 'Book does not exist.';
            }
        }
    }

}
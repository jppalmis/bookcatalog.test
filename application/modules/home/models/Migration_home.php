<?php
class Migration_home extends CI_Model {

    public $db;
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }
    
    function addBook($data)
    {
        $this->db->insert('tbl_books_info', $data);
    }

    function count_all_books() 
    {
        return $this->db->count_all("tbl_books_info");
    }

    function books_lists_by_page($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $this->db->order_by("tbi.id", "desc");
        $query = $this->db->get("tbl_books_info as tbi");

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    function browse_book($bookID)
    {
        $query = $this->db->get_where('tbl_books_info', array(
            'id' => $bookID,
        ));
        return $query->row_array();
    }

    function edit_book($data)
    {
        $data = array(
            'id' => $data['id'],
            'title' => $data['title'],
            'isbn' => $data['isbn'],
            'author' => $data['author'],
            'publisher' => $data['publisher'],
            'year_published' => $data['year_published'],
            'category' => $data['category'],
            'updated_at' => $data['updated_at'],
        );
    
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_books_info', $data);
    }

    function delete_book($bookID)
    {
        $this->db->where('id', $bookID);
        $this->db->delete('tbl_books_info');
    }

    function search_books($data)
    {
        $this->db->like('id', $data); 
        $this->db->or_like('title', $data);
        $this->db->or_like('isbn', $data);
        $this->db->or_like('author', $data);
        $this->db->or_like('publisher', $data);
        $this->db->or_like('year_published', $data);
        $this->db->or_like('category', $data);
        $this->db->or_like('created_at', $data);
        $this->db->or_like('updated_at', $data);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where('tbl_books_info');
        return $query->result_array();
    }
}
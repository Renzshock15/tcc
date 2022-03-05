<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function postNow($nameId, $name, $title, $post)
    {
        $this->db->query("INSERT INTO grading_post (name_id, post_name, pos_title, feeds)
                        VALUES(:nameId, :name, :title, :post)");
        $this->db->bind(':nameId', $nameId);
        $this->db->bind(':name', $name);
        $this->db->bind(':title', $title);
        $this->db->bind(':post', $post);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllPost()
    {
        $this->db->query("SELECT * FROM grading_post ORDER BY post_id DESC");
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function deletePost($id)
    {
        $this->db->query("DELETE FROM grading_post WHERE post_id = :id");
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

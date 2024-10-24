<?php
class Post
{
    private $db;
    public function __construct()
    {

        $this->db = new Database;
    }

    // Get all post
    public function getPosts()
    {
        $this->db->query('SELECT *,
                        posts.id AS postId,
                        users.id AS userId,
                        posts.createdAt AS created_at
                        FROM posts
                        INNER JOIN users
                        ON posts.userId = users.id
                        ORDER BY posts.createdAt DESC;
                        ');
        $resultPosts = $this->db->resultSet();

        return $resultPosts;
    }

    // Add Post
    public function addPost($data)
    {
        $this->db->query('INSERT INTO posts (title, body, userId) VALUES(:title, :body, :userId)');
        $this->db->bind(":title", $data['postTitle']);
        $this->db->bind(":body", $data['body']);
        $this->db->bind(":userId", $_SESSION['user_id']);

        // Execute
        if ($this->db->executePrepareStmt()) {
            return true;
        } else {
            return false;
        }
    }

    // Get Post By Id
    public function getPostById($id)
    {
        $this->db->query('SELECT * FROM posts where id=:id');
        $this->db->bind(':id', $id);

        $resultPosts = $this->db->singleResult();

        return $resultPosts;
    }

    // Edit Post
    public function editPost($data)
    {
        $this->db->query('UPDATE posts SET title =:title, body=:body WHERE id=:id');
        $this->db->bind(":title", $data['postTitle']);
        $this->db->bind(":body", $data['body']);
        $this->db->bind(":id", $data['id']);

        // Execute
        if ($this->db->executePrepareStmt()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete Post
    public function deletePostById($id)
    {

        $this->db->query('DELETE FROM posts WHERE id = :id');


        $this->db->bind(":id", $id);

        return $this->db->executePrepareStmt() ? true : false;
    }
}

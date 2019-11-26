<?php

class Post
{
    //DB stuff
    private $conn;
    private $table = 'post';
    //Post proterties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    //Constructor

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get Post
    public function read()
    {
        //Create querry
        $query =
            'SELECT 
                c.name as category_name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.created_at
            FROM 
                ' . $this->table . ' p
            LEFT JOIN
                category c ON p.category_id = c.id
            ORDER BY
                p.created_at DESC
                ';
        $stmt = $this->conn->prepare($query);

        //Execute
        if ($stmt->execute()) {
            http_response_code(200);
        } else {
            //print error
            http_response_code(400);
            die();
        }
        return $stmt;
    }

    // Get single post

    public function read_single()
    {
        //Create querry
        $query =
            'SELECT 
              c.name as category_name,
              p.id,
              p.category_id,
              p.title,
              p.body,
              p.author,
              p.created_at
          FROM 
              ' . $this->table . ' p
          LEFT JOIN
              category c ON p.category_id = c.id
          WHERE
            p.id = ?
          Limit 0,1';

        $stmt = $this->conn->prepare($query);

        //Bind ID

        $stmt->bindParam(1, $this->id);

        //Execute
        if ($stmt->execute()) {
            http_response_code(200);
        } else {
            //print error
            http_response_code(400);
            die();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //Set properties
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }
    //Create Post

    public function create()
    {
        //Create query
        $query =
            'INSERT INTO ' . $this->table . '
            SET
                title = :title,
                body = :body,
                author = :author,
                category_id = :category_id';
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);


        if ($stmt->execute()) {
            http_response_code(200);
            return true;
        } else {
            //print error
            http_response_code(400);
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }

    public function update()
    {
        //Create query
        $query =
            'UPDATE ' . $this->table . '
            SET
                title = :title,
                body = :body,
                author = :author,
                category_id = :category_id
            WHERE
                id=:id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            http_response_code(200);
            return true;
        } else {
            //print error
            http_response_code(400);
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }
    public function Delete()
    {
        $query = '
        DELETE FROM ' . $this->table . ' WHERE id = :id';

        //Prepare statement
        $stmt = $this->conn->prepare($query);
        //Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        //Bind data
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            http_response_code(200);
            return true;
        } else {
            //print error
            http_response_code(400);
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }
}

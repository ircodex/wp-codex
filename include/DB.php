<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DB
 *
 * @author hamed
 */
class DB {
    
    private $dbh;
    
    public function __construct($database){
        try{
            include 'config.php';
            $this->dbh = new PDO('mysql:host=' . $database['host'] . ';dbname=' . $database['dbname'] . ';charset=' . $database['charset'], $database['username'], $database['password']);
        } catch (Exception $ex) {
            die('Connection to database error...');
        }
    }
    
    public function getPostList($start = 0,$limit = 10,$type = '', $since = '', $search = ''){
        $type = ($type == 'all') ? '' : $type;
        $query = 'SELECT id, title, type, description FROM post WHERE title LIKE \'%' . $search. '%\' AND change_log LIKE \'%' . $since. '%\' AND type LIKE \'%'. $type .'%\' ORDER BY title ASC LIMIT '. $start .',' . $limit;
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getPostCount($start = 0,$limit = 10,$type = '', $since = '', $search = ''){
        $type = ($type == 'all') ? '' : $type;
        $query = 'SELECT COUNT(*) as total FROM post WHERE title LIKE \'%' . $search. '%\' AND change_log LIKE \'%' . $since. '%\' AND type LIKE \'%'. $type .'%\'';
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    
    public function getParameters($post_id){
        $query = 'SELECT * FROM parameter WHERE post_id = :post_id';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getClassMethods($post_id){
        $query = 'SELECT method_id FROM method_relation WHERE class_id = :class_id';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':class_id', $post_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getMethodById($post_id){
        $query = 'SELECT title, description FROM post WHERE id = :id LIMIT 1';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':id', $post_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function classHasMethod($post_id){
        $query = 'SELECT COUNT(*) as total FROM method_relation WHERE class_id = :class_id';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':class_id', $post_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] > 0 ? true : false;
    }
    
    public function getPost($id){
        $query = 'SELECT post.*, file.address FROM post INNER JOIN file ON post.source_file = file.id  WHERE post.id = :id LIMIT 1';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function addAddress($address){
        $query = 'INSERT INTO file (address) VALUES(:address)';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        return $stmt->execute() ? $this->dbh->lastInsertId() : 0;
    }
    
    public function getFileAddressId($address){
        $query = 'SELECT id FROM file WHERE address LIKE :address';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(':address', '%' . $address . '%', PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }
    
    public function getUseFileList($post_id, $type){
        $query = 'SELECT DISTINCT(file.id) as file_id, file.address FROM file INNER JOIN use_tbl ON use_tbl.source_file = file.id WHERE use_tbl.post_id = :post_id AND use_tbl.type = :type';
        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
}

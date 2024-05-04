<?php

require("../configs/Database.php");
$db = new Database();

class InstructorModel {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function validateInstructor($instructorNo, $email) {
        $query = "SELECT COUNT(*) FROM tbl_instructors  WHERE instructor_no = :instructorNo AND email = :email";
        $params = [
            ':instructorNo' => $instructorNo,
            ':email' => $email
        ];
    
        
        $result =  $this->db->executeQuery($query, $params);

        return $result;
    }

    
}
<?php
require_once 'BaseDao.php';

class UserDao extends BaseDao {
    public function __construct() {
        parent::__construct("user");
    }

    // Get user by email
    public function getByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Get user by ID
    public function getById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Create a new user
    public function create($username, $password, $email) {
        $stmt = $this->connection->prepare("
            INSERT INTO user (username, password, email) 
            VALUES (:username, :password, :email)
        ");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password); // hashing
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $this->connection->lastInsertId();
    }

    // Update user details (excluding password)
    public function update($id, $username, $email) {
        $stmt = $this->connection->prepare("
            UPDATE user 
            SET username = :username, email = :email 
            WHERE id = :id
        ");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Update user password
    public function updatePassword($id, $password) {
        $stmt = $this->connection->prepare("
            UPDATE user SET password = :password WHERE id = :id
        ");
        $stmt->bindParam(':password', $password); // hashing
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Delete a user
    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Set user's personality type (quiz result)
    public function setPersonalityType($id, $personality_type_id) {
        $stmt = $this->connection->prepare("
            UPDATE user SET personality_type_id = :personality_type_id WHERE id = :id
        ");
        $stmt->bindParam(':personality_type_id', $personality_type_id);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Set user's review ID
    public function setReviewId($id, $review_id) {
        $stmt = $this->connection->prepare("
            UPDATE user SET review_id = :review_id WHERE id = :id
        ");
        $stmt->bindParam(':review_id', $review_id);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>

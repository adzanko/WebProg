<?php
require_once 'BaseDao.php';

class UserDao extends BaseDao {
    public function __construct() {
        parent::__construct("user");
    }

    // Get user by email
    public function get_by_email($email) {
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Get user by ID
    public function get_by_id($id) {
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create_user($user)
    {
        return $this->insert($user);
    }
  
    public function update_user($id, $user)
    {
        return $this->update($id, $user);
    }

    // Update user password
    public function update_user_password($id, $password) {
        $stmt = $this->connection->prepare("
            UPDATE user SET password = :password WHERE id = :id
        ");
        $stmt->bindParam(':password', $password); // hashing
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Delete a user
    public function delete_user($id) {
        $stmt = $this->connection->prepare("DELETE FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Set user's personality type (quiz result)
    public function set_personality_type($id, $personality_type_id) {
        $stmt = $this->connection->prepare("
            UPDATE user SET personality_type_id = :personality_type_id WHERE id = :id
        ");
        $stmt->bindParam(':personality_type_id', $personality_type_id);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Set user's review ID
    public function set_review_id($id, $review_id) {
        $stmt = $this->connection->prepare("
            UPDATE user SET review_id = :review_id WHERE id = :id
        ");
        $stmt->bindParam(':review_id', $review_id);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>

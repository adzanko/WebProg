<?php
require_once 'BaseDao.php';

class UserQuestionDao extends BaseDao {
    public function __construct() {
        parent::__construct("userquestions");
    }

    public function getByUserId($user_id) {
        $stmt = $this->connection->prepare("
            SELECT uq.*, q.question 
            FROM userquestions uq
            JOIN questions q ON uq.question_id = q.id
            WHERE uq.user_id = :user_id
        ");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByQuestionId($question_id) {
        $stmt = $this->connection->prepare("
            SELECT uq.*, u.username 
            FROM userquestions uq
            JOIN user u ON uq.user_id = u.id
            WHERE uq.question_id = :question_id
        ");
        $stmt->bindParam(':question_id', $question_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($user_id, $question_id, $answer) {
        $stmt = $this->connection->prepare("
            INSERT INTO userquestions (user_id, question_id, answer) 
            VALUES (:user_id, :question_id, :answer)
        ");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':question_id', $question_id);
        $stmt->bindParam(':answer', $answer);
        $stmt->execute();
        return $this->connection->lastInsertId();
    }

    public function update($id, $answer) {
        $stmt = $this->connection->prepare("
            UPDATE userquestions SET answer = :answer WHERE id = :id
        ");
        $stmt->bindParam(':answer', $answer);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM userquestions WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
<?php
require_once 'BaseDao.php';

class QuestionDao extends BaseDao {
    public function __construct() {
        parent::__construct("questions");
    }

    public function getAllQuestions() {
        $stmt = $this->connection->prepare("SELECT * FROM questions");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM questions WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($question) {
        $stmt = $this->connection->prepare("INSERT INTO questions (question) VALUES (:question)");
        $stmt->bindParam(':question', $question);
        $stmt->execute();
        return $this->connection->lastInsertId();
    }

    public function update($id, $question) {
        $stmt = $this->connection->prepare("UPDATE questions SET question = :question WHERE id = :id");
        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM questions WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>

<?php
require_once 'BaseDao.php';

class UserQuestionDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("userquestions");
    }

    public function get_by_user_id($user_id)
    {
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

    public function get_by_question_id($question_id)
    {
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

    public function create_user_question($data)
    {
        return $this->insert($data);
    }

    public function update_user_question($id, $data)
    {
        return $this->update($id, $data);
    }

    public function delete_user_question($id)
    {
        return $this->delete($id);
    }
}
?>
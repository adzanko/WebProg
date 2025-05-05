<?php
require_once 'BaseDao.php';

class QuestionDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("questions");
    }

    public function get_all_questions()
    {
        $stmt = $this->connection->prepare("SELECT * FROM questions");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get_by_id($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM questions WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create_question($question)
    {
        return $this->insert($question);
    }

    public function update_question($id, $question)
    {
        return $this->update($id, $question);
    }

    public function delete_question($id)
    {
        return $this->delete($id);
    }
}
?>
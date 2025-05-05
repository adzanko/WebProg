<?php
require_once "BaseService.php";
require_once __DIR__ . "/../dao/QuestionDao.php";
class QuestionService extends BaseService
{
    public function __construct()
    {
        $this->dao = new QuestionDao();
    }
    public function getQuestionById($qId)
    {
        $question = $this->dao->get_by_id($qId);
        if (!$question) {
            throw new Exception("Question not found");
        }
        return $question;
    }

    public function getAllQuestions()
    {
        $questionList = $this->dao->get_all_questions();

        return $questionList;
    }

    public function createQuestion($data)
    {

        if (empty($data['question'])) {
            throw new Exception("Question field cannot be empty");
        }

        $new_question = [
            "question" => $data["question"],
        ];

        $this->dao->create_question($new_question);
    }
    public function deleteQuestion($id)
    {
        $user = $this->dao->get_by_id($id);
        if (!$user)
            throw new Exception("Question not found");
        $this->dao->delete_question($id);

    }
    public function updateQuestion($id, $data)
    {
        $question = $this->dao->get_by_id($id);

        if (!$question)
            throw new Exception("Question not found");
        if (isset($data['question']) && empty($data["question"])) {
            throw new Exception("Question field cannot be empty!");
        }

        $this->dao->update_question($id, $data);
    }
}
?>
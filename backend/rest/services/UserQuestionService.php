<?php
require_once "BaseService.php";
require_once __DIR__ . "/../dao/UserQuestionDao.php";
class UserQuestionService extends BaseService
{
    public function __construct()
    {
        $this->dao = new UserQuestionDao();
    }
    public function getUserQuestionByUserId($id)
    {
        $userQuestion = $this->dao->get_by_user_id($id);
        if (!$userQuestion) {
            throw new Exception("User question not found");
        }
        return $userQuestion;
    }
    public function getUserQuestionByQuestionId($id)
    {
        $userQuestion = $this->dao->get_by_question_id($id);
        if (!$userQuestion) {
            throw new Exception("User question not found");
        }
        return $userQuestion;
    }
    public function createUserQuestion($data)
    {
        if (empty($data['user_id'])) {
            throw new Exception("User id is required.");
        }

        if (empty($data['question_id'])) {
            throw new Exception("Question id is required.");
        }

        if (empty($data["answer"])) {
            throw new Exception("Answer is required.");
        }

        $new_user_question = [
            "user_id" => $data["user_id"],
            "question_id" => $data["question_id"],
            "answer" => $data["answer"]
        ];

        $this->dao->create_user_question($new_user_question);
    }
    public function deleteUserQuestion($id)
    {
        $user = $this->dao->get_by_id($id);
        if (!$user)
            throw new Exception("User question not found");
        $this->dao->delete_user_question($id);

    }
    public function updateUserQuestion($id, $data)
    {
        $user = $this->dao->get_by_id($id);
        if (!$user)
            throw new Exception("User question not found");
        if (isset($data["user_id"]) && empty($data["user_id"])) {
            throw new Exception("User id cannot be empty!");
        }

        if (isset($data["question_id"]) && empty($data["question_id"])) {
            throw new Exception("Question id cannot be empty!");
        }

        if (isset($data["answer"]) && empty($data["answer"])) {
            throw new Exception("Answer cannot be empty!");
        }

        $this->dao->update_user_question($id, $data);
    }
}
?>
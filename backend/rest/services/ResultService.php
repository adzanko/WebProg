<?php
require_once "BaseService.php";
require_once __DIR__ . "/../dao/ResultDao.php";
class ResultService extends BaseService
{
    public function __construct()
    {
        $this->dao = new ResultDao();
    }
    public function getResultById($resultId)
    {
        $result = $this->dao->get_by_id($resultId);
        if (!$result) {
            throw new Exception("Result not found");
        }
        return $result;
    }
    public function createResult($data)
    {
        if (empty($data['personality_type'])) {
            throw new Exception("Personality type field cannot be empty");
        }

        $new_result = [
            "personality_type" => $data["personality_type"]
        ];

        $this->dao->create_result($new_result);
    }
    public function deleteResult($id)
    {
        $result = $this->dao->get_by_id($id);
        if (!$result)
            throw new Exception("Result not found");
        $this->dao->delete_result($id);

    }
    public function updateResult($id, $data)
    {
        $result = $this->dao->get_by_id($id);
        if (!$result)
            throw new Exception("Result not found");

        if (isset($data["personality_type"]) && empty($data["personality_type"])) {
            throw new Exception("Personality type field cannot be empty!");
        }

        $this->dao->update_result($id, $data);
    }
}
?>
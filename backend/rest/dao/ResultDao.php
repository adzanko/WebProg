<?php
require_once 'BaseDao.php';

class ResultDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("result");
    }

    public function get_by_id($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM result WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create_result($personality_type)
    {
        return $this->insert($personality_type);
    }

    public function update_result($id, $personality_type)
    {
        return $this->update($id, $personality_type);
    }

    public function delete_result($id)
    {
        return $this->delete($id);
    }
}
?>
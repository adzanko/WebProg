<?php
require_once 'BaseDao.php';

class ReviewDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("reviews");
    }

    public function get_by_id($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM reviews WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create_review($review)
    {
        return $this->insert($review);
    }

    public function update_review($id, $review)
    {
        return $this->update($id, $review);
    }

    public function delete_review($id)
    {
        return $this->delete($id);
    }
}
?>
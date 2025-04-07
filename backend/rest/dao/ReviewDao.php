<?php
require_once 'BaseDao.php';

class ReviewDao extends BaseDao {
    public function __construct() {
        parent::__construct("reviews");
    }

    public function getById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM reviews WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($review) {
        $stmt = $this->connection->prepare("INSERT INTO reviews (review) VALUES (:review)");
        $stmt->bindParam(':review', $review);
        $stmt->execute();
        return $this->connection->lastInsertId();
    }

    public function update($id, $review) {
        $stmt = $this->connection->prepare("UPDATE reviews SET review = :review WHERE id = :id");
        $stmt->bindParam(':review', $review);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM reviews WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>

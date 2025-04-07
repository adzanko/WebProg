<?php
require_once 'BaseDao.php';

class ResultDao extends BaseDao {
    public function __construct() {
        parent::__construct("result");
    }

    public function getById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM result WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($personality_type) {
        $stmt = $this->connection->prepare("INSERT INTO result (personality_type) VALUES (:personality_type)");
        $stmt->bindParam(':personality_type', $personality_type);
        $stmt->execute();
        return $this->connection->lastInsertId();
    }

    public function update($id, $personality_type) {
        $stmt = $this->connection->prepare("UPDATE result SET personality_type = :personality_type WHERE id = :id");
        $stmt->bindParam(':personality_type', $personality_type);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM result WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>

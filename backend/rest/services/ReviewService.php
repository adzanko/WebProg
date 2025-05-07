<?php
require_once "BaseService.php";
require_once __DIR__ . "/../dao/ReviewDao.php";
class ReviewService extends BaseService
{
    public function __construct()
    {
        $this->dao = new ReviewDao();
    }
    public function getReviewById($reviewId)
    {
        $review = $this->dao->get_by_id($reviewId);
        if (!$review) {
            throw new Exception("Review not found");
        }
        return $review;
    }
    public function createReview($data)
    {
        if (empty($data['review'])) {
            throw new Exception("Review field cannot be empty");
        }

        $new_review = [
            "review" => $data["review"]
        ];

        $this->dao->create_review($new_review);
    }
    public function deleteReview($id)
    {
        $review = $this->dao->get_by_id($id);
        if (!$review)
            throw new Exception("Review not found");
        $this->dao->delete_review($id);

    }
    public function updateReview($id, $data)
    {
        $review = $this->dao->get_by_id($id);
        if (!$review)
            throw new Exception("Review not found");

        if (isset($data["review"]) && empty($data["review"])) {
            throw new Exception("Review field cannot be empty!");
        }

        $this->dao->update_review($id, $data);
    }
}
?>
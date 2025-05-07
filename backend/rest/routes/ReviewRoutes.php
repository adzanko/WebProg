<?php
/**
 * @OA\Get(
 *     path="/reviews/{id}",
 *     tags={"reviews"},
 *     summary="Get a review by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the review",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the review"
 *     )
 * )
 */
Flight::route("GET /reviews/@id", function ($id) {
    $movie = Flight::review_service()->getReviewById($id);
    Flight::json($movie);
});

/**
 * @OA\Post(
 *     path="/reviews",
 *     tags={"reviews"},
 *     summary="Create a new review",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"movie_id", "user_id", "rating", "comment"},
 *             @OA\Property(property="movie_id", type="integer", example=4),
 *             @OA\Property(property="user_id", type="integer", example=7),
 *             @OA\Property(property="rating", type="number", format="float", example=4.5),
 *             @OA\Property(property="comment", type="string", example="Amazing movie!")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Review created successfully"
 *     )
 * )
 */

Flight::route("POST /reviews", function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::review_service()->createReview($data));
});

/**
 * @OA\Patch(
 *     path="/reviews/{id}",
 *     tags={"reviews"},
 *     summary="Update a review by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the review to update",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=false,
 *         @OA\JsonContent(
 *             @OA\Property(property="rating", type="number", format="float", example=4.0),
 *             @OA\Property(property="comment", type="string", example="Updated comment")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Review updated successfully"
 *     )
 * )
 */
Flight::route("PATCH /reviews/@id", function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::review_service()->updateReview($id, $data));
});

/**
 * @OA\Delete(
 *     path="/reviews/{id}",
 *     tags={"reviews"},
 *     summary="Delete a review by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the review to delete",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Review deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /reviews/@id', function ($id) {
    Flight::json(Flight::review_service()->deleteReview($id));
});
?>
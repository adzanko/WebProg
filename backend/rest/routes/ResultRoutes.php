<?php
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/results/{id}",
 *     tags={"results"},
 *     summary="Get a result by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the result",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the result"
 *     )
 * )
 */
Flight::route("GET /results/@id", function ($id) {
    $result = Flight::result_service()->getResultById($id);
    Flight::json($result);
});

/**
 * @OA\Post(
 *     path="/results",
 *     tags={"results"},
 *     summary="Create a new result",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "score", "quiz_id"},
 *             @OA\Property(property="user_id", type="integer", example=2),
 *             @OA\Property(property="quiz_id", type="integer", example=5),
 *             @OA\Property(property="score", type="number", format="float", example=87.5)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Result created successfully"
 *     )
 * )
 */
Flight::route("POST /results", function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::result_service()->createResult($data));
});

/**
 * @OA\Patch(
 *     path="/results/{id}",
 *     tags={"results"},
 *     summary="Update a result by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the result to update",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=false,
 *         @OA\JsonContent(
 *             @OA\Property(property="score", type="number", format="float", example=92.0)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Result updated successfully"
 *     )
 * )
 */
Flight::route("PATCH /results/@id", function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::result_service()->updateResult($id, $data));
});

/**
 * @OA\Delete(
 *     path="/results/{id}",
 *     tags={"results"},
 *     summary="Delete a result by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the result to delete",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Result deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /results/@id', function ($id) {
    Flight::json(Flight::result_service()->deleteResult($id));
});
?>
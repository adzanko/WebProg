<?php
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/user-questions/user/{id}",
 *     tags={"user-questions"},
 *     summary="Get a user-question by user ID",
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         description="ID of the user-question record",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the user-question record"
 *     )
 * )
 */
Flight::route("GET /user-questions/user/@id", function ($id) {
    $question = Flight::user_question_service()->getUserQuestionByUserId($id);
    Flight::json($question);
});

/**
 * @OA\Get(
 *     path="/user-questions/questions/{id}",
 *     tags={"user-questions"},
 *     summary="Get user-question(s) by question ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the question",
 *         @OA\Schema(type="integer", example=10)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns user-question records for the given question ID"
 *     )
 * )
 */
Flight::route("GET /user-questions/questions/@id", function ($id) {
    $question = Flight::user_question_service()->getUserQuestionByQuestionId($id);
    Flight::json($question);
});

/**
 * @OA\Post(
 *     path="/user-questions",
 *     tags={"user-questions"},
 *     summary="Create a user-question record",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "question_id", "answer"},
 *             @OA\Property(property="user_id", type="integer", example=2),
 *             @OA\Property(property="question_id", type="integer", example=5),
 *             @OA\Property(property="answer", type="string", example="B")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User-question record created successfully"
 *     )
 * )
 */
Flight::route("POST /user-questions", function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::user_question_service()->createUserQuestion($data));
});

/**
 * @OA\Patch(
 *     path="/user-questions/{id}",
 *     tags={"user-questions"},
 *     summary="Update a user-question record by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user-question record to update",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=false,
 *         @OA\JsonContent(
 *             @OA\Property(property="answer", type="string", example="C")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User-question record updated successfully"
 *     )
 * )
 */
Flight::route("PATCH /user-questions/@id", function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::user_question_service()->updateUserQuestion($id, $data));
});

/**
 * @OA\Delete(
 *     path="/user-questions/{id}",
 *     tags={"user-questions"},
 *     summary="Delete a user-question record by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user-question record to delete",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User-question record deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /user-questions/@id', function ($id) {
    Flight::json(Flight::user_question_service()->deleteUserQuestion($id));
});
?>
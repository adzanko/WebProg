<?php
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/questions/{id}",
 *     tags={"questions"},
 *     summary="Get a question by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the question",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the question"
 *     )
 * )
 */
Flight::route("GET /questions/@id", function ($id) {
    $question = Flight::question_service()->getQuestionById($id);
    Flight::json($question);
});

/**
 * @OA\Get(
 *     path="/questions",
 *     tags={"questions"},
 *     summary="Get all questions",
 *     @OA\Response(
 *         response=200,
 *         description="Returns a list of all questions"
 *     )
 * )
 */
Flight::route("GET /questions", function () {
    $questions = Flight::question_service()->getAllQuestions();
    Flight::json($questions);
});

/**
 * @OA\Post(
 *     path="/questions",
 *     tags={"questions"},
 *     summary="Create a new question",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "content", "user_id"},
 *             @OA\Property(property="title", type="string", example="What is OpenAPI?"),
 *             @OA\Property(property="content", type="string", example="I want to understand how OpenAPI annotations work."),
 *             @OA\Property(property="user_id", type="integer", example=2)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Question created successfully"
 *     )
 * )
 */
Flight::route("POST /questions", function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::question_service()->createQuestion($data));
});

/**
 * @OA\Patch(
 *     path="/questions/{id}",
 *     tags={"questions"},
 *     summary="Update a question by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the question to update",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=false,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string", example="Updated question title"),
 *             @OA\Property(property="content", type="string", example="Updated content")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Question updated successfully"
 *     )
 * )
 */
Flight::route("PATCH /questions/@id", function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::question_service()->updateQuestion($id, $data));
});

/**
 * @OA\Delete(
 *     path="/questions/{id}",
 *     tags={"questions"},
 *     summary="Delete a question by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the question to delete",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Question deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /questions/@id', function ($id) {
    Flight::json(Flight::question_service()->deleteQuestion($id));
});
?>
<!-- <?php
    require 'vendor/autoload.php';
    Flight::start();
?> -->

<?php
require 'vendor/autoload.php';
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/QuestionService.php';
require_once __DIR__ . '/services/ResultService.php';
require_once __DIR__ . '/services/ReviewService.php';
require_once __DIR__ . '/services/UserQuestionService.php';

Flight::register('user_service', 'UserService');
Flight::register('question_service', 'QuestionService');
Flight::register('result_service', 'ResultService');
Flight::register('review_service', 'ReviewService');
Flight::register('user_question_service', 'UserQuestionService');

require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/QuestionRoutes.php';
require_once __DIR__ . '/routes/ResultRoutes.php';
require_once __DIR__ . '/routes/ReviewRoutes.php';
require_once __DIR__ . '/routes/UserQuestionRoutes.php';

Flight::start();
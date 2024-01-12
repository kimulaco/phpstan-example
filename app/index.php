<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

use \App\Domain\Diary as DiaryDomain;

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();

$page_renderer = new PhpRenderer('view/page/');

$app->get('/', function (Request $request, Response $response, array $args) use ($page_renderer) {
    $diaryDomain = new DiaryDomain();
    $diaries = $diaryDomain->getAllDiaries();

    return $page_renderer->render($response, 'index.php', [
        'diaries' => $diaries,
    ]);
});

$app->get('/new', function (Request $request, Response $response, array $args) use ($page_renderer) {
    return $page_renderer->render($response, 'new.php');
});

$app->post('/api/diary/new', function (Request $request, Response $response, array $args) {
    $diaryDomain = new DiaryDomain();
    $body = $request->getParsedBody();

    try {
        $diary = $diaryDomain->add($body);
        $response->getBody()->write(json_encode([
            'statusCode' => 200,
            'diary' => $diary,
        ]));
        return $response
            ->withHeader('Content-Type', 'application/json');
    } catch (\Exception $error) {
        $response->getBody()->write(json_encode([
            'statusCode' => 400,
            'message' => $error->getMessage(),
        ]));
        return $response
            ->withStatus(400)
            ->withHeader('Content-Type', 'application/json');
    }
});

$app->run();

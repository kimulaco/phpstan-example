<?
namespace App\Api\Diary;

require_once "{$_SERVER['DOCUMENT_ROOT']}/core/MySql.php";

use App\Core\MySql;

header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'POST') {
    http_response_code(404);
    echo json_encode([
        'statusCode' => 404,
        'message' => 'Not Found',
    ]);
    return;
}

$body = json_decode(file_get_contents('php://input'), true);
if (!$body['title'] || !$body['content']) {
    http_response_code(400);
    echo json_encode([
        'statusCode' => 400,
        'message' => 'Invalid params.',
    ]);
    return;
}

$mysql = new MySql();
$now = date('Y-m-d H:i:s');
$id = 0;
try {
    $mysql->open();
    $sql = <<<EOT
        INSERT INTO diaries (title, created_at, updated_at, content)
        VALUES (?, ?, ?, ?)
    EOT;
    $query = $mysql->pdo->prepare($sql);
    $query->bindParam(1, $body['title']);
    $query->bindParam(2, $now);
    $query->bindParam(3, $now);
    $query->bindParam(4, $body['content']);
    $query->execute();
    $id = $mysql->pdo->lastInsertId();
} catch (\Exception $error) {
    $mysql->close();
    http_response_code(500);
    echo json_encode([
        'statusCode' => 500,
        'message' => $error->getMessage(),
    ]);
    return;
}

$mysql->close();

echo json_encode([
    'code' => 200,
    'diary' => [
        'id' => $id,
        'title' => $body['title'],
        'created_at' => $now,
        'updated_at' => $now,
        'content' => $body['content'],
    ],
]);

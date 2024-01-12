<?php
namespace App\Domain;

use \App\Core\MySql;
use \App\Model\Diary as DiaryModel;

class Diary {
    private MySql $mysql;

    public function __construct()
    {
        $this->mysql = new MySql();
    }

    public function getAllDiaries(): array
    {
        $this->mysql->open();
        $sql = 'SELECT id, title, created_at, updated_at, content FROM diaries';
        $query = $this->mysql->pdo->query($sql);
        $rows = $query->fetchAll();
        $diaries = [];

        foreach ($rows as $row) {
            $diary = new DiaryModel(
                $row['id'],
                $row['title'],
                $row['created_at'],
                $row['updated_at'],
                $row['content'],
            );
            array_push($diaries, $diary,);
        }

        $this->mysql->close();

        return $diaries;
    }

    public function add(array $data)
    {
        if (!$data['title']) {
            throw new \Exception('Required title.');
        }

        if (!$data['content']) {
            throw new \Exception('Required content.');
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
            $query->bindParam(1, $data['title']);
            $query->bindParam(2, $now);
            $query->bindParam(3, $now);
            $query->bindParam(4, $data['content']);
            $query->execute();
            $id = $mysql->pdo->lastInsertId();
            $mysql->close();
        } catch (\Exception $error) {
            $mysql->close();
            http_response_code(500);
            echo json_encode([
                'statusCode' => 500,
                'message' => $error->getMessage(),
            ]);
            return;
        }

        return [
            'id' => $id,
            'title' => $data['title'],
            'created_at' => $now,
            'updated_at' => $now,
            'content' => $data['content'],
        ];
    }
}

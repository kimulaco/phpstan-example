<?php
namespace App\Domain;

require_once "{$_SERVER['DOCUMENT_ROOT']}/core/MySql.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/model/Diary.php";

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
}

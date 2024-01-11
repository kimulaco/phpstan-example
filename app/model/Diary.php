<?
namespace App\Model;

class Diary {
    public int $id = 0;
    public string $title = '';
    public string $created_at = '';
    public string $updated_at = '';
    public string $content = '';

    public function __construct(
        int $id,
        string $title,
        string $created_at,
        string $updated_at,
        string $content
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->content = $content;
    }
}

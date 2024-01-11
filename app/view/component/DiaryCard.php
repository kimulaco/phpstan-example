<?
namespace App\View\Component;

class DiaryCard {
    static function render ($diary)
    {
        echo <<<EOT
        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title">{$diary->title}</h3>
                <p class="card-subtitle">{$diary->updated_at}</p>
                <p class="card-text">{$diary->content}</p>
            </div>
        </div>
        EOT;
    }
}

<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/domain/Diary.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/view/component/DiaryCard.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/view/layout/Page.php";

use \App\Domain\Diary as DiaryDomain;
use \App\View\Component\DiaryCard as DiaryCard;
use \App\View\Layout\Page as PageLayouts;

$diaryDomain = new DiaryDomain();
$diaries = $diaryDomain->getAllDiaries();
?>
<? PageLayouts::renderDoctype(); ?>
<html lang="ja">
<? PageLayouts::renderCommonHeadTag(); ?>
<body>
    <div class="container">
        <div>
            <a class="btn btn-primary" href="/new.php">Add diary</a>
        </div>

        <?php foreach($diaries as $diary) {
            DiaryCard::render($diary);
        } ?>
    </div>

    <? PageLayouts::renderCommonScriptTag(); ?>
</body>
</html>

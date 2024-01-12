<?php
use \App\View\Component\DiaryCard as DiaryCard;
use \App\View\Layout\Page as PageLayouts;
?>
<? PageLayouts::renderDoctype(); ?>
<html lang="ja">
<? PageLayouts::renderCommonHeadTag(); ?>
<body>
    <div class="container">
        <div>
            <a class="btn btn-primary" href="/new">Add diary</a>
        </div>

        <?php foreach($diaries as $diary) {
            DiaryCard::render($diary);
        } ?>
    </div>

    <? PageLayouts::renderCommonScriptTag(); ?>
</body>
</html>

<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/view/layout/Page.php";

use App\View\Layout\Page;
?>
<? Page::renderDoctype(); ?>
<html lang="ja">
<? Page::renderCommonHeadTag(); ?>
<body>
    <div class="container">
        <form method="post" id="NewDiaryForm">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <? Page::renderCommonScriptTag(); ?>

    <script>
        const getFormValues = (formElement) => {
            if (!formElement) {
                return {};
            }

            const elements = formElement.elements;
            const values = {};

            for (const { tagName, name, type, value } of elements) {
                if (
                    !['INPUT', 'TEXTAREA'].includes(tagName) ||
                    (tagName === 'INPUT' && type === 'submit') ||
                    !name
                ) {
                    continue;
                }
                values[name] = value;
            }

            return values;
        };

        const main = () => {
            const form = document.getElementById('NewDiaryForm');

            if (!form) {
                console.error('form is not found');
                return;
            }

            form.addEventListener('submit', async (event) => {
                event.preventDefault();
                const values = getFormValues(event.target);
                console.log(values);

                const response = await fetch('/api/diary/new.php', {
                    method: 'POST',
                    body: JSON.stringify(values),
                })
                const json = await response.json();
                console.log(json);
            });
        };

        main();
    </script>
</body>
</html>

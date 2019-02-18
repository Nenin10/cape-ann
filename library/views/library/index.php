<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
    <!--    Using Yii Documentation for first example
            just to make sure Controller is working
            with Model and View.                  -->
    <h1>Books</h1>
    <ul>
        <?php foreach ($books as $book): ?>
            <li>
                <?= Html::encode("{$book->title} ({$book->author})") ?> -
                <?= $book->year ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
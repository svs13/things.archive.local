<?php

use kartik\sidenav\SideNav;
use yii\web\View;

/* @var $this View */
/* @var $content string */

array_unshift(
    $this->params['breadcrumbs'],
    ['label' => 'Админ-панель', 'url' => ['/admin/authors']]
);
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
    <div class="row">
    <div class="col-xs-2">
        <?= SideNav::widget([
            'items' => [
                ['label' => 'Архивы',   'url' => ['/admin/archive']],
                ['label' => 'Вещи',     'url' => ['/admin/thing']],
                ['label' => 'Фото',     'url' => ['/admin/photo']],
            ],
        ]);
        ?>
    </div>
    <div class="col-xs-10">
        <?= $content; ?>
    </div>
    </div>
<?php $this->endContent(); ?>

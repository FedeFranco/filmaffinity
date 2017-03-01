<?php
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\models\Genero;
?>

<?php Pjax::begin([
    'enablePushState' => false,
    ]) ?>

<?= \yii\grid\GridView::widget([
    'id' => 'generoGrid',
    'dataProvider' => $dataProvider,
    'columns' => [
        'nombre_genero',
    ],

    /*'tableOptions' => [
        'class' => 'table table-bordered table-hover',
    ],*/
]) ?>

<?php
    $url = Url::to(['uploads/upload']);
    echo <<<EOT
    <script>
  $('#generoGrid tr').click(function (event) {
        var target = event.currentTarget;
        if ($(target).children().length > 1) {
            var obj = $(target).children().first();
            numero = $(obj[0]).text();
            window.location.assign('$url' + '?nombre_genero=' + nombre_genero);
        }
    });
    </script>
EOT;
?>

<?php Pjax::end() ?>

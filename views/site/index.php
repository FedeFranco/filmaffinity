<?php
use yii\widgets\ListView;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">

<?= ListView::widget([
        'dataProvider' => $listDataProvider,
        'itemView' => '_lista',
    ]);  ?>
    </div>
</div>

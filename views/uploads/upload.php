<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\imagine\Image;
use app\models\Genero;

$url = Url::to(['uploads/generos']);
$urlActual = Url::to(['uploads/upload']);
$js = <<<EOT
    $('#uploadform-genero').keyup(function() {

        var q = $('#uploadform-genero').val();
        if (q == '') {
            $('#gen').html('');
        }
        /*if (!isNaN(q)) {
            return;
        }*/
        $.ajax({
            method: 'GET',
            url: '$url',
            data: {
                q: q
            },
            success: function (data, status, event) {
                $('#gen').html(data);
            }
        });
    });
EOT;
$this->registerJs($js);
?>

<?= $msg ?>

<h3>Subir archivos</h3>

<?php $form = ActiveForm::begin([
     "method" => "post",
     "enableClientValidation" => true,
     "options" => ["enctype" => "multipart/form-data"],
     ]);
?>

<?= $form->field($model, "file[]")->fileInput(['multiple' => true]) ?>
<?= $form->field($model, "titulo") ?>
<?= $form->field($model, "genero") ?>
<?= $form->field($model, "descricion")->textarea() ?>

<?php /*Image::crop(Yii::getAlias('@webroot/uploads/m.png', 200, 200,[5,5]))
->save(Yii::getAlias('@runtime/crop-m.png'), ['quality' => 80]);*/
    $image = yii\imagine\Image::getImagine();
    $newImage = $image->open(Yii::getAlias('@webroot/uploads/m.png'));

    $newImage->effects()->blur(10);

    $newImage->save(Yii::getAlias('@runtime/blur-m.png'), ['quality' => 80]);
?>

<?= Html::submitButton("Subir", ["class" => "btn btn-primary"]) ?>

<?php $form->end();
    $img = Url::to('@web/uploads');
    //$image = '<img src="'.$img.'" width="600" />';

    ?>
 <?php echo Html::img('@web/uploads/m.png', ['class' => 'pull-left img-responsive','width' => '200']); ?>

<div id="gen"></div>

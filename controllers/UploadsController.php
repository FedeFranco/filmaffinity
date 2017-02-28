<?php

namespace app\controllers;

use app\models\UploadForm;
use app\models\Upload;
use app\models\Genero;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use Yii;

class UploadsController extends \yii\web\Controller
{

    public function actionUpload()
    {

        $uplo = new Upload;
        $model = new UploadForm;
        $msg = null;

        if ($model->load(Yii::$app->request->post()))
        {
            $model->file = UploadedFile::getInstances($model, 'file');

            if ($model->file && $model->validate()) {

                $generos = explode(',',$model->genero);

                if ($uplo->subir($model->titulo, $model->descricion,$model->file,$msg)) {
                    $msg = "<p><strong class='label label-info'>Enhorabuena, subida realizada con éxito</strong></p>";
                }

            }
        }
        return $this->render("upload", ["model" => $model, "msg" => $msg]);
    }

    public function actionGeneros($q)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Genero::find()->where(['ilike', 'nombre_genero', $q]),
            'pagination' => [
                'pageSize' => 1,
            ],
            'sort' => false,
        ]);
        return $this->renderAjax('_generos', [
            'dataProvider' => $dataProvider,
        ]);
    }

}

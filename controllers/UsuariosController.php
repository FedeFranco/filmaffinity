<?php

namespace app\controllers;

use Yii;
use app\helpers\Mensaje;
use app\models\Usuario;
use app\models\UsuarioSearch;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuariosController implements the CRUD actions for Usuario model.
 */
class UsuariosController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            // [
            //     'class' => 'yii\filters\HttpCache',
            //     'only' => ['update'],
            //     'lastModified' => function ($action, $params) {
            //         return time();
            //     },
            // ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'activar'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'update'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $id = Yii::$app->request->get('id');
                            return $id === null || Yii::$app->user->id;
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->esAdmin;
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id = null)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionActivar($token)
    {
        $usuario = Usuario::findOne(['activacion' => $token]);

        if ($usuario === null) {
            throw new NotFoundHttpException('El usuario indicado no existe.');
        }

        $usuario->activacion = null;
        $usuario->save(false);
        Mensaje::exito('Usuario validado correctamente.');
        return $this->redirect(['site/login']);
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuario([
            'scenario' => Usuario::ESCENARIO_CREATE
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->activacion = Yii::$app->security->generateRandomString();
            $model->save(false);
            if (Yii::$app->user->isGuest) {
                $url = Url::to(['usuarios/activar', 'token' => $model->activacion], true);
                Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['smtpUsername'])
                    ->setTo($model->email)
                    ->setSubject('Activación de cuenta')
        //            ->setTextBody('Prueba')
                    ->setHtmlBody("Por favor, pulse en el siguiente enlace
                                   para activar su cuenta:<br/>
                                   <a href=\"$url\">Pinche aquí</a>")
                    ->send();
                Mensaje::exito('Usuario creado correctamente. Por favor, revise su correo.');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id = null)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $id = $id ?? Yii::$app->user->id;
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

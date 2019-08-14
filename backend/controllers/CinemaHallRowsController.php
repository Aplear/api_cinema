<?php

namespace backend\controllers;

use Yii;
use common\models\CinemaHallRows;
use common\models\CinemaHallRowsSearch;
use yii\base\ErrorHandler;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\CinemaHall;
use yii\web\Response;

/**
 * CinemaHallRowsController implements the CRUD actions for CinemaHallRows model.
 */
class CinemaHallRowsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'get-by-cinema-hall-row-id'],
                        'allow' => true,
                        'roles' => ['cinema-hall-rows'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all CinemaHallRows models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CinemaHallRowsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CinemaHallRows model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CinemaHallRows model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CinemaHallRows();
        $cinemaHall = CinemaHall::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'cinemaHall' => $cinemaHall
        ]);
    }

    /**
     * Updates an existing CinemaHallRows model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cinemaHall = CinemaHall::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'cinemaHall' => $cinemaHall
        ]);
    }

    /**
     * Deletes an existing CinemaHallRows model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @return string
     */
    public function actionGetByCinemaHallRowId()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isAjax) {
            $id = (int)Yii::$app->request->get('id');
            $rowModel = CinemaHallRows::findAll(['cinema_hall_id' => $id]);

            return $this->renderAjax('select', [
                'items' => $rowModel
            ]);
        }
    }

    /**
     * Finds the CinemaHallRows model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CinemaHallRows the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CinemaHallRows::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

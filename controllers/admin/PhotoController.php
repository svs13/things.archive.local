<?php

namespace app\controllers\admin;

use Yii;
use app\models\Photo;
use app\models\search\PhotoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * Действия с фото
 *
 * Class PhotoController
 * @package app\controllers\admin
 */
class PhotoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Просмотреть все
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PhotoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Создать
     *
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Photo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Редактировать
     *
     * @param $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Удалить
     *
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Найти модель
     *
     * @param $id
     * @return Photo|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $model = Photo::findOne($id);

        if (empty($model)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $model;
    }
}

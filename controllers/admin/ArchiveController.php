<?php

namespace app\controllers\admin;

use Yii;
use app\models\Archive;
use app\models\search\ArchiveSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Действия с архивом
 *
 * Class ArchiveController
 * @package app\controllers\admin
 */
class ArchiveController extends AdminController
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
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArchiveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Создать
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Archive();

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
     * @param integer $id
     * @return mixed
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
     * @return \yii\web\Response
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
     * @return Archive|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $model = Archive::findOne($id);

        if (empty($model)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $model;
    }
}

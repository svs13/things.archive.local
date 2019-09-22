<?php

namespace app\controllers\admin;

use app\models\PhotoEntity;
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

    /**
     * Список сущностей с заданным типом
     * Формат выходных данных:
     * [['id' => 1, 'name' => 'exp1'], ..]
     *
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionEntityList()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = ['output' => '', 'selected' => ''];

        $parents = Yii::$app->request->post('depdrop_parents');

        if (empty($parents)) {
            return $data;
        }

        $entityType = $parents[0];

        if (!PhotoEntity::isTypeExists($entityType)) {
            throw new NotFoundHttpException();
        }

        $list = PhotoEntity::getEntityListByType($entityType);
        /** Формат ['id' => 1, 'name' => 'exp1'] */
        $toListFormat = function ($k, $v) {
            return ['id' => $k, 'name' => $v];
        };
        $listData = \array_map($toListFormat, array_keys($list), $list);

        $data['output'] = $listData;

        return $data;
    }
}

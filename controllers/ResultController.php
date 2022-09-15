<?php

namespace app\controllers;
use app\models\Cc;
use app\models\CcResult;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class ResultController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Creates a new Result model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        if (\Yii::$app->user->can('createCC')) {

            $model = new CcResult();

            if ($this->request->isPost) {
                $model->cc_id = $id;
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->cc_id]);
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render("create", [
                "model" => $model,
            ]);

        } else {
            \yii::$app->getSession()->setFlash('error', 'Only Superior Can Create Result');
            return $this->redirect(['site/index']);
        }



        }

    /**
     * Displays a single CcResult model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id = null)
    {
        if (\Yii::$app->user->can('showCC')) { //permission superior
            return $this->render('view', [
                'model' => $id === null ?  $this->findModel($id) : $this->findModelByCcId($id),
            ]);

        }
        else {
            \yii::$app->getSession()->setFlash('error','Only Superior can see the specific result');
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Accept or Reject a result.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if user does not have permission
     */
    public function actionRespond($id, $response) {

        if (\Yii::$app->user->identity->role === "subordinate") {

            $model = $this->findModelByCcId($id);

            if ($this->request->isPost && $model->status == null) {
                ($response) ? $model->status = true : $model->status = false;
                $model->save();
                return $this->redirect(['./cc/view', 'id' => $model->cc_id]);
            }

            return $this->redirect(['site/index']);
        } else {
            throw new NotFoundHttpException("Page might be not exist or you don't have permission to view it");
        }

    }

    /**
     * Update a result.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response for testing
     * @throws NotFoundHttpException for testing
     */
    public function actionUpdate($id) {

        $user = \Yii::$app->user?->identity;
        $model = $this->findModelByCcId($id);
        $modelCC = $this->findCCModel($id);

        if ($user->role === "superior" && $modelCC->superior_id === $user->id) {
            if ($this->request->isPost && $model->load($this->request->post())) {
                $model->status = null;
                $model->save();
                return $this->redirect(['./cc/view', 'id' => $model->cc_id]);
            }
            return $this->render('update', [
                'model' => $model,
            ]);

        } else {
            throw new NotFoundHttpException("Page might be not exist or you don't have permission to view it");
        }


    }



    /**
     * Finds the CcResult model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int|null $id ID
     * @return CcResult the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CcResult::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException("Page might be not exist or you don't have permission to view it");
    }

    /**
     * Finds the Cc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findCCModel($id)
    {
        $roleId = \Yii::$app->user->can('subordinate') ? "subordinate_id" : "superior_id";

        $userId = \Yii::$app->user->identity?->id;

        if (($model = Cc::findOne(['id' => $id, $roleId => $userId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException("Page might be not exist or you don't have permission to view it");
    }


    /**
     * Finds the CcResult model based on its cc_id value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int|null $id ID
     * @return CcResult the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelByCcId($id)
    {
        if (($model = CcResult::findOne(["cc_id" => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException("Page might be not exist or you don't have permission to view it");
    }

}
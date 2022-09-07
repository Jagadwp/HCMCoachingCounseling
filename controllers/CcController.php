<?php

namespace app\controllers;

use app\models\Account;
use app\models\Cc;
use app\models\CcCategory;
use app\models\SuperiorWorklist;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CcController implements the CRUD actions for Cc model.
 */
class CcController extends Controller
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
     * Lists all Cc models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Cc::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cc model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cc model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Cc();
        
        $from_request = false;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
            if (Yii::$app->request->get('id') !== null) {
                $cc_request = SuperiorWorklist::find()->where(["superior_id" => \Yii::$app->user->identity->id, "id" => Yii::$app->request->get('id')])->one();
                if (!empty($cc_request)) {
                    $model->cc_category_id = $cc_request->cc_category_id;
                    $model->subordinate_id = $cc_request->subordinate_id;
                    $from_request = true;
                }
            } 
        }

        $categories = CcCategory::find()->select(["id", "name"])->all();
        $subordinates = User::find()->select(["id", "name", "email"])->where(["superior_id" => \Yii::$app->user->identity->id])->all();
        
        return $this->render('create', [
            'model' => $model,
            'categories' => $categories,
            'subordinates' => $subordinates,
            'from_request' => $from_request
        ]);
    }

    /**
     * Updates an existing Cc model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $categories = CcCategory::find()->select(["id", "name"])->all();
        $user = \Yii::$app->user?->identity;
        $subordinates = $user->subordinates;
        
        return $this->render('update', [
            'model' => $model,
            'categories' => $categories,
            'subordinates' => $subordinates
        ]);
    }

    /**
     * Deletes an existing Cc model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cc::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

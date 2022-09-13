<?php

namespace app\controllers;

use app\models\SubordinateWorklist;
use app\models\SuperiorWorklist;
use app\models\CC;
use app\models\CcResult;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class WorklistController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    "class" => AccessControl::class,
                    "rules" => [
                        [
                            "allow" => true,
                            "roles" => ['@']
                        ]
                    ]
                ],
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
        if (\Yii::$app->user->identity->role === "superior") {
            $dataProviderRequest = new ActiveDataProvider([ // requested cc
                'query' =>  SuperiorWorklist::find()->andFilterWhere([
                    "superior_id" => \Yii::$app->user->identity->id,
                ])->andWhere([
                    "is", "cc_id", new \yii\db\Expression('null')
                ])
            ]);
            
            $subQueryCCResult = CcResult::find()->select("cc_id");
            $dataProviderCC = new ActiveDataProvider([ // cc with no result
                'query' => CC::find()
                    ->where(["not in", "id", $subQueryCCResult])
                    ->andFilterWhere(["superior_id" => \Yii::$app->user->identity->id])
            ]);

            return $this->render("indexSuperior", ["dataProviderRequest" => $dataProviderRequest, "dataProviderCC" => $dataProviderCC]);

        } else {
            $subQueryCCResult = CcResult::find()->select("cc_id");
            $dataProviderCC = new ActiveDataProvider([ // cc with no result
                'query' => CC::find()
                ->where(["not in", "id", $subQueryCCResult])
                ->andFilterWhere(["subordinate_id" => \Yii::$app->user->identity->id]),
            ]);
            
            $dataProviderCCResult = new ActiveDataProvider([ // cc that with result
                'query' =>  CC::find()
                ->innerJoin('cc_result', 'cc_result.cc_id = cc.id')
                ->andFilterWhere(["subordinate_id" => \Yii::$app->user->identity->id])
                // ->all()
            ]);

            // dd($dataProviderCCResult);

            return $this->render("indexSubordinate", ["dataProviderCC" => $dataProviderCC, "dataProviderCCResult" => $dataProviderCCResult]);
        }
    }

}

<?php

namespace app\controllers;

use app\models\SubordinateWorklist;
use app\models\SuperiorWorklist;
use app\models\Cc;
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
        $userId = \Yii::$app->user->identity?->id;

        if (\Yii::$app->user->identity->role === "superior") {
            $dataProviderRequest = new ActiveDataProvider([ // requested cc
                'query' =>  SuperiorWorklist::find()
                                ->andFilterWhere(["superior_id" => $userId,])
                                ->andWhere(["IS", "cc_id", new \yii\db\Expression('null')])
            ]);
            
            $subQueryCCResult = CcResult::find()->select("cc_id");
            $dataProviderCC = new ActiveDataProvider([ // cc with no result
                'query' => Cc::find()
                            ->where(["NOT IN", "id", $subQueryCCResult])
                            ->andFilterWhere(["superior_id" => $userId])
            ]);

            $dataProviderCCRevision = new ActiveDataProvider([ // cc with result that need revision
                'query' => CC::find()
                            ->where(["IN", "id", $subQueryCCResult->andFilterWhere(["status" => false])])
                            ->andFilterWhere(["superior_id" => $userId])
            ]);

            return $this->render("indexSuperior", [
                "dataProviderRequest" => $dataProviderRequest, 
                "dataProviderCC" => $dataProviderCC,
                "dataProviderCCRevision" => $dataProviderCCRevision
            ]);

        } else {
            $subQueryCCResult = CcResult::find()->select("cc_id");
            $dataProviderCC = new ActiveDataProvider([ // cc with no result
                'query' => Cc::find()
                            ->where(["NOT IN", "id", $subQueryCCResult])
                            ->andFilterWhere(["subordinate_id" => $userId]),
            ]);
            
            $dataProviderCCResult = new ActiveDataProvider([ // cc that with result (not done)
                'query' => Cc::find()
                            ->innerJoin('cc_result', 'cc_result.cc_id = cc.id AND cc_result.status IS NOT true')
                            ->andFilterWhere(["subordinate_id" => $userId])
                            // ->all()
            ]);

            // dd($dataProviderCCResult);

            return $this->render("indexSubordinate", [
                "dataProviderCC" => $dataProviderCC, 
                "dataProviderCCResult" => $dataProviderCCResult
            ]);
        }
    }

}

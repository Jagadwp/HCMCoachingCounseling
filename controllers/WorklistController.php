<?php

namespace app\controllers;

use app\models\SubordinateWorklist;
use app\models\SuperiorWorklist;
use app\models\CC;
use yii\data\ActiveDataProvider;
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
            $dataProviderRequest = new ActiveDataProvider([
                'query' =>  SuperiorWorklist::find()->andFilterWhere([
                    "superior_id" => \Yii::$app->user->identity->id,
                ])->andWhere([
                    "is", "cc_id", new \yii\db\Expression('null')
                ])
            ]);

            $dataProviderCC = new ActiveDataProvider([
                'query' => CC::find()->andFilterWhere([
                    "superior_id" => \Yii::$app->user->identity->id
                ]),
            ]);

            return $this->render("indexSuperior", ["dataProviderRequest" => $dataProviderRequest, "dataProviderCC" => $dataProviderCC]);

        } else {
            $dataProvider = new ActiveDataProvider([
                'query' =>  SuperiorWorklist::find()->andFilterWhere([
                    "superior_id" => \Yii::$app->user->identity->id,
                ])->andWhere([
                    "is", "cc_id", new \yii\db\Expression('null')
                ])
            ]);

            $dataProviderCC = new ActiveDataProvider([
                'query' => CC::find()->andFilterWhere([
                    "superior_id" => \Yii::$app->user->identity->id
                ]),
            ]);

            return $this->render("indexSubordinate", ["dataProvider" => $dataProvider, "dataProviderCC" => $dataProviderCC]);
        }
    }

}

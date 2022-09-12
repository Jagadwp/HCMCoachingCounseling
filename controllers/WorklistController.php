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

            return $this->render("indexSuperior", ["dataProvider" => $dataProvider, "dataProviderCC" => $dataProviderCC]);

        } else {
            // $query = SubordinateWorklist::find();
            // $dataProvider = new ActiveDataProvider([
            //     'query' => $query,
            // ]);
            // $query->andFilterWhere([
            //     "subordinate_id" => \Yii::$app->user->identity->id
            // ]);
            return $this->render("//site/underdevelopment", ["title" => "Worklist (Subordinate)"]);
        }
    }

}

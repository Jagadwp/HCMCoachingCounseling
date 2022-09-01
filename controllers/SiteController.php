<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SuperiorWorklist;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    // ============== Dummy controller ===============//
    public function actionRequest()
    {
        $model = new SuperiorWorklist();
        return $this->render("request", ["model" => $model]);
    }

    public function actionCreate()
    {
        return $this->render("create");
    }

    public function actionWorklist()
    {
        $data = [
            [
                "title" => "Counseling PHP",
                "date" => "Tue, 19 Sept 2022",
                "time" => "08:00 AM",
                "status" => "requested",
                "theme" => "warning",
                "type" => "regular"
            ],
            [
                "title" => "Final Report",
                "date" => "Thu, 31 Dec 2022",
                "time" => "12:00 PM",
                "status" => "scheduled",
                "theme" => "success",
                "type" => "achievement"
            ],
            [
                "title" => "Lorem Ipsum",
                "date" => "Thu, 31 Dec 2022",
                "time" => "12:00 PM",
                "status" => "requested",
                "theme" => "warning",
                "type" => "career plan"
            ],
            [
                "title" => "Lor dolor Sit Amet",
                "date" => "Thu, 31 Dec 2022",
                "time" => "12:00 PM",
                "status" => "scheduled",
                "theme" => "success",
                "type" => "goal setting"
            ],
            [
                "title" => "Lorem Ipsum",
                "date" => "Thu, 31 Dec 2022",
                "time" => "12:00 PM",
                "status" => "scheduled",
                "theme" => "success",
                "type" => "target monitoring"
            ]
        ];
        return $this->render("worklist", ["worklists" => $data]);
    }
}

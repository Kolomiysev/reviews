<?php

namespace app\controllers;


use app\models\Reviews;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SimpleForm;
use app\models\Sites;
use app\models\Users;
use app\models\search\SitesSearch;
use app\models\search\ReviewsSearch;
use yii\data\Pagination;

use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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

    public function actionIndex()
    {
        $model = new Sites();

        $searchModel = new SitesSearch();

        $searchModel->country="ua";
        $dataProvider_ua = $searchModel->search();

        $searchModel->country="ru";
        $dataProvider_ru = $searchModel->search();

        return $this->render('index',[
            'model'=>$model,
            'dataProvider_ua'=>$dataProvider_ua,
            'dataProvider_ru'=>$dataProvider_ru
        ]);

    }

    public function actionCountry($code)
    {
        $model = new Sites();

        $searchModel = new SitesSearch();
        $searchModel->load(Yii::$app->request->get());

        $searchModel->country=$code;
        $searchModel->pagination=true;

        $dataProvider = $searchModel->search();

        if($code=="ua"){
            $title="Украины";
        } elseif($code=="ru"){
            $title="России";
        }

        return $this->render('country',[
            'title'=>$title,
            'model'=>$model,
            'dataProvider'=>$dataProvider,
        ]);
    }


    public function actionReviews($url)
    {
        $model = Sites::findOne(['url'=>$url]);

        $reviews = Reviews::findAll(['site'=>$model->id]);


        foreach($reviews as $review){
            $ids[]=$review->user;
        }

        $users = Users::findAll(['id'=>$ids]);




        return $this->render('reviews',[
            'model'=>$model,
            'users'=>$users,
            'reviews'=>$reviews,
        ]);

    }














    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

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

    public function actionAbout()
    {
        return $this->render('about');
    }




}
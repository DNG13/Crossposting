<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Access_token;
use app\models\PostCheckbox;
use app\models\GetVk_code;
use app\models\Post;
use app\models\LoginForm;
use app\models\PostForm;
use app\models\PostServices_data;
use app\models\Signup;
use app\models\Sendposts;
use app\models\Services_link;
use app\models\Fb_data;
use app\models\Tw_data;
use app\models\Vk_data;
use app\models\fb_callback;
use app\models\twitter_callback;
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'post', 'services', 'sendposts', 'getvkcode', 'twitter', 'twitter_callback'],
                'rules' => [
                    [
                        'actions' => ['logout',  'post', 'services', 'sendposts', 'getvkcode', 'twitter', 'twitter_callback'],
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
    /**
     * @inheritdoc
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
     * @return string
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if(Yii::$app->request->post('LoginForm')){
            $model->attributes = Yii::$app->request->post('LoginForm');
            if ($model->validate()) 
            {
                Yii::$app->user->login($model->getUser());
                return $this->goHome();
            }
        }
        return $this->render('login', [
                'model' => $model,
            ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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
    
    public function actionSignup()
    {
        $model = new Signup();
        if(Yii::$app->request->post('Signup')!== null)
        {
            $model->attributes = Yii::$app->request->post('Signup');
            if($model->validate() && $model->signup())
            {
               return $this->redirect('aftersignup');
            }
        }
        return $this->render('signup', [
            'model'=>$model
        ]);
    }
    public function actionAftersignup()
    {
        return $this->render('aftersignup');
    }
    public function actionPost()
    {
        $error = '';
        $model = new PostForm();
        $checkbox = new PostCheckbox();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {    
            $post = new Post;
            $post->message = $model->message;
            $post->user_id = Yii::$app->user->getId();
            $post->save();
            $id = $post->id;
            $checkbox-> Checkbox($id);
            return $this->redirect('sendposts');   
        }else{
            if(Yii::$app->request->post('Post')!== null){
                $error = true;  
            }else {
                $error = false;
            }
        }   
        return $this->render('post', [
            'model' => $model,
            'checkbox' =>$checkbox,
            'success' => false,
            'error' => $error
        ]);    
    }
    
    public function actionServices()
    {         
        $vktoken = Vk_data::find()->where(['user_id' => Yii::$app->user->getId()])->one();
        $twtoken = Tw_data::find()->where(['user_id' => Yii::$app->user->getId()])->one();
        $fbtoken = Fb_data::find()->where(['user_id' => Yii::$app->user->getId()])->one();
        return $this->render('services', [
            'vktoken' => $vktoken,
            'twtoken' => $twtoken,
            'fbtoken' => $fbtoken,
        ]);     
    } 
    
    public function actionGetvkcode()
    {
        $model = new Services_link();
        $getvkcodelink = $model->getVkCodeLink();
        $vkcode = new GetVk_code();
        if ($vkcode->load(Yii::$app->request->post()) && $vkcode->validate()) {
            $model = new Access_token();
            $model->getVkToken(); 
            return $this->redirect('services');
        }
        return $this->render('getvkcode', [
            'getvkcodelink'=>$getvkcodelink,
            'vkcode' => $vkcode, 
        ]);
    }
    
    public function actionPrivacy()
    {
        return $this->render('privacy');
    }
    
    public function actionHelp()
    {
        return $this->render('help');
    }
    
    public function actionSendposts()
    {
        $sendposts = Sendposts::find()->where(['user_id' => Yii::$app->user->getId()])->orderBy(['time'=>SORT_DESC])->all();
        $sendposts_services = PostServices_data::find()->orderBy(['id'=>SORT_DESC])->all();
        return $this->render('sendposts', [
            'sendposts' => $sendposts, 
            'sendposts_services' => $sendposts_services
        ]);
    }
    
    public function actionTwitter()
    {
        $model = new Services_link();
        $url = $model->twitterLink();
        return $this->redirect($url);
    }
    
    public function actionTwitter_callback()
    {
        $model = new twitter_callback();
        $model->getTwToken();
        return $this->redirect('services');
    }
    
    public function actionFb()
    {
        $model = new Services_link();
        $url = $model->fbLink();
        return $this->redirect($url);
    }
    
    public function actionFb_callback()
    {
        $model = new fb_callback();
        $model->getFbToken();
        return $this->redirect('services');
    }
}
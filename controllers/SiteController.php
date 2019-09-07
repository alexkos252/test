<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
     * Signup action.
     */
    public function actionSignup()
    {
        $model = new SignupForm();
 
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
 
        return $this->render('signup', [
            'model' => $model,
        ]);
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
    
//    public function actionRole()
//    {
//        $auth = Yii::$app->authManager;
//        
//        //Создаем роли администратор, автор, пользователь
//        $admin = $auth->createRole('admin');
//        $admin->description = 'Администратор';
//        $auth->add($admin);
//        
//        $author = $auth->createRole('author');
//        $author->description = 'Автор';
//        $auth->add($author);
//        
//        $user = $auth->createRole('user');
//        $user->description = 'Пользователь';
//        $auth->add($user);
//        
//
//        // добавляем разрешение "createPost"
//        $createPost = $auth->createPermission('createPost');
//        $createPost->description = 'Создание поста';
//        $auth->add($createPost);
//        
//        // даём роли "author" разрешение "createPost"
//        $auth->addChild($author, $createPost);
//
//        // добавляем разрешение "updatePost"
//        $updatePost = $auth->createPermission('updatePost');
//        $updatePost->description = 'Редактирование поста';
//        $auth->add($updatePost);
//        // правило для редактирования поста автором
//        $rule = new \app\rbac\AuthorRule;
//        $auth->add($rule);
//        // добавляем разрешение "updateOwnPost" и привязываем к нему правило.
//        $updateOwnPost = $auth->createPermission('updateOwnPost');
//        $updateOwnPost->description = 'Редактирование своего поста';
//        $updateOwnPost->ruleName = $rule->name;
//        $auth->add($updateOwnPost);
//
//        // "updateOwnPost" будет использоваться из "updatePost"
//        $auth->addChild($updateOwnPost, $updatePost);
//
//        // разрешаем "автору" редактировать его посты
//        $auth->addChild($author, $updateOwnPost);
//
//        
//        // добавляем разрешение "deletePost"
//        $deletePost = $auth->createPermission('deletePost');
//        $deletePost->description = 'Удаление поста';
//        $auth->add($deletePost);
//
//        // даём роли "admin" разрешение "updatePost"
//        // а также все разрешения роли "author"
//        $auth->addChild($admin, $deletePost);
//        $auth->addChild($admin, $updatePost);
//        $auth->addChild($admin, $author);
//
//        // Назначение ролей пользователям. 1 и 2 , роль user присваивается автоматически при регистрации пользователя 
//        // обычно реализуемый в модели User.
//        $auth->assign($admin, 1);
//        $auth->assign($author, 2);
//        $auth->assign($user, 3);
//    }

}

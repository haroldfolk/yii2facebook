<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\UploadForm;
use app\models\Usuarios;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class UsuarioController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [

            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'registrar'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'registrar'],
                        'roles' => ['?'],//usuario
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],//invitado
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

    public function actionLogin()
    {
        $this->layout = 'mainLogin';
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/inicio/ver-noticias']);
        }

        $model = new LoginForm();
        $model->rememberMe = false;
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/inicio/ver-noticias']);
        }
        return $this->render('login', [
            'model' => $model, 'leer' => $this->contadorDeVisitas()
        ]);
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['login']);
    }



    public function actionRegistrar()
    {
        $this->layout = 'mainLogin';
        $model = new Usuarios();
        $modelFoto = new UploadForm();
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['/usuario/login']);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
        $model->url = "";
        if ($model->load(Yii::$app->request->post()) && $modelFoto->load(Yii::$app->request->post())) {
            $modelFoto->imageFile = UploadedFile::getInstances($modelFoto, 'imageFile');
            if ($modelFoto->upload()) {
                $model->url = "http://lorempixel.com/400/200";
            }

            $model->save();

            return $this->redirect(['/usuario/login']);
        } else {
            return $this->render('create', [
                'model' => $model, 'modelFoto' => $modelFoto
            ]);
        }
    }

    public function contadorDeVisitas()
    {
        $maestro = fopen("contador.txt", "r+");

//leo la primera linea y se la asigno a $leer
        $leer = fgets($maestro, 10);

//incremento la variable $leer en uno
        ++$leer;

//rebobino el archivo para poder sobre escribir su contenido
        rewind($maestro);

//sobreescribo el contenido
        fputs($maestro, $leer);

//cierro el archivo de texto
        fclose($maestro);
        return $leer;
    }
}

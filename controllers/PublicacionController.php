<?php

namespace app\controllers;

use app\models\Amigos;
use app\models\Comentarios;
use app\models\Imagenes;
use app\models\Likes;
use app\models\Publicaciones;
use app\models\UploadForm;
use app\models\Usuarios;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class PublicacionController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [

            'access' => [
                'class' => AccessControl::className(),
                'only' => ['borrar-publicacion', 'dar-like', 'editar-comentario', 'editar-publicacion', 'realizar-comentario', 'realizar-publicacion', 'ver-publicacion'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['borrar-publicacion', 'dar-like', 'editar-comentario', 'editar-publicacion', 'realizar-comentario', 'realizar-publicacion', 'ver-publicacion'],
                        'roles' => ['@'],
                    ],
                ],
            ],

        ];
    }

    public function actionBorrarPublicacion($id)
    {
        $model = $this->findModel($id);
        if ($model->autor_id == Yii::$app->user->id) {
        $model->fecha_fin = date("Y-m-d H:i:s");
        $model->save();
        }
        return $this->redirect(['/inicio/ver-noticias']);
    }

    //
    public function actionDarLike($id)
    {
        $idLOG = Yii::$app->user->id;


        $like = new Likes();

        $laPub = $this->findModel($id);
        $relacion = new Amigos();
        if ($laPub->autor_id == $idLOG || $relacion->sonAmigos($laPub->autor_id, Yii::$app->user->id)) {
            $like->usuario_id = $idLOG;
            $like->publicacion_id = $id;


            $like1 = Likes::findOne(['usuario_id' => $idLOG, 'publicacion_id' => $id]);
//            print_r($like1);
//            exit();
            if ($like1 == null) {
                $like->save();
            } else {
//                print_r("entro al else");
//            exit();
//                $like->delete();
            }

            return $this->redirect(['ver-publicacion', 'id' => $id]);
            //no return nada porque solo ejecuta la accion de like y dislike
        }
        throw new NotFoundHttpException('Esta publicacion es de un usuario que no es tu amigo aun.');
    }


    public function actionEditarComentario($id)
    {

        $model = Comentarios::findOne(['id' => $id]);
        if ($model->usuario_id == Yii::$app->user->id) {

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['ver-publicacion', 'id' => $id]);
        } else {
            return $this->render('updatecoment', [
                'model' => $model,
            ]);
        }
        }
        return $this->redirect(['ver-publicacion', 'id' => $id]);
    }

    public function actionEditarPublicacion($id)
    {
        $model = $this->findModel($id);
        if ($model->autor_id == Yii::$app->user->id) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['ver-publicacion', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        return $this->goBack();
    }

    public function actionRealizarComentario($id, $param)
    {
        $relacion = new Amigos();
        $idLOG = Yii::$app->user->id;
        $laPub = $this->findModel($id);
        if ($param == null) {
            return $this->redirect(['ver-publicacion', 'id' => $id]);
        }
        if ($laPub->autor_id == $idLOG || $relacion->sonAmigos($laPub->autor_id, Yii::$app->user->id)) {


            $model = new Comentarios();
            $model->usuario_id = $idLOG;
            $model->contenido = $param;
            $model->publicacion_id = $id;
            $model->save();
        }
        return $this->redirect(['ver-publicacion', 'id' => $id]);
    }

    public function actionRealizarPublicacion()
    {

        $model = new Publicaciones();
        $model->autor_id = Yii::$app->user->getId();
        $model->fecha_inicio = date("Y-m-d H:i:s");
        $model->fecha_fin = null;
        $modelFoto = new UploadForm();
        if ($model->load(Yii::$app->request->post()) && $modelFoto->load(Yii::$app->request->post())) {
            $modelFoto->imageFile = UploadedFile::getInstance($modelFoto, 'imageFile');
            $upload = $modelFoto->upload();
            $model->save();
            if ($upload != null) {
                $img = new Imagenes();
                $img->url = $upload;
                $img->publicacion_id = $model->id;
                $img->save();
            }


            return $this->redirect(['ver-publicacion', 'id' => $model->id]);

        } else {

            return $this->render('create', [
                'model' => $model, 'modelFoto' => $modelFoto
            ]);
        }
    }


    public function actionVerPublicacion($id)
    {
        $idLog = Yii::$app->user->id;
        $pub = $this->findModel($id);
        $coments = Comentarios::find()->where(['publicacion_id' => $id]);
        $dataComentarios = new ActiveDataProvider([
            'query' => $coments,
            'pagination' => [
                'pageSize' => 3,
            ]
        ]);
        $likes = Likes::find()->select('usuario_id')->where(['publicacion_id' => $id]);
        $usuariosLikes = Usuarios::find()->where(['id' => $likes]);
        $dataLikes = new ActiveDataProvider([
            'query' => $usuariosLikes,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);
        $imagen = Imagenes::findOne(['publicacion_id' => $pub->id])->url;
        if ($pub->autor_id == $idLog) {
            return $this->render('view', [
                'model' => $pub, 'dataComentarios' => $dataComentarios, 'dataLikes' => $dataLikes, 'img' => $imagen
            ]);
        } else {
            return $this->render('viewVisita', [
                'model' => $pub, 'dataComentarios' => $dataComentarios, 'dataLikes' => $dataLikes, 'img' => $imagen
            ]);
        }
    }


    private function findModel($id)
    {
        if (($model = Publicaciones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

<?php

namespace app\controllers;

use app\models\Amigos;
use app\models\Comentarios;
use app\models\Likes;
use app\models\Publicaciones;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

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
        return $this->goBack();
    }

    //
    public function actionDarLike($idPub)
    {
        $idLOG = Yii::$app->user->id;
        $like = new Likes();

        $laPub = $this->findModel($idPub);
        $relacion = new Amigos();
        if ($laPub->autor_id == $idLOG || $relacion->sonAmigos($laPub->autor_id, Yii::$app->user->id)) {
            $like->publicacion_id = $idPub;
            $like->usuario_id = $idLOG;
            if (!$like->save()) {
                $like = Likes::findOne(['publicacion_id' => $idPub, 'usuario_id' => $idLOG]);
                $like->delete();

            }
            return $this->goBack();
            //no return nada porque solo ejecuta la accion de like y dislike
        }
        throw new NotFoundHttpException('Esta publicacion es un usuario que no es tu amigo aun.');
    }


    public function actionEditarComentario($id)
    {

        $model = Comentarios::findOne(['id' => $id]);
        if ($model->usuario_id == Yii::$app->user->id) {

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->goBack();
        } else {
            return $this->render('updatecoment', [
                'model' => $model,
            ]);
        }
        }
        return $this->goBack();
    }

    public function actionEditarPublicacion($id)
    {
        $model = $this->findModel($id);
        if ($model->autor_id == Yii::$app->user->id) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        return $this->goBack();
    }

    public function actionRealizarComentario($idPub)
    {
        $relacion = new Amigos();
        $idLOG = Yii::$app->user->id;
        $laPub = $this->findModel($idPub);
        if ($laPub->autor_id == $idLOG || $relacion->sonAmigos($laPub->autor_id, Yii::$app->user->id)) {


            $model = new Comentarios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->goBack();
        } else {
            return $this->render('createcoment', [
                'model' => $model,
            ]);
        }
        }
        return $this->goBack();
    }

    public function actionRealizarPublicacion()
    {

        $model = new Publicaciones();
        $model->autor_id = Yii::$app->user->getId();
        $model->fecha_inicio = date("Y-m-d H:i:s");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionVerPublicacion($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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

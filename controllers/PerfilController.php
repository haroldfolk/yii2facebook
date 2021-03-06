<?php

namespace app\controllers;

use app\models\Amigos;
use app\models\Publicaciones;
use app\models\UploadForm;
use app\models\Usuarios;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class PerfilController extends \yii\web\Controller
{

    public function actionEditarPerfil()
    {

        $model = $this->findModel(Yii::$app->user->id);
        $modelFoto = new UploadForm();

        if ($model->load(Yii::$app->request->post())) {
            $modelFoto->imageFile = UploadedFile::getInstance($modelFoto, 'imageFile');
            $upload = $modelFoto->upload();
            if ($upload != null) {
                $model->url = $upload;
            }
            $model->save();
            return $this->redirect(['/perfil/ver-perfil', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model, 'modelFoto' => $modelFoto
            ]);
        }
    }

    public function actionVerPerfil($id = null)
    {
        if ($id == null) {
            $model = $this->findModel(Yii::$app->user->id);
        } else {
            $model = $this->findModel($id);
        }

        $sonAmigos = new Amigos();
        $pendiente = 0;
        if ($sonAmigos->sonAmigos($id, Yii::$app->user->id)) {
            $pendiente = -1;
        } else if ($sonAmigos->solicitudPendienteIda(Yii::$app->user->id, $id)) {
            $pendiente = 1;
        } else if ($sonAmigos->solicitudPendienteIda($id, Yii::$app->user->id)) {
            $pendiente = 2;
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Publicaciones::find()->where(['autor_id' => $model->id, 'fecha_fin' => null])->orderBy(['fecha_inicio' => SORT_DESC]),
        ]);
        return $this->render('view', [
            'model' => $model, 'pendiente' => $pendiente, 'dataProvider' => $dataProvider
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

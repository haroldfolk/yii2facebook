<?php

namespace app\controllers;

use app\models\Amigos;
use app\models\Publicaciones;
use app\models\Usuarios;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class PerfilController extends \yii\web\Controller
{

    public function actionEditarPerfil()
    {

        $model = $this->findModel(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/perfil/ver-perfil', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
        if ($sonAmigos->solicitudPendiente($id, Yii::$app->user->id)) {
            $pendiente = 1;
        }
        if ($sonAmigos->sonAmigos($id, Yii::$app->user->id)) {
            $pendiente = -1;
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

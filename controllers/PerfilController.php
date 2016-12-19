<?php

namespace app\controllers;

use app\models\Amigos;
use app\models\Usuarios;
use Yii;
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

    public function actionVerPerfil($id)
    {
        $model = $this->findModel($id);
        $sonAmigos = new Amigos();
        $pendiente = false;
        if ($sonAmigos->solicitudPendiente($id, Yii::$app->user->id)) {
            $pendiente = true;
        }
        return $this->render('view', [
            'model' => $model, 'pendiente' => $pendiente
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

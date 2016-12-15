<?php

namespace app\controllers;

use app\models\Usuarios;
use Yii;
use yii\web\NotFoundHttpException;

class PerfilController extends \yii\web\Controller
{

    public function actionEditarPerfil($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->goBack();
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionVerPerfil($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
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

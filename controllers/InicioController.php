<?php

namespace app\controllers;

use app\models\Amigos;
use app\models\Publicaciones;
use app\models\Usuarios;
use Yii;
use yii\data\ActiveDataProvider;

class InicioController extends \yii\web\Controller
{
    public function actionBuscarPersonas($param = "")
    {
        $activeQuery = Usuarios::find();
        $activeQuery->filterWhere(['ilike', 'nombres', $param])->orFilterWhere(['ilike', 'apellidos', $param]);
//            ->orFilterWhere(['ilike', 'username', $param]);

        $dataProvider = new ActiveDataProvider([
            'query' => $activeQuery,

        ]);
        return $this->render('buscar-personas', ['dataProvider' => $dataProvider]);
    }

    public function actionVerNoticias()
    {
        $amigosID = new Amigos();
        $amigosID = $amigosID->listaIDsAmigos(Yii::$app->user->id);
        $noticias = Publicaciones::find()->where(['autor_id' => $amigosID])->orderBy(['fecha_inicio' => SORT_DESC])->all();
        return $this->render('ver-noticias', ['noticias' => $noticias]);

    }

}

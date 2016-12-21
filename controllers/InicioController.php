<?php

namespace app\controllers;

use app\models\Amigos;
use app\models\Imagenes;
use app\models\Publicaciones;
use app\models\Usuarios;
use Yii;
use yii\data\ActiveDataProvider;

class InicioController extends \yii\web\Controller
{
    public function actionBuscarPersonas($param = "")
    {
        $lista = new Amigos();
        $lista = $lista->listaIDsAmigos(Yii::$app->user->id);

        $activeQuery = Usuarios::find()->where(['not in', 'id', $lista]);
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
        $amigosID = $amigosID->listaIDsAmigos2(Yii::$app->user->id);
        $pus = Publicaciones::find()->where(['autor_id' => $amigosID])->andWhere(['fecha_fin' => null])->orderBy(['fecha_inicio' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $pus,
        ]);

//        $noticias = Publicaciones::find()->where(['autor_id' => $amigosID])->orderBy(['fecha_inicio' => SORT_DESC])->all();
        return $this->render('ver-noticias', [/*'noticias' => $noticias,*/
            'dataProvider' => $dataProvider]);

    }

}

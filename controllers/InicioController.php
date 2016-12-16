<?php

namespace app\controllers;

use app\models\Amigos;
use app\models\Publicaciones;
use Yii;

class InicioController extends \yii\web\Controller
{
    public function actionBuscarPersonas()
    {
        return $this->render('buscar-personas');
    }

    public function actionVerNoticias()
    {
        $amigosID = new Amigos();
        $amigosID = $amigosID->listaIDsAmigos(Yii::$app->user->id);
        $noticias = Publicaciones::findAll(['autor_id' => $amigosID]);
        return $this->render('ver-noticias', ['noticias' => $noticias]);

    }

}

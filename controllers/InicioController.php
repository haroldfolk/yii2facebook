<?php

namespace app\controllers;

class InicioController extends \yii\web\Controller
{
    public function actionBuscarPersonas()
    {
        return $this->render('buscar-personas');
    }

    public function actionVerNoticias()
    {
        return $this->render('ver-noticias');
    }

}

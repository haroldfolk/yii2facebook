<?php

namespace app\controllers;

class MensajeController extends \yii\web\Controller
{
    public function actionAgregarParticipante()
    {
        return $this->render('agregar-participante');
    }

    public function actionBuscarTextoMensaje()
    {
        return $this->render('buscar-texto-mensaje');
    }

    public function actionDeshabilitarNotificaciones()
    {
        return $this->render('deshabilitar-notificaciones');
    }

    public function actionEnviarInbox()
    {
        return $this->render('enviar-inbox');
    }

    public function actionEnviarMensajeGrupo()
    {
        return $this->render('enviar-mensaje-grupo');
    }

    public function actionHabilitarNotificaciones()
    {
        return $this->render('habilitar-notificaciones');
    }

    public function actionSalirGrupo()
    {
        return $this->render('salir-grupo');
    }

}

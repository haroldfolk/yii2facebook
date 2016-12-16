<?php

namespace app\controllers;

use app\models\Amigos;
use app\models\Conversaciones;
use app\models\Grupos;
use app\models\Mensajes;
use app\models\Usuarios;
use Yii;
use yii\data\ActiveDataProvider;

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

    /**
     * @param null $idU
     * @return string
     */
//    public function actionEnviarInbox($idU = null)
//    {
//        $idLOG = Yii::$app->user->id;
//        if ($idU != null) {
//            $idCV = new Grupos();
//
//            $idCV = $idCV->devolverConversacion($idLOG, $idU);
//            if ($idCV == 0) {
//                $idNewConversacion = new Conversaciones();
//                $idNewConversacion->save();
//                $idCV = $idNewConversacion;
//                $newGrupo = new Grupos();
//                $newGrupo->conversacion_id = $idNewConversacion;
//                $newGrupo->participante_id = $idLOG;
//                $newGrupo->notificaciones = 1;
//                $newGrupo->save();
//                $newGrupo2 = new Grupos();
//                $newGrupo2->conversacion_id = $idNewConversacion;
//                $newGrupo2->participante_id = $idU;
//                $newGrupo2->notificaciones = 1;
//                $newGrupo2->save();
//            }
//            $mensajes=Mensajes::find()->where(['conversacion_id'=>$idCV])->all();
//        }else{
//           $mensajes=null;
//        }
//        $amigos=new Amigos();
//        $amigos=$amigos->listaIDsAmigos($idLOG);
//        $amigos=Usuarios::find()->where(['id'=>$amigos])->all();
//        return $this->render('enviar-inbox',['mensajes'=>$mensajes,'amigos'=>$amigos,'idEl'=>$idU,'idYo'=>$idLOG]);
//    }
    public function actionEnviarInbox($id = null, $mensaje = null)
    {
        $idLOG = Yii::$app->user->id;
        if ($id != null) {
            $idCV = new Grupos();

            $idCV = $idCV->devolverConversacion($idLOG, $id);
            if ($idCV == 0) {
                $idNewConversacion = new Conversaciones();
                $idNewConversacion->save();
                $idCV = $idNewConversacion->id;
                $newGrupo = new Grupos();
                $newGrupo->conversacion_id = $idCV;
                $newGrupo->participante_id = $idLOG;
                $newGrupo->notificaciones = 1;
                $newGrupo->save();
                $newGrupo2 = new Grupos();
                $newGrupo2->conversacion_id = $idCV;
                $newGrupo2->participante_id = $id;
                $newGrupo2->notificaciones = 1;
                $newGrupo2->save();
            }
            if ($mensaje != null) {
                $nuevoMensaje = new Mensajes();
                $nuevoMensaje->contenido = $mensaje;
                $nuevoMensaje->usuario_id = $idLOG;
                $nuevoMensaje->conversacion_id = $idCV;
                $nuevoMensaje->save();
            }

            $activeQuery = Mensajes::find()->where(['conversacion_id' => $idCV]);
            $dataProvider = new ActiveDataProvider([
                'query' => $activeQuery,
                'sort' => [
                    'defaultOrder' => [
                        'id' => SORT_ASC
                    ]
                ],
            ]);

            $amigos = new Amigos();
            $amigos = $amigos->listaIDsAmigosSinYo($idLOG);
            $amigos = Usuarios::find()->where(['id' => $amigos]);
            $dataProvider2 = new ActiveDataProvider([
                'query' => $amigos,
            ]);
            return $this->render('enviar-inbox', ['idU' => $id, 'dataProvider' => $dataProvider, 'dataProvider2' => $dataProvider2]);
        } else {
            $amigos = new Amigos();
            $amigos = $amigos->listaIDsAmigosSinYo($idLOG);
            $amigos = Usuarios::find()->where(['id' => $amigos]);
            $dataProvider2 = new ActiveDataProvider([
                'query' => $amigos,
            ]);
            return $this->render('enviar-inbox', ['idU' => null, 'dataProvider' => null, 'dataProvider2' => $dataProvider2]);
        }

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

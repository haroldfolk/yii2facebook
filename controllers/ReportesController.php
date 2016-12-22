<?php

namespace app\controllers;

use app\models\Amigos;
use app\models\Comentarios;
use app\models\Likes;
use app\models\Mensajes;
use app\models\Publicaciones;
use app\models\Usuarios;
use Yii;

class ReportesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $amigos = new Amigos();
        $id = Yii::$app->user->id;
        $amigos = $amigos->listaIDsAmigosSinYo($id);
        $publicacionesIDS = new Publicaciones();
        $publicacionesIDS = $publicacionesIDS->getPublicaciones($id);
        $contadorHombres = Usuarios::find()->where(['id' => $amigos, 'sexo' => 'M'])->count();
        $contadorMujeres = Usuarios::find()->where(['id' => $amigos, 'sexo' => 'F'])->count();
        $msgEnviados = Mensajes::find()->where(['usuario_id' => $id])->count();
        $solicitudesEnviadas = Amigos::find()->where(['emisor_id' => $id])->count();
        $solicitudesRecibidas = Amigos::find()->where(['receptor_id' => $id])->count();
        $solicitudesEnviadasYAceptadas = Amigos::find()->where(['emisor_id' => $id, 'esta_aceptado' => true])->count();
        $solicitudesRecibidasYAceptadas = Amigos::find()->where(['receptor_id' => $id, 'esta_aceptado' => true])->count();
        $solicitudesEnviadasPendientes = Amigos::find()->where(['emisor_id' => $id, 'esta_aceptado' => false])->count();
        $solicitudesRecibidasPendientes = Amigos::find()->where(['receptor_id' => $id, 'esta_aceptado' => false])->count();
        $publicaciones = Publicaciones::find()->where(['autor_id' => $id])->count();
        $comentariosRealizados = Comentarios::find()->where(['usuario_id' => $id])->count();
        $comentariosRecibidos = Comentarios::find()->where(['publicacion_id' => $publicacionesIDS])->count();
        $LikesRealizados = Likes::find()->where(['usuario_id' => $id])->count();
        $LikesRecibidos = Likes::find()->where(['publicacion_id' => $publicacionesIDS])->count();
        return $this->render('index', [
            'contadorHombres' => $contadorHombres,
            'contadorMujeres' => $contadorMujeres,
            'msgEnviados' => $msgEnviados,
            'solicitudesEnviadas' => $solicitudesEnviadas,
            'solicitudesRecibidas' => $solicitudesRecibidas,
            'solicitudesEnviadasYAceptadas' => $solicitudesEnviadasYAceptadas,
            'solicitudesRecibidasYAceptadas' => $solicitudesRecibidasYAceptadas,
            'solicitudesEnviadasPendientes' => $solicitudesEnviadasPendientes,
            'solicitudesRecibidasPendientes' => $solicitudesRecibidasPendientes,
            'publicaciones' => $publicaciones,
            'comentariosRealizados' => $comentariosRealizados,
            'comentariosRecibidos' => $comentariosRecibidos,
            'likesRealizados' => $LikesRealizados,
            'likesRecibidos' => $LikesRecibidos]);
    }

}

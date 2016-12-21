<?php
/* @var $this yii\web\View */
?>
<h1 align="center" class="lg btn-link">Estado de mi actividad</h1>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        Parametro
                    </th>
                    <th>
                        Detalle
                    </th>
                    <th>
                        Resultado
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        Amigos
                    </td>
                    <td>
                        Nro. de Mujeres
                    </td>
                    <td>
                        <?= $contadorMujeres ?>
                    </td>
                </tr>
                <tr class="active">

                    <td>
                        Amigos
                    </td>
                    <td>
                        Nro. de Hombres
                    </td>
                    <td>
                        <?= $contadorHombres ?>
                    </td>
                </tr>
                <tr class="success">

                    <td>
                        Mensajes
                    </td>
                    <td>
                        Nro. de Enviados
                    </td>
                    <td>
                        <?= $msgEnviados ?>
                    </td>
                </tr>
                <tr class="warning">

                    <td>
                        Solicitudes de Amistad
                    </td>
                    <td>
                        Nro. de Enviadas
                    </td>
                    <td>
                        <?= $solicitudesEnviadas ?>
                    </td>
                </tr>
                <tr class="danger">

                    <td>
                        Solicitudes de Amistad
                    </td>
                    <td>
                        Nro. de Recibidas
                    </td>
                    <td>
                        <?= $solicitudesRecibidas ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Solicitudes de Amistad
                    </td>
                    <td>
                        Nro. de Enviadas Aceptadas
                    </td>
                    <td>
                        <?= $solicitudesEnviadasYAceptadas ?>
                    </td>
                </tr>
                <tr class="active">

                    <td>
                        Solicitudes de Amistad
                    </td>
                    <td>
                        Nro. de Recibidas Aceptadas
                    </td>
                    <td>
                        <?= $solicitudesRecibidasYAceptadas ?>
                    </td>
                </tr>
                <tr class="success">

                    <td>
                        Solicitudes de Amistad
                    </td>
                    <td>
                        Nro. de Enviadas Pendientes
                    </td>
                    <td>
                        <?= $solicitudesEnviadasPendientes ?>
                    </td>
                </tr>
                <tr class="warning">

                    <td>
                        Solicitudes de Amistad
                    </td>
                    <td>
                        Nro. de Recibidas Pendientes
                    </td>
                    <td>
                        <?= $solicitudesRecibidasPendientes ?>
                    </td>
                </tr>
                <tr class="danger">

                    <td>
                        Publicaciones
                    </td>
                    <td>
                        Mis Publicaciones
                    </td>
                    <td>
                        <?= $publicaciones ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Comentarios
                    </td>
                    <td>
                        Nro. de Comentarios Realizados
                    </td>
                    <td>
                        <?= $comentariosRealizados ?>
                    </td>
                </tr>
                <tr class="active">
                    <td>
                        Comentarios
                    </td>
                    <td>
                        Nro. de Comentarios Recibidos
                    </td>
                    <td>
                        <?= $comentariosRecibidos ?>
                    </td>
                </tr>
                <tr class="success">

                    <td>
                        Likes
                    </td>
                    <td>
                        Nro. de Likes Dados
                    </td>
                    <td>
                        <?= $likesRealizados ?>
                    </td>
                </tr>
                <tr class="warning">


                    <td>
                        Likes
                    </td>
                    <td>
                        Nro. de Likes Recibidos
                    </td>
                    <td>
                        <?= $likesRecibidos ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

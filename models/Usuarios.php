<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property integer $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $username
 * @property string $password
 * @property string $url
 * @property string $fecha_creacion
 * @property string $fecha_nacimiento
 * @property string $sexo
 *
 * @property Amigos[] $amigos
 * @property Amigos[] $amigos0
 * @property Comentarios[] $comentarios
 * @property Grupos[] $grupos
 * @property Likes[] $likes
 * @property Publicaciones[] $publicacions
 * @property Mensajes[] $mensajes
 * @property MensajesOcultos[] $mensajesOcultos
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombres', 'apellidos', 'username', 'password', 'fecha_nacimiento', 'sexo'], 'required'],
            [['fecha_creacion', 'fecha_nacimiento'], 'safe'],
            [['nombres', 'apellidos', 'username', 'password', 'url'], 'string', 'max' => 255],
            [['sexo'], 'string', 'max' => 1],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'username' => 'Username(Correo electronico)',
            'password' => 'Password',
            'url' => 'Url',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'sexo' => 'Sexo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmigos()
    {
        return $this->hasMany(Amigos::className(), ['emisor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmigos0()
    {
        return $this->hasMany(Amigos::className(), ['receptor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['usuario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupos::className(), ['participante_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Likes::className(), ['usuario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacions()
    {
        return $this->hasMany(Publicaciones::className(), ['id' => 'publicacion_id'])->viaTable('likes', ['usuario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensajes()
    {
        return $this->hasMany(Mensajes::className(), ['usuario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensajesOcultos()
    {
        return $this->hasMany(MensajesOcultos::className(), ['id_usuario' => 'id']);
    }
}

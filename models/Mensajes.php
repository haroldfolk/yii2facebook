<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mensajes".
 *
 * @property integer $id
 * @property string $contenido
 * @property integer $usuario_id
 * @property integer $conversacion_id
 *
 * @property Conversaciones $conversacion
 * @property Usuarios $usuario
 * @property MensajesOcultos[] $mensajesOcultos
 */
class Mensajes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mensajes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contenido', 'usuario_id', 'conversacion_id'], 'required'],
            [['usuario_id', 'conversacion_id'], 'integer'],
            [['contenido'], 'string', 'max' => 255],
            [['conversacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Conversaciones::className(), 'targetAttribute' => ['conversacion_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contenido' => 'Contenido',
            'usuario_id' => 'Usuario ID',
            'conversacion_id' => 'Conversacion ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConversacion()
    {
        return $this->hasOne(Conversaciones::className(), ['id' => 'conversacion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensajesOcultos()
    {
        return $this->hasMany(MensajesOcultos::className(), ['id_mensaje' => 'id']);
    }
}

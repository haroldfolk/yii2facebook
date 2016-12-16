<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupos".
 *
 * @property integer $id
 * @property integer $conversacion_id
 * @property integer $participante_id
 * @property integer $notificaciones
 *
 * @property Conversaciones $conversacion
 * @property Usuarios $participante
 */
class Grupos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['conversacion_id', 'participante_id', 'notificaciones'], 'required'],
            [['conversacion_id', 'participante_id', 'notificaciones'], 'integer'],
            [['conversacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Conversaciones::className(), 'targetAttribute' => ['conversacion_id' => 'id']],
            [['participante_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['participante_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'conversacion_id' => 'Conversacion ID',
            'participante_id' => 'Participante ID',
            'notificaciones' => 'Notificaciones',
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
    public function getParticipante()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'participante_id']);
    }

    public function devolverConversacion($id, $id2)
    {
        $listaDeCvs = Grupos::find()->select('conversacion_id')->where(['participante_id' => $id])->all();
        $listaDeCVentre = Grupos::find()->where(['participante_id' => $id2, 'conversacion_id' => $listaDeCvs])->all();
        foreach ($listaDeCVentre as $laCV) {
            $contadorDeParticipante = Grupos::find()->where(['conversacion_id' => $laCV->conversacion_id])->all();
            if (count($contadorDeParticipante) == 2) {
                return $laCV->conversacion_id;
            }
        }
        return 0;
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "participantes".
 *
 * @property integer $id
 * @property string $nombre_participante
 *
 * @property Participaciones[] $participaciones
 */
class Participantes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'participantes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_participante'], 'required'],
            [['nombre_participante'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_participante' => 'Nombre Participante',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipaciones()
    {
        return $this->hasMany(Participaciones::className(), ['id_participante' => 'id'])->inverseOf('idParticipante');
    }
}

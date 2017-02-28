<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "roles".
 *
 * @property integer $id
 * @property string $nombre_rol
 *
 * @property Participaciones[] $participaciones
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_rol'], 'required'],
            [['nombre_rol'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_rol' => 'Nombre Rol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipaciones()
    {
        return $this->hasMany(Participaciones::className(), ['id_rol' => 'id'])->inverseOf('idRol');
    }
}

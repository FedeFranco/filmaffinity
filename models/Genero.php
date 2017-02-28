<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genero".
 *
 * @property integer $id
 * @property string $nombre_genero
 */
class Genero extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genero';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_genero'], 'required'],
            [['nombre_genero'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_genero' => 'Nombre Genero',
        ];
    }

    public function getParticipaciones()
    {
        return $this->hasMany(Participacion::className(), ['id_genero' => 'id'])->inverseOf('idGenero');
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "peliculas".
 *
 * @property integer $id
 * @property string $titulo
 * @property string $descricion
 *
 * @property Participaciones[] $participaciones
 */
class Pelicula extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'peliculas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'descricion'], 'required'],
            [['descricion'], 'string'],
            [['titulo'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'descricion' => 'Descricion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipaciones()
    {
        return $this->hasMany(Participacion::className(), ['id_pelicula' => 'id'])->inverseOf('idPelicula');
    }
}

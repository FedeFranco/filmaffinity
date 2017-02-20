<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "participaciones".
 *
 * @property integer $id
 * @property integer $id_participante
 * @property integer $id_rol
 * @property integer $id_pelicula
 *
 * @property Participantes $idParticipante
 * @property Peliculas $idPelicula
 * @property Roles $idRol
 */
class Participacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'participaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_participante', 'id_rol', 'id_pelicula'], 'integer'],
            [['id_participante'], 'exist', 'skipOnError' => true, 'targetClass' => Participantes::className(), 'targetAttribute' => ['id_participante' => 'id']],
            [['id_pelicula'], 'exist', 'skipOnError' => true, 'targetClass' => Peliculas::className(), 'targetAttribute' => ['id_pelicula' => 'id']],
            [['id_rol'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['id_rol' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_participante' => 'Id Participante',
            'id_rol' => 'Id Rol',
            'id_pelicula' => 'Id Pelicula',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdParticipante()
    {
        return $this->hasOne(Participantes::className(), ['id' => 'id_participante'])->inverseOf('participacions');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPelicula()
    {
        return $this->hasOne(Peliculas::className(), ['id' => 'id_pelicula'])->inverseOf('participacions');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRol()
    {
        return $this->hasOne(Roles::className(), ['id' => 'id_rol'])->inverseOf('participacions');
    }
}

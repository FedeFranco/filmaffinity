<?php

namespace app\models;

use app\models\Pelicula;
use app\models\Genero;
use app\models\Rol;
use app\models\Participante;
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
            [['id_participante', 'id_rol', 'id_pelicula','id_genero'], 'integer'],
            [['id_participante'], 'exist', 'skipOnError' => true, 'targetClass' => Participante::className(), 'targetAttribute' => ['id_participante' => 'id']],
            [['id_pelicula'], 'exist', 'skipOnError' => true, 'targetClass' => Pelicula::className(), 'targetAttribute' => ['id_pelicula' => 'id']],
            [['id_rol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['id_rol' => 'id']],
            [['id_genero'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::className(), 'targetAttribute' => ['id_genero' => 'id']],
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
            'id_genero' => 'Id Genero',
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
        return $this->hasOne(Pelicula::className(), ['id' => 'id_pelicula'])->inverseOf('participaciones');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRol()
    {
        return $this->hasOne(Rol::className(), ['id' => 'id_rol'])->inverseOf('participaciones');
    }

    public function getIdGenero()
    {
        return $this->hasOne(Genero::className(), ['id' => 'id_genero'])->inverseOf('participaciones');
    }
}

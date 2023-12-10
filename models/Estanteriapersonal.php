<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estanteriapersonal".
 *
 * @property int $estanteria_id
 * @property int $libro_id
 *
 * @property Estanteria $estanteria
 * @property Libro $libro
 */
class Estanteriapersonal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estanteriapersonal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estanteria_id', 'libro_id'], 'required'],
            [['estanteria_id', 'libro_id'], 'integer'],
            [['estanteria_id', 'libro_id'], 'unique', 'targetAttribute' => ['estanteria_id', 'libro_id']],
            [['libro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Libro::class, 'targetAttribute' => ['libro_id' => 'id']],
            [['estanteria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estanteria::class, 'targetAttribute' => ['estanteria_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'estanteria_id' => 'Estanteria ID',
            'libro_id' => 'Libro ID',
        ];
    }

    /**
     * Gets query for [[Estanteria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstanteria()
    {
        return $this->hasOne(Estanteria::class, ['id' => 'estanteria_id']);
    }

    /**
     * Gets query for [[Libro]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLibro()
    {
        return $this->hasOne(Libro::class, ['id' => 'libro_id']);
    }
}

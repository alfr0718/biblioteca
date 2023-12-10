<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estanteria".
 *
 * @property int $id
 * @property string $Nombre
 * @property string $user_id
 *
 * @property Estanteriapersonal[] $estanteriapersonals
 * @property Libro[] $libros
 */
class Estanteria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estanteria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nombre', 'user_id'], 'required'],
            [['Nombre', 'user_id'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Nombre' => 'Nombre',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Estanteriapersonals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstanteriapersonals()
    {
        return $this->hasMany(Estanteriapersonal::class, ['estanteria_id' => 'id']);
    }

    /**
     * Gets query for [[Libros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLibros()
    {
        return $this->hasMany(Libro::class, ['id' => 'libro_id'])->viaTable('estanteriapersonal', ['estanteria_id' => 'id']);
    }
}

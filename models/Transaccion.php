<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaccion".
 *
 * @property int $id
 * @property int $user_id
 * @property string $action
 * @property string $nombre_tabla
 * @property string $time
 */
class Transaccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'action', 'nombre_tabla'], 'required'],
            [['user_id'], 'integer'],
            [['time'], 'safe'],
            [['action', 'nombre_tabla'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'action' => 'Action',
            'nombre_tabla' => 'Nombre Tabla',
            'time' => 'Time',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authassignmentrole".
 *
 * @property int $id
 * @property int $idusername
 * @property int $role_id
 * @property string|null $Created_at
 * @property string $Updated_at
 *
 * @property User $idusername0
 * @property Authrole $role
 */
class Authassignmentrole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authassignmentrole';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idusername', 'role_id'], 'required'],
            [['idusername', 'role_id'], 'integer'],
            [['Created_at', 'Updated_at'], 'safe'],
            [['idusername'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['idusername' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Authrole::class, 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idusername' => 'Idusername',
            'role_id' => 'Role ID',
            'Created_at' => 'Created At',
            'Updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Idusername0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdusername0()
    {
        return $this->hasOne(User::class, ['id' => 'idusername']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Authrole::class, ['id' => 'role_id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authrole".
 *
 * @property int $id
 * @property string $Name_role
 * @property string|null $Description
 * @property string|null $Created_at
 * @property string $Updated_at
 *
 * @property Authassignmentrole[] $authassignmentroles
 */
class Authrole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authrole';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name_role'], 'required'],
            [['Created_at', 'Updated_at'], 'safe'],
            [['Name_role'], 'string', 'max' => 64],
            [['Description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name_role' => 'Name Role',
            'Description' => 'Description',
            'Created_at' => 'Created At',
            'Updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Authassignmentroles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthassignmentroles()
    {
        return $this->hasMany(Authassignmentrole::class, ['role_id' => 'id']);
    }
}

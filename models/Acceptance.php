<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acceptance".
 *
 * @property int $id
 * @property int $year
 * @property int $is_open
 *
 * @property AcceptanceClass[] $acceptanceClasses
 * @property User[] $users
 */
class Acceptance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acceptance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year', 'is_open'], 'required'],
            [['year', 'is_open'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'Year',
            'is_open' => 'Is Open',
        ];
    }

    /**
     * Gets query for [[AcceptanceClasses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAcceptanceClasses()
    {
        return $this->hasMany(AcceptanceClass::className(), ['acceptance_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['acceptance_id' => 'id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acceptance_class".
 *
 * @property int $id
 * @property int $number_seats
 * @property int $acceptance_id
 * @property int|null $document_set_id
 * @property string $name
 * @property string $description
 *
 * @property Acceptance $acceptance
 */
class AcceptanceClass extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acceptance_class';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number_seats', 'acceptance_id', 'name', 'description'], 'required'],
//            [['class_id', 'acceptance_id', 'document_set_id'], 'integer'],
//            [['description'], 'string'],
//            [['name'], 'string', 'max' => 255],
//            [['acceptance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Acceptance::class, 'targetAttribute' => ['acceptance_id' => 'id']],
//            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClassGroup::class, 'targetAttribute' => ['class_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_id' => 'Class ID',
            'acceptance_id' => 'Acceptance ID',
            'document_set_id' => 'Document Set ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Acceptance]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAcceptance()
    {
        return $this->hasOne(Acceptance::className(), ['id' => 'acceptance_id']);
    }
}

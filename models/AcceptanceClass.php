<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acceptance_class".
 *
 * @property int $id
 * @property int $class_id
 * @property int $acceptance_id
 * @property int $document_set_id
 *
 * @property Acceptance $acceptance
 * @property ClassGroup $class
 * @property DocumentSet|null $documentSet
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
            [['class_id', 'acceptance_id'], 'required'],
            [['class_id', 'acceptance_id', 'document_set_id'], 'integer'],
            [['acceptance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Acceptance::class, 'targetAttribute' => ['acceptance_id' => 'id']],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClassGroup::class, 'targetAttribute' => ['class_id' => 'id']],
            [['document_set_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentSet::class, 'targetAttribute' => ['document_set_id' => 'id']],
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
        ];
    }

    /**
     * Gets query for [[Acceptance]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAcceptance()
    {
        return $this->hasOne(Acceptance::class, ['id' => 'acceptance_id']);
    }

    /**
     * Gets query for [[Class]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(ClassGroup::class, ['id' => 'class_id']);
    }

    /**
     * Gets query for [[DocumentSet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentSet()
    {
        return $this->hasOne(DocumentSet::class, ['id' => 'document_set_id']);
    }
}

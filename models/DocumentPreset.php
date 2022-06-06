<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document_preset".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int|null $file_id
 *
 * @property DocumentSetToPreset[] $documentSetToPresets
 * @property File $file
 */
class DocumentPreset extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document_preset';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['file_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['file_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'file_id' => 'File ID',
        ];
    }

    /**
     * Gets query for [[DocumentSetToPresets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentSetToPresets()
    {
        return $this->hasMany(DocumentSetToPreset::className(), ['document_preset_id' => 'id']);
    }

    /**
     * Gets query for [[File]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::className(), ['id' => 'file_id']);
    }
}

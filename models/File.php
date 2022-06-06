<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property string $type
 *
 * @property DocumentPreset[] $documentPresets
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'path', 'type'], 'required'],
            [['name', 'path', 'type'], 'string', 'max' => 255],
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
            'path' => 'Path',
            'type' => 'Type',
        ];
    }

    /**
     * Gets query for [[DocumentPresets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentPresets()
    {
        return $this->hasMany(DocumentPreset::className(), ['file_id' => 'id']);
    }
}

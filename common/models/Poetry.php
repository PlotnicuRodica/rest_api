<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "poetry".
 *
 * @property string $id
 * @property string $title
 * @property string $content
 * @property string $category_id
 */
class Poetry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poetry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'category_id'], 'required'],
            [['content'], 'string'],
            [['category_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'category_id' => 'Category ID',
        ];
    }
}

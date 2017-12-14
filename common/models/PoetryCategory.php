<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "poetry_category".
 *
 * @property string $id
 * @property string $name
 */
class PoetryCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poetry_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function read(){
/*
        // select all query
        $query = "SELECT
                p.id, p.name
            FROM
                poetry_category p              
            ORDER BY
                p.id DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
*/
    }
}

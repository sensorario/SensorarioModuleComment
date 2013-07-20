<?php

/**
 * This is the model class for table "sensorario_comments".
 *
 * @package Sensorario\Modules\SensorarioComments\Models
 * 
 * The followings are the available columns in table 'sensorario_comments':
 * @property integer $id
 * @property string $thread
 * @property string $comment
 * @property string $user
 */
class SensorarioCommentsModel extends CActiveRecord
{

    /**
     * @return string the associated database table name
     */
    public function tableName() {

        return 'sensorario_comments';

    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {

        return array(
            array('thread, user, comment', 'required'),
            array('thread', 'length', 'max' => 50),
            array('comment, user', 'safe'),
            array('id, thread, comment, user', 'safe', 'on' => 'search'),
        );

    }

    /**
     * @return array relational rules.
     */
    public function relations() {

        return array(
        );

    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {

        return array(
            'id' => 'ID',
            'thread' => 'Thread',
            'comment' => 'Comment',
            'user' => 'User',
        );

    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {

        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('thread', $this->thread, true);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('user', $this->user);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));

    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SensorarioCommentsModel the static model class
     */
    public static function model($className = __CLASS__) {

        return parent::model($className);

    }

    public function thread($thread) {

        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'thread=:thread',
            'params' => array(
                ':thread' => $thread
            )
        ));

        return $this;

    }

    public function recenti() {

        $this->getDbCriteria()->mergeWith(array(
            'order' => 'id desc',
            'limit' => 3
        ));

        return $this;

    }

}

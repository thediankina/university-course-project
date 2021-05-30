<?php

/**
 * This is the model class for table "db_faq".
 *
 * The followings are the available columns in table 'db_faq':
 * @property integer $id
 * @property string $question
 * @property string $answer
 * @property integer $id_category
 * @property integer $id_author
 */
class FAQForm extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'db_faq';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('question, answer, id_category, id_author', 'required'),
			array('id_category, id_author', 'numerical', 'integerOnly'=>true),
			array('question, answer', 'length', 'max'=>200),
			array('id, question, answer, id_category, id_author', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'category' => array(self::HAS_ONE, 'CategoryFAQ', array('id' => 'id_category')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'question' => 'Вопрос',
			'answer' => 'Ответ',
			'id_category' => 'Id Category',
			'id_author' => 'Id Author',
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
	public function search()
	{
		$criteria=new CDbCriteria;

        $criteria->with = array('category');
		$criteria->compare('id',$this->id);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('answer',$this->answer,true);
        $criteria->compare('"t".id',$this->id_category);
		$criteria->compare('id_author',$this->id_author);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FAQForm the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

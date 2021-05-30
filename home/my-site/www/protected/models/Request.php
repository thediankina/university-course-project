<?php

/**
 * This is the model class for table "db_request".
 *
 * The followings are the available columns in table 'db_request':
 * @property integer $id
 * @property string $name
 * @property integer $id_category
 * @property string $body
 * @property integer $city
 * @property string $email
 * @property integer $phone
 * @property string $comment
 * @property string $status
 * @property string subject
 */
class Request extends CActiveRecord
{
    /**
     * @var array|mixed|null
     */

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'db_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name, id_category, body, city, status', 'required'),
			array('id_category, phone', 'numerical', 'integerOnly'=>true),
			array('email, status, subject', 'length', 'max'=>20),
			array('comment', 'length', 'max'=>100),
			array('id, name, id_category, body, city, email, phone, comment, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'category' => array(self::HAS_ONE, 'CategoryRequest', array('id' => 'id_category')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'name' => 'Имя/Псевдоним',
			'id_category' => '№ категории',
			'body' => 'Описание',
            'city' => 'Город',
			'email' => 'Почта',
			'phone' => 'Телефон',
			'comment' => 'Комментарий',
			'status' => 'Статус',
            'subject' => 'Назначено',
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

        $criteria->with = array('category, specialist');
		$criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name);
		$criteria->compare('"t".id',$this->id_category);
		$criteria->addCondition('"t".priority');
        $criteria->compare('city',$this->city);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('subject',$this->subject,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Request the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

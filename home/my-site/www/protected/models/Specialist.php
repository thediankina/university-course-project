<?php

/**
 * This is the model class for table "db_specialist".
 *
 * The followings are the available columns in table 'db_specialist':
 * @property integer $id
 * @property string $firstName
 * @property string $middleName
 * @property string $lastName
 * @property string $phone
 * @property string $email
 * @property integer $id_city
 * @property integer $id_position
 */
class Specialist extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'db_specialist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('firstName, lastName, email, id_city, id_position', 'required'),
			array('id_city, id_position', 'numerical', 'integerOnly'=>true),
			array('firstName, middleName, lastName, email', 'length', 'max'=>45),
			array('phone', 'length', 'max'=>11),
			array('id, firstName, middleName, lastName, phone, email, id_city, id_position', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'firstName' => 'First Name',
			'middleName' => 'Middle Name',
			'lastName' => 'Фамилия',
			'phone' => 'Phone',
			'email' => 'Email',
			'id_city' => 'Id City',
			'id_position' => 'Id Position',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('middleName',$this->middleName,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('id_city',$this->id_city);
		$criteria->compare('id_position',$this->id_position);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Specialist the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

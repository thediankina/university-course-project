<?php

/**
 * This is the model class for table "tbl_request".
 *
 * The followings are the available columns in table 'tbl_request':
 * @property integer $id
 * @property integer $id_category
 * @property string $request_date
 * @property string $info
 * @property string $mail
 * @property integer $phone
 * @property string $status
 */
class Request extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_category, request_date, info', 'required'),
			array('id_category, phone', 'numerical', 'integerOnly'=>true),
			array('mail, status', 'length', 'max'=>20),
			// The following rule is used by search().
			array('id, id_category, request_date, info, mail, phone, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'id_category' => '№ категории',
			'request_date' => 'Дата обращения',
			'info' => 'Описание',
			'mail' => 'E-mail',
			'phone' => 'Телефон',
			'status' => 'Статус',
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
		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('request_date',$this->request_date,true);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('status',$this->status,true);

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

<?php

/**
 * This is the model class for table "phpbb_users".
 *
 * The followings are the available columns in table 'phpbb_users':
 * @property integer $user_id
 * @property string $username
 * @property string $user_password
 * @property string $user_email
 */
class User extends CActiveRecord
{
    /**
     * @var array|CList|int|mixed|null
     */

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'phpbb_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, user_password, user_email', 'required'),
			array('username, user_password, user_email', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, username, user_password, user_email', 'safe', 'on'=>'search'),
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
			'user_id' => 'ID',
			'username' => 'Ваш логин',
			'user_password' => 'Ваш пароль',
			'user_email' => 'Ваш email',
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->user_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('user_password',$this->user_password,true);
		$criteria->compare('user_email',$this->user_email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**  protected function afterSave() {
        if ($this->isNewRecord) {
            // Регистрация нового пользователя на форуме
            // Логин, пароль(не захешированный), email, ID группы на форуме(по умолчанию 2-обычный пользователь, 5-администратор)
            Yii::app()->phpBB->userAdd($this->username, $this->password, $this->email, 2);
        }

        parent::afterSave();
    }

    protected function afterDelete() {
        // Удаляем пользователя с форума
        Yii::app()->phpBB->userDelete($this->username);

        parent::afterDelete();
    }*/
}

<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    /**
     * The crypt function/replacement
     */
    function _hash_crypt_private($password, $setting, &$itoa64)
    {
        $output = '*';

        // Check for correct hash
        if (substr($setting, 0, 3) != '$H$' && substr($setting, 0, 3) != '$P$')
        {
            return $output;
        }

        $count_log2 = strpos($itoa64, $setting[3]);

        if ($count_log2 < 7 || $count_log2 > 30)
        {
            return $output;
        }

        $count = 1 << $count_log2;
        $salt = substr($setting, 4, 8);

        if (strlen($salt) != 8)
        {
            return $output;
        }

        /**
         * We're kind of forced to use MD5 here since it's the only
         * cryptographic primitive available in all versions of PHP
         * currently in use.  To implement our own low-level crypto
         * in PHP would result in much worse performance and
         * consequently in lower iteration counts and hashes that are
         * quicker to crack (by non-PHP code).
         */
        if (PHP_VERSION >= 5)
        {
            $hash = md5($salt . $password, true);
            do
            {
                $hash = md5($hash . $password, true);
            }
            while (--$count);
        }
        else
        {
            $hash = pack('H*', md5($salt . $password));
            do
            {
                $hash = pack('H*', md5($hash . $password));
            }
            while (--$count);
        }

        $output = substr($setting, 0, 12);
        $output .= self::_hash_encode64($hash, 16, $itoa64);

        return $output;
    }
    /**
     * Check for correct password
     *
     * @param string $password The password in plain text
     * @param string $hash The stored password hash
     *
     * @return bool Returns true if the password is correct, false if not.
     */
    function phpbb_check_hash($password, $hash)
    {
        $itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        if (strlen($hash) == 34)
        {
            return (self::_hash_crypt_private($password, $hash, $itoa64) === $hash) ? true : false;
        }

        return (md5($password) === $hash) ? true : false;
    }
    /**
     * Encode hash
     */
    function _hash_encode64($input, $count, &$itoa64)
    {
        $output = '';
        $i = 0;

        do
        {
            $value = ord($input[$i++]);
            $output .= $itoa64[$value & 0x3f];

            if ($i < $count)
            {
                $value |= ord($input[$i]) << 8;
            }

            $output .= $itoa64[($value >> 6) & 0x3f];

            if ($i++ >= $count)
            {
                break;
            }

            if ($i < $count)
            {
                $value |= ord($input[$i]) << 16;
            }

            $output .= $itoa64[($value >> 12) & 0x3f];

            if ($i++ >= $count)
            {
                break;
            }

            $output .= $itoa64[($value >> 18) & 0x3f];
        }
        while ($i < $count);

        return $output;
    }
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$users=User::model()->findByAttributes(array(
		        'username'=>$this->username
        ));
		if($users===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif(!$this->phpbb_check_hash($this->password, $users->user_password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
}
<?php
if(session_id() == '' || !isset($_SESSION)) {
    session_start();
}
include_once "db_con.php";
include_once "phpmailer/class.phpmailer.php";

if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=="127.0.0.1" || $_SERVER['HTTP_HOST']=="192.168.1.1"  || $_SERVER['HTTP_HOST']=="[::1]") {
    define('ADMIN_EMAIL','parash@dsvinfosolutions.com');
    define('MAIL_FROM','parash@dsvinfosolutions.com');
    define('MAIL_TO','parash@dsvinfosolutions.com');
    define('BASE_URL','http://localhost/kss/');
    define('Conact_us','<br><br>for more Information please contact us:<a href=\'info@kssprograms.com\'>info@kssprograms.com</a>');
}else{
    define('ADMIN_EMAIL','dsvinfosolutions@gmail.com');
    define('MAIL_FROM','parash@dsvinfosolutions.com');
    define('MAIL_TO','parash@dsvinfosolutions.com');
    define('BASE_URL','http://dsvinfosolutions.com/kss/');
    define('Conact_us','<br><br>for more Information please contact us:<a href=\'info@kssprograms.com\'>info@kssprograms.com</a>');
}

function uniqueString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function send_mail($to=MAIL_TO,$sub='',$msg='',$headers=''){
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'dsvinfosolutions@gmail.com';                 // SMTP username
    $mail->Password = 'latest@123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom(ADMIN_EMAIL, 'KSS');
    if(is_array($to)){
        foreach ($to as $t){
            $mail->addAddress($t, 'Dear');
        }
    }else{
        $mail->addAddress($to, 'Dear');     // Add a recipient
    }
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $sub;
    $mail->Body    = $msg;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if($mail->send())
    {
        return true;
    }else{
        return false;
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('password_hash'))
{
    /**
     * password_hash()
     *
     * @link	http://php.net/password_hash
     * @param	string	$password
     * @param	int	$algo
     * @param	array	$options
     * @return	mixed
     */
    function password_hash($password, $algo, array $options = array())
    {
        static $func_override;
        isset($func_override) OR $func_override = (extension_loaded('mbstring') && ini_get('mbstring.func_override'));

        if ($algo !== 1)
        {
            trigger_error('password_hash(): Unknown hashing algorithm: '.(int) $algo, E_USER_WARNING);
            return NULL;
        }

        if (isset($options['cost']) && ($options['cost'] < 4 OR $options['cost'] > 31))
        {
            trigger_error('password_hash(): Invalid bcrypt cost parameter specified: '.(int) $options['cost'], E_USER_WARNING);
            return NULL;
        }

        if (isset($options['salt']) && ($saltlen = ($func_override ? mb_strlen($options['salt'], '8bit') : strlen($options['salt']))) < 22)
        {
            trigger_error('password_hash(): Provided salt is too short: '.$saltlen.' expecting 22', E_USER_WARNING);
            return NULL;
        }
        elseif ( ! isset($options['salt']))
        {
            if (function_exists('random_bytes'))
            {
                try
                {
                    $options['salt'] = random_bytes(16);
                }
                catch (Exception $e)
                {
                    log_message('error', 'compat/password: Error while trying to use random_bytes(): '.$e->getMessage());
                    return FALSE;
                }
            }
            elseif (defined('MCRYPT_DEV_URANDOM'))
            {
                $options['salt'] = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
            }
            elseif (DIRECTORY_SEPARATOR === '/' && (is_readable($dev = '/dev/arandom') OR is_readable($dev = '/dev/urandom')))
            {
                if (($fp = fopen($dev, 'rb')) === FALSE)
                {
                    log_message('error', 'compat/password: Unable to open '.$dev.' for reading.');
                    return FALSE;
                }

                // Try not to waste entropy ...
                is_php('5.4') && stream_set_chunk_size($fp, 16);

                $options['salt'] = '';
                for ($read = 0; $read < 16; $read = ($func_override) ? mb_strlen($options['salt'], '8bit') : strlen($options['salt']))
                {
                    if (($read = fread($fp, 16 - $read)) === FALSE)
                    {
                        log_message('error', 'compat/password: Error while reading from '.$dev.'.');
                        return FALSE;
                    }
                    $options['salt'] .= $read;
                }

                fclose($fp);
            }
            elseif (function_exists('openssl_random_pseudo_bytes'))
            {
                $is_secure = NULL;
                $options['salt'] = openssl_random_pseudo_bytes(16, $is_secure);
                if ($is_secure !== TRUE)
                {
                    log_message('error', 'compat/password: openssl_random_pseudo_bytes() set the $cryto_strong flag to FALSE');
                    return FALSE;
                }
            }
            else
            {
                log_message('error', 'compat/password: No CSPRNG available.');
                return FALSE;
            }

            $options['salt'] = str_replace('+', '.', rtrim(base64_encode($options['salt']), '='));
        }
        elseif ( ! preg_match('#^[a-zA-Z0-9./]+$#D', $options['salt']))
        {
            $options['salt'] = str_replace('+', '.', rtrim(base64_encode($options['salt']), '='));
        }

        isset($options['cost']) OR $options['cost'] = 10;

        return (strlen($password = crypt($password, sprintf('$2y$%02d$%s', $options['cost'], $options['salt']))) === 60)
            ? $password
            : FALSE;
    }
}

// ------------------------------------------------------------------------


// ------------------------------------------------------------------------

if ( ! function_exists('password_verify'))
{
    /**
     * password_verify()
     *
     * @link	http://php.net/password_verify
     * @param	string	$password
     * @param	string	$hash
     * @return	bool
     */
    function password_verify($password, $hash)
    {
        if (strlen($hash) !== 60 OR strlen($password = crypt($password, $hash)) !== 60)
        {
            return FALSE;
        }

        $compare = 0;
        for ($i = 0; $i < 60; $i++)
        {
            $compare |= (ord($password[$i]) ^ ord($hash[$i]));
        }

        return ($compare === 0);
    }
}

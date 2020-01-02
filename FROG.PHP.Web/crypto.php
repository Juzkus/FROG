<?php
# Thank you, kind internet friends :)
# https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string/13733588#13733588#answer-13733588

function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}

###############
# Create Guids
###############

function create_session_setup_guid()
{
	return getToken(SESSION_SETUP_GUID_SIZE);
}

function create_session_guid()
{
	return getToken(SESSION_ID_SIZE);
}

function create_primary_guid()
{
	return getToken(PRIMARY_ID_SIZE);
}

?>
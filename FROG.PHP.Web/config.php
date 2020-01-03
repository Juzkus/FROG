<?php
# A great place for some settings!

# ID Sizes
define('PRIMARY_ID_SIZE', 32);
define('SESSION_SETUP_GUID_SIZE', 255);
define('SESSION_ID_SIZE', PRIMARY_ID_SIZE);

# USER Roles
define('REG_USER', 0);
define('MOD_USER', 1);
define('SIM_USER', 2);
define('ADMIN_USER', 3);

# Database
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'FROG');
define('DB_RW_USER', 'root');
define('DB_RW_PASS', '');

# USER Lookup Types
define('USER_ID_LOOKUP', 0);
define('USER_NAME_LOOKUP', 1);
define('USER_EMAIL_LOOKUP', 2);

?>
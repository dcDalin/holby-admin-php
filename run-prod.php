<?php
// Set Site Directory to prod
$siteDirectory = fopen("sys/core/site.directory.php", "w") or die("Unable to open site dir!");
$siteScript = "
<?php
\$SITE_DIRECTORY = '';
?>
";
fwrite($siteDirectory, $siteScript);
fclose($siteDirectory);

$envVariables = fopen("env-variables.php", "w") or die("Unable to open file!");
$envScript = "
<?php 
\$SUPER_USER_EMAIL = array('mcdalinoluoch@gmail.com', 'holbyinvestment@gmail.com ');
\$ADMIN_NOTIFICATIONS_EMAIL = 'mcdalinoluoch@gmail.com';

\$DB_HOST = 'localhost';
\$DB_USER = 'holbytra_root';
\$DB_NAME = 'holbytra_holby';
\$DB_PASS = 'Password123!!!';

\$WEBSITE_URL = 'http://admin.holbytrainingsolution.co.ke';

\$EMAIL_USERNAME = 'noreply@holbytrainingsolution.co.ke';
\$EMAIL_PASSWORD = 'Password123!!!';
\$EMAIL_HOST = 'mail.holbytrainingsolution.co.ke';
\$EMAIL_PORT = 26;
?>
";
fwrite($envVariables, $envScript);
fclose($envVariables);
?>
<?php

print shell_exec('/usr/bin/php -q parseRSS.php &');
/*putenv("SHELL=/bin/bash");
print `echo /usr/bin/php -q longThing.php | at now 2>&1`;*/

?>
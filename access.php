AuthUserFile /home.40/f/r/a/francoiszx/www/GCM/htmdp/.htpasswd
AuthGroupFile /dev/null
AuthName "Veuillez vous identifier"
AuthType Basic

<Limit GET POST>
require valid-user
</Limit>
#/bin/bash
ln -s /var/www/html/timezone.help/site.conf /etc/apache2/sites-available/timezone.help.conf
a2ensite timezone.help
service apache2 reload

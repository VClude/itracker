curl "https://api.findmespot.com/spot-main-web/consumer/rest-api/2.0/public/feed/0PcxybRdUaTdJ72LJuv5kXGPq7eGObYBF/message.xml" > /var/www/itracker/message.xml
URLE = http://127.0.0.1/
DATEVAR=`date +20\%y\%m\%d_\%H\%M\%S`
echo "feeding data " >> /var/www/html/itracker/feed.log
echo $DATEVAR >> /var/www/html/itracker/feed.log


/usr/bin/curl http://127.0.0.1/itracker/asd.php

DATEVAR=`date +20\%y\%m\%d_\%H\%M\%S`
echo "updating database " >> /var/www/html/itracker/feed.log
echo $DATEVAR >> /var/www/html/itracker/feed.log


/usr/bin/curl http://127.0.0.1/itracker/dsa.php

curl "https://api.findmespot.com/spot-main-web/consumer/rest-api/2.0/public/feed/0PcxybRdUaTdJ72LJuv5kXGPq7eGObYBF/message.xml" > /var/www/itracker/message.xml

DATEVAR=`date +20\%y\%m\%d_\%H\%M\%S`
echo "feeding data " >> /var/www/itracker/feed.log
echo $DATEVAR >> /var/www/itracker/feed.log


/usr/bin/curl https://srv.nakulaproject.com/asd.php

DATEVAR=`date +20\%y\%m\%d_\%H\%M\%S`
echo "updating database " >> /var/www/itracker/feed.log
echo $DATEVAR >> /var/www/itracker/feed.log


/usr/bin/curl https://srv.nakulaproject.com/dsa.php


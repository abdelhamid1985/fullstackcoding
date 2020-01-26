Selected coding challenge: FullStack coding challenge

############## Used tools:

web : Laravel + php 7 + jquery + css3? + bootstrap based template
db: mariadb 10

############## Description

The geolocation is really an interesting field, Unfortunately all the available
solutions online are not free and use a quota on how many requests can be sent.
coding a new solution from scratch would be a big project and will take longer
time for a challenge, To avoid getting lost in searchs i've created local database
containing shops and worked on it.

############## Setup app for test:
Clone the app repo from github to /var/challenge/webchallenge
# git clone https://github.com/abdelhamid1985/fullstackcoding.git

restore the database  shop_db.sql    ( from app root dir )
from app root dir run
# mysql -uroot -pabcdef1985 -d shop < shop_db.sql.sql

copy webchallenge.conf from the app root dir to /etc/httpd/conf.d/webchallenge.conf

Finally, Restart apache
service httpd restart

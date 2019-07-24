echo "Installing all required packages"
echo "Installing apache2"
sudo apt update
sudo apt install apache2

echo
echo "Installing PHP"
sudo apt-get install php

echo
echo "Installing Python"
sudo apt install python

echo
echo "Creating Directory"
sudo mkdir -p /var/www/html

echo
echo "Creating required files"
sudo touch /var/www/html/com1-log.txt
sudo touch /var/www/html/com1saving.txt
sudo touch /var/www/html/filesaving.txt
sudo touch /var/www/html/log.txt
sudo touch /var/www/html/serviced.txt

echo 
echo "Changing modes for required files"
sudo chmod 666 /var/www/html/com1-log.txt
sudo chmod 666 /var/www/html/com1saving.txt
sudo chmod 666 /var/www/html/filesaving.txt
sudo chmod 666 /var/www/html/log.txt
sudo chmod 666 /var/www/html/serviced.txt

echo
echo "Git cloning neccessary files"

# todo add /ids chwon www-data - git issue notes

#!/bin/sh
apt-get -y install phantomjs screen
(crontab -l 2>/dev/null; echo "@reboot    screen -S server -d -m phantomjs --webdriver=4444") | crontab -
echo "Added scree phantomjs to crontab"
screen -S server -d -m phantomjs --webdriver=4444





/usr/local/bin/composer self-update
echo "" >> /home/vagrant/.bashrc
echo "PATH=$PATH:/home/vagrant/simplelance.dev/vendor/bin" >> /home/vagrant/.bashrc
echo "export PATH" >> /home/vagrant/.bashrc
echo Done!

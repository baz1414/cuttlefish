#!/usr/bin/env bash
export DEBIAN_FRONTEND=noninteractive

add-apt-repository -y ppa:ondrej/php
add-apt-repository -y ppa:nginx/stable

apt-get -y update
apt-get -y install nginx zip
apt-get -y install php7.3-cli php7.3-fpm php7.3-xdebug php7.3-xml

apt-get clean && apt-get -y autoremove &

curl -Ss https://getcomposer.org/installer | php
mv composer.phar /usr/bin/composer
pushd /vagrant
sudo -u vagrant -H composer install &
cp src/Configuration.php.dist src/Configuration.php -n
popd

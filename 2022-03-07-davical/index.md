DAViCal o Ubuntu
================

## About DAViCal
DAViCal is an application which runs on a server and hosts calenders with a graphical admininstratino interface but no graphical user interface. If you want to see your calender in the browser, you will need to get an extra program. 

## Installation
I mainly followed the installation instructions from the [DAViCal website](https://www.davical.org/installation.php)
I already had all prerequisites installed, but the command to install them would look something like this on ubuntu: 
<pre>
sudo apt install apache2 libapache2-mod-php7.0 php7.0 php7.0-pgsql postgresql python-certbot-apache
</pre>
Where `libapache2-mod-php7.0` and `php7.0-pgsql` are needed so that `apache` can communicate with `php` and `php` can communicate with `postgresql`, respectively. It might work to omit the `php` version numbers. One could use `apt search php | grep apache` to see which `php` version is current. 
<pre>
sudo apt install davical
sudo cp /etc/postgresql/9.5/main/pg_hba.conf /etc/postgresql/9.5/main/pg_hba.conf.bkp
echo -e "local \tdavical \tdavical_app \ttrust \nlocal \tdavical \tdavical_dba \ttrust" | sudo tee /etc/postgresql/9.5/main/pg_hba.conf
sudo cat /etc/postgresql/9.5/main/pg_hba.conf.bkp | sudo tee -a /etc/postgresql/9.5/main/pg_hba.conf > /dev/null
sudo chown postgres /etc/postgresql/9.5/main/environment /etc/postgresql/9.5/main/pg_hba.conf /etc/postgresql/9.5/main/pg_hba.conf.bkp /etc/postgresql/9.5/main/pg_ident.conf /etc/postgresql/9.5/main/postgresql.conf /etc/postgresql/9.5/main/postgresql.conf.bkp /etc/postgresql/9.5/main/start.conf
</pre>
Then, I installed davical, backed up the PostgreSQL configuration file and with the next two commands I prepend the two lines `local daviacl davical_app test` `local davical davical_dba trust`. 
(I tried to append these two lines, but as the installation instructions say, it doesn't work that way.)
Where `davical` is the database name `davical_app` and `davical_dba` are users (have a look at `/etc/postgresql/9.5/main/pg_hpa.conf` - it is lightly documented).
The last command in the above section changes the owner of some files to the `postgresql` user.
<pre>
sudo systemctl restart postgresql.service
sudo su postgres -c /usr/share/davical/dba/create-database.sh
sudo vim /etc/php/7.0/apache2/php.ini # include_path = ".:/usr/share/awl/inc"
sudo vim /etc/apache2/apache2.conf # www.davical.org/install.php
sudo vim /etc/davical/config.php # www.davical.org/install.php
sudo certbot --apache -d wlankabel.at,www.wlankabel.at,bestoked.at,www.bestoked.at,davical.wlankabel.at,calender.wlankabel.at
</pre>
Then, I restarted the PostgreSQL service (service = program running quietly in the background) so that the changed configuration file will take effect. And as the user `postgres` I executed the `create-database.sh` script which comes with the DAViCal installation. 
The next step is to include AWL ([Andrew's Web Libraries](https://gitlab.com/davical-project/awl.git)) such that PHP can read it because DAViCal depends on it. 



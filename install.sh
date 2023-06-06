#!/bin/bash
configure_database() {
    echo "create user projectadmin"
    read -p "Enter password for user projectadmin:" pw
    sudo mysql -e "CREATE USER 'projectadmin'@'localhost' IDENTIFIED BY '$pw'; GRANT USAGE ON *.* TO 'projectadmin'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;"
    sudo mysql -e "REVOKE ALL PRIVILEGES ON *.* FROM 'projectadmin'@'localhost'; REVOKE GRANT OPTION ON *.* FROM 'projectadmin'@'localhost'; GRANT RELOAD, CREATE USER ON *.* TO 'projectadmin'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;"
    sudo mysql -e "CREATE DATABASE IF NOT EXISTS Dbvocabulary DEFAULT CHARACTER SET utf8 COLLATE utf8_german2_ci;"
    sudo mysql -e "CREATE TABLE Dbvocabulary.mistake1 (vocabularyID int(11) NOT NULL, userid int(11) NOT NULL, mistake int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
    sudo mysql -e "CREATE TABLE Dbvocabulary.user (userID int(11) NOT NULL, username text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
    sudo mysql -e "INSERT INTO Dbvocabulary.user (userID, username) VALUES (1, 'projectadmin');"
    sudo mysql -e "CREATE TABLE Dbvocabulary.vocabulary (vocabularyID int(11) NOT NULL, language1 text NOT NULL, language2 text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
    sudo mysql -e "ALTER TABLE Dbvocabulary.mistake1 ADD PRIMARY KEY (vocabularyID);"
    sudo mysql -e "ALTER TABLE Dbvocabulary.user ADD PRIMARY KEY (userID);"
    sudo mysql -e "ALTER TABLE Dbvocabulary.vocabulary ADD PRIMARY KEY (vocabularyID);"
    sudo mysql -e "ALTER TABLE Dbvocabulary.mistake1 MODIFY vocabularyID int(11) NOT NULL AUTO_INCREMENT;"
    sudo mysql -e "ALTER TABLE Dbvocabulary.user MODIFY userID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;"
    sudo mysql -e "ALTER TABLE Dbvocabulary.vocabulary MODIFY vocabularyID int(11) NOT NULL AUTO_INCREMENT;"
    sudo mysql -e "GRANT ALL PRIVILEGES ON Dbvocabulary.* TO 'projectadmin'@'localhost' WITH GRANT OPTION; FLUSH PRIVILEGES;"
    sudo mysql_secure_installation
}

read -p "Enter apt for (Ubuntu, Debian) or dnf for (Fedora) as install method:" installmethod
if [ $installmethod == "apt" ]; then
    sudo apt-get install apache2 libapache2-mod-php php php-mysql php-mbstring mariadb-server php-xml
    configure_database
    echo "apt done"
elif [ $installmethod == "dnf" ]; then
    sudo dnf install httpd mariadb mariadb-server php php-cli php-php-gettext php-mbstring php-mcrypt php-mysqlnd php-pear php-curl php-gd php-xml php-bcmath php-zip
    sudo systemctl start httpd.service mariadb
    configure_database
    echo "dnf done"
else
    echo "Unsupported command: $installmethod"
fi
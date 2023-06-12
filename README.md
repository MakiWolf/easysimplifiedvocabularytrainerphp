# easysimplifiedvocabularytrainerphp

It is a vocabulary trainer written in php using pdo for database connection. Currently only one user account is supported. More will follow. It was written for private learning a time ago and now I want to open Source it. Note: This is an ongoing project and there will be improvements in future. It is still in alpha stadium and some variables and database tables will be renamed and changed. Check out in future!<br>
Note: This program will use normal sql users and its permessions, so all users that can login in, can also login in phpmyadmin. For mysql table restrictions we use table permissions here.

## install on Linux
Use the install.sh script to add the database and install the php and server modules

Currently it is tested on Fedora 38 but it should work on other Linux distributions as well.

If you want to try it copy the content of the src directory on the webspace

If the files are not located in project directory on server, you have to change the $folder variable on line 43 in the header.php file

## Roadmap
support multiple languages in user interface<br>
clean up code and move code to classes<br>
support multiple user accounts<br>
currently only utf8<br>

## Table structure - might be changed in future!
<b>table user</b>
<table><tr><td>userID</td><td>username</td></tr></table>
<b>table vocabulary</b>
<table><tr><td>vocabularyID</td><td>language1</td><td>language2</td></tr></table>
<b>table mistake[userid]</b>
<table><tr><td>vocabularyid</td><td>userid</td><td>mistake</td></tr></table>

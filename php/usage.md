``` bash
# https://xuanthulab.net/mang-network-bridge-trong-docker-ket-noi-cac-container-voi-nhau.html
Các tham số tạo, chạy container như đã biết trong phần trước, ở đây cụ thể là:

-d : container sau khi tạo chạy luôn ở chế độ nền.
--name c-php : container tạo ra và đặt luôn cho nó tên là c-php (Tương tác với container dễ đọc hơn khi sử dụng tên thay vì phải sử dụng mã hash id, nếu không đặt tên thì docker sinh ra tên ngẫu nhiên).
-h php đặt tên HOSTNAME của container là php
-v "/mycode/php":/home/phpcode thư mục trên máy host /mycode/php (với Windows đường dẫn theo OS này như "c:\path\mycode\php") được gắn vào container ở đường dẫn /home/phpcode.
php:7.3-fpm là image khởi tạo ra container, nếu image này chưa có nó tự động tải về.
```

```bash
# Tạo một container chạy PHP từ image php:7.3-fpm, đặt tên container này là c-php
cd php
./
├── mycode
│   └── test.php
└── usage.md
# install php container
docker run -d --name c-php -h php -v "/Users/datdao/Developer/Code/docker-exercise/php/mycode/php":/home/phpcode php:7.3-fpm
# vao ben trong container
docker exec -it c-php bash
  apt-get update && apt-get install nano vim iputils-ping -y
  cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
  nano /usr/local/etc/php/php.ini
  # extensions
  docker-php-ext-install pdo_mysql
  docker-php-ext-install mysqli
  php -m | grep mysql
docker restart c-php

# install apache2 container
docker pull httpd
docker run -di -p 8080:80 -p 443:443 --name c-httpd -h httpd -v "/Users/datdao/Developer/Code/docker-exercise/php/mycode/php":/home/phpcode httpd
docker exec -it c-httpd bash
  apt-get update & apt-get install nano vim iputils-ping -y
  nano /usr/local/apache2/conf/httpd.conf
  apachectl -k restart

# install mysql container
docker run -it -p 3308:3306 --network www-net --name c-mysql -h mysql -v "/Users/datdao/mydata_in_docker":/var/lib/mysql -e MYSQL_ROOT_PASSWORD=abc123 mysql

mysql -uroot -pabc123 -h127.0.0.1 -P3308 -e 'show global variables like "max_connections"';




#--network www-net container sẽ kết nối với mạng có tên www-net (cùng mạng với c-php, c-httpd)
#-e MYSQL_ROOT_PASSWORD=abc123 đặt password cho user root, quản trị mysql là abc123
#-v "/mycode/db":/var/lib/mysql nơi lưu trữ các database là ở thư mục /mycode/db của máy Host, làm điểu này để có không mất db khi cần xóa container, hoặc khi cần sử dụng lại các db cũ.
docker exec -it c-mysql bash #nhảy vào container
  apt-get update & apt-get install nano vim -y
  nano /etc/mysql/my.cnf
    [mysqld]
      default-authentication-plugin=mysql_native_password
  exit
docker restart c-mysql
docker exec -it c-mysql bash #nhảy vào container
  mysql -uroot -pabc123 #kết nối vào MySQL Server
    #Từ dấu nhắc MySQL, Tạo một user tên testuser với password là testpass
    CREATE USER 'testuser1'@'%' IDENTIFIED BY 'testpass1';
    #Tạo db có tên db_testdb
    create database db_testdb;
    #Cấp quyền cho user testuser trên db - db_testdb
    GRANT ALL PRIVILEGES ON db_testdb.* TO 'testuser1'@'%';
    flush privileges;
    show databases;            #Xem các database đang có, kết quả có db bạn vừa tạo
    # create new database
    create database wp_blog;
    GRANT ALL PRIVILEGES ON wp_blog.* TO 'testuser1'@'%';
    flush privileges;
    show databases;            #Xem các database đang có, kết quả có db bạn vừa tạo


# how to export all databases to
docker exec -it c-mysql bash
  mysql -uroot -pabc123
    mysqldump -u root -p wp_blog > /var/lib/mysql/bk/wp_blog-database-dump.sql

    SELECT host,user,authentication_string FROM mysql.user;

```
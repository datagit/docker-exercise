```bash
# https://phoenixnap.com/kb/mysql-docker-container
docker run --name=mysql_docker -d mysql/mysql-server:latest

docker ps -a
docker logs mysql_docker
# [Entrypoint] GENERATED ROOT PASSWORD: 1O1,HY3Dw@^gMY;5b7SigW;?4j3kw9^,


docker exec -it mysql_docker bash
  mysql -uroot -p1O1,HY3Dw@^gMY;5b7SigW;?4j3kw9^,
  ALTER USER 'root'@'localhost' IDENTIFIED BY '123456';

# run image
docker run \
--detach \
--name=mysql_docker \
--env="MYSQL_ROOT_PASSWORD=123456" \
--publish 6603:3306 \
mysql


#conenct to mysql in container
mysql -uroot -p123456 -h127.0.0.1 -P6603 -e 'show global variables like "max_connections"';
```
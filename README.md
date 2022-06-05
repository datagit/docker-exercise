```bash
# https://phoenixnap.com/kb/mysql-docker-container
docker run -d --name mysql_docker mysql/mysql-server:latest

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

Run Your First Apache Bench Load Performance Test
```bash
# https://www.tutorialspoint.com/apache_bench/apache_bench_environment_setup.htm
# https://developer.okta.com/blog/2019/10/15/performance-testing-with-apache-bench
# https://blog.cloud365.vn/linux/cong-cu-apache-benchmarking/

# https://hub.docker.com/r/jordi/ab
docker pull jordi/ab

# To send an HTTP GET request you can use:
docker run --rm jordi/ab -v 2 https://www.docker.com/
```
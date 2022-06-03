```bash
# https://anonystick.com/blog-developer/install-mongodb-docker-5-mins-2021061194665125
# install mongodb by docker
docker pull mongo:latest

mkdir mongo_db_version_latest

# -d -> run background
# --name c2-mongo -> container-name
# -= 2718:27017 -> localhost:2718 will refer to 27017 in docker
# note: use absolute path
docker run -d -p 2718:27017 -v /Users/datdao/Developer/Code/docker-exercise/mongo_db_version_latest:/data/db --name c2-mongo mongo:latest

# run docker and run bash in docker
docker exec -it c2-mongo bash

  mongo --version

# connect to mongodb in docker
mongo localhost:2718
mongo mongodb://localhost:2718/test?compressors=disabled&gssapiServiceName=mongodb
```

```bash
# connect to mongo by port in container
mongo mongodb://localhost:27027
# restore databases;
# file zip -> https://stoooc-techhub.slack.com/files/U017ZFD0PJN/F024XRUDZ8C/mongodump.tar.gz
tree -d ./mongodump
./mongodump
├── admin
├── shaDev
└── shaDevTPoint
mongorestore --uri "mongodb://localhost:27027" ./mongodump
```
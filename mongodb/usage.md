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
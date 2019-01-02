FROM mariadb:5.5

# get packages
RUN \
  apt-get update 

COPY db.sql /docker-entrypoint-initdb.d/db.sql

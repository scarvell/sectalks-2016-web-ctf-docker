FROM mysql:5.7

# get packages
RUN \
  apt-get update 

COPY db.sql /docker-entrypoint-initdb.d/db.sql

FROM docker.io/mariadb:10.7.3
COPY ./schema.sql /docker-entrypoint-initdb.d/schema.sql
ENV MYSQL_DATABASE organizer
ENV MYSQL_ROOT_PASSWORD root
ENV MYSQL_ROOT_HOST %

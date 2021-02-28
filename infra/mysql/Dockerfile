FROM mysql@sha256:870892ea5cc8c623b389717c2eedd58248c82a8569d7601ede62a63d527641bd

ENV MYSQL_DATABASE=laravel_namiya \
  MYSQL_USER=phper \
  MYSQL_PASSWORD=secret \
  MYSQL_ROOT_PASSWORD=secret \
  TZ=Asia/Tokyo

COPY ./my.cnf /etc/mysql/conf.d/my.cnf
RUN chmod 644 /etc/mysql/conf.d/my.cnf
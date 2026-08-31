FROM ubuntu:24.04

RUN apt-get update && apt-get install -y php php-mysqli mariadb-server && rm -rf /var/lib/apt/lists*

WORKDIR /WFC-ards

COPY . .
COPY config-docker.php config.php

COPY docker_run.sh /docker_run.sh
RUN chmod +x /docker_run.sh

EXPOSE 8000

ENTRYPOINT ["/docker_run.sh"]
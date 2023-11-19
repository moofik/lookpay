#!/usr/bin/env bash

DIR=$(readlink -e $(dirname $0))
SUDO_CMD=$(test -w /var/run/docker.sock || echo sudo)
PROJECT_DIR="/boombower"
COMPOSER_HOME=${COMPOSER_HOME:-${DIR}/volumes/composer}

test() {
    echo "${DIR}/../backend:${PROJECT_DIR}"
}

php() {
    if [[ ! -d ${COMPOSER_HOME} ]]; then
        mkdir -p ${COMPOSER_HOME}
    fi

    ${SUDO_CMD} docker run \
        -it \
        --rm \
        -v ${COMPOSER_HOME}:${HOME}/.composer \
        -v ${HOME}/.ssh:${HOME}/.ssh \
        -v ${DIR}/../backend:${PROJECT_DIR} \
        -v ${DIR}/volumes/data:/opt/data \
        -v ${DIR}/build/php-cli/php.ini:/etc/php/8.1/cli/php.ini:ro \
        -v /etc/passwd:/etc/passwd:ro \
        -v /etc/group:/etc/group:ro \
        -w ${PROJECT_DIR} \
        -u $(id -u) \
        --network master_home \
        boombower/php-cli \
        $@
}

pg() {
    local base_dir=$(dirname ${DIR})
    local work_dir=$(pwd)

    if [[ ${work_dir} == $(pwd) ]]; then
        work_dir="${PROJECT_DIR}"
    fi

    ${SUDO_CMD} docker run \
        -it \
        --rm \
        -v ${DIR}:${PROJECT_DIR} \
        -w ${work_dir} \
        -e POSTGRES_PASSWORD=testpassW0000rdh \
        --network boombower \
          boombower/db \
        "$@"
}

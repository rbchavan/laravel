#!/bin/sh
mkdir -p /etc/redis
cat <<EOF > /etc/redis/users.acl
user default off
user $REDIS_USERNAME on >$REDIS_PASSWORD allcommands allkeys
EOF

exec redis-server --aclfile /etc/redis/users.acl

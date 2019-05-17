docker rm -f ci-restserver-dev
docker run -d -p 8080:80 -v "$(pwd):/var/www/html" --name ci-restserver-dev mamat08nurahmat/ci-restserver

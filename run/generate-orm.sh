
docker compose exec php bin/doctrine orm:convert-mapping --force --from-database annotation ./src/Infrastructure/Db/Doctrine/Model/

docker compose exec php bin/doctrine orm:generate-entities ./src/Infrastructure/Db/Doctrine/Model/ --generate-annotations=true

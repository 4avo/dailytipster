#!/bin/bash
migration_status=$(php artisan migrate:status --database=dailytipster_db | grep "not found")
if [ -n "$migration_status" ]; then
echo "Migrations not found. Running migrations and seeding database."
php artisan migrate:fresh --seed --database=dailytipster_db
else
echo "Migrations have already been run."
fi
exec apache2-foreground
# Sync database changes
php artisan migrate -n --force
php artisan cache:clear

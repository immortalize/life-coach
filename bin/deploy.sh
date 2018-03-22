# Sync database changes
php artisan migrate:refresh -n --force
php artisan cache:clear

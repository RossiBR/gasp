
call sc start wampmysqld64
call php artisan migrate:refresh --seed
php artisan serve --port=9090
call sc stop wampmysqld64

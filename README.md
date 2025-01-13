# laravel_react_social_app
## `php artisan serve`

## `php artisan tinker`

## `npm run dev`

## `Commit code`

### `1. Cài đặt môi trường Laravel`
 `composer create-project laravel/laravel social-network`

### `2. Cài đặt thư viện Inertia`
`composer require laravel/breeze --dev`

### `3. Database`
```
php artisan make:migration create_users_table
php aritsan make:migration create_post_table
php artisan make:migration create_follow_table
php artisan make:migration create_comment_table
```

### `4. Factory Seeder Model Controller`

```
php artisan make:factory UserFactory
php aritsan make:seeder PostFactory
php artisan make:model FollowFactory
php artisan make:controller CommentFactory
```

- Symlink `php artisan storage:link`
`tạo một liên kết biểu tượng (symlink) giữa thư mục storage/app/public và thư mục public/storage`


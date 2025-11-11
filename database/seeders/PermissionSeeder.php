<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Сброс кэша разрешений
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            ['id' => 1, 'name' => 'category.menu', 'guard_name' => 'web', 'group_name' => 'category'],
            ['id' => 2, 'name' => 'category.list', 'guard_name' => 'web', 'group_name' => 'category'],
            ['id' => 3, 'name' => 'category.add', 'guard_name' => 'web', 'group_name' => 'category'],
            ['id' => 4, 'name' => 'category.edit', 'guard_name' => 'web', 'group_name' => 'category'],
            ['id' => 5, 'name' => 'category.delete', 'guard_name' => 'web', 'group_name' => 'category'],
            ['id' => 12, 'name' => 'news.menu', 'guard_name' => 'web', 'group_name' => 'newsPost'],
            ['id' => 13, 'name' => 'news.list', 'guard_name' => 'web', 'group_name' => 'newsPost'],
            ['id' => 14, 'name' => 'news.add', 'guard_name' => 'web', 'group_name' => 'newsPost'],
            ['id' => 15, 'name' => 'news.edit', 'guard_name' => 'web', 'group_name' => 'newsPost'],
            ['id' => 16, 'name' => 'news.delete', 'guard_name' => 'web', 'group_name' => 'newsPost'],
            ['id' => 18, 'name' => 'photo.menu', 'guard_name' => 'web', 'group_name' => 'gallery'],
            ['id' => 19, 'name' => 'photo.list', 'guard_name' => 'web', 'group_name' => 'gallery'],
            ['id' => 20, 'name' => 'photo.add', 'guard_name' => 'web', 'group_name' => 'gallery'],
            ['id' => 21, 'name' => 'photo.edit', 'guard_name' => 'web', 'group_name' => 'gallery'],
            ['id' => 22, 'name' => 'photo.delete', 'guard_name' => 'web', 'group_name' => 'gallery'],
            ['id' => 23, 'name' => 'video.menu', 'guard_name' => 'web', 'group_name' => 'video'],
            ['id' => 24, 'name' => 'video.list', 'guard_name' => 'web', 'group_name' => 'video'],
            ['id' => 25, 'name' => 'video.add', 'guard_name' => 'web', 'group_name' => 'video'],
            ['id' => 26, 'name' => 'video.edit', 'guard_name' => 'web', 'group_name' => 'video'],
            ['id' => 27, 'name' => 'video.delete', 'guard_name' => 'web', 'group_name' => 'video'],
            ['id' => 30, 'name' => 'setting.menu', 'guard_name' => 'web', 'group_name' => 'setting'],
            ['id' => 31, 'name' => 'role.menu', 'guard_name' => 'web', 'group_name' => 'role'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert(array_merge($permission, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Очистка кэша после вставки
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}

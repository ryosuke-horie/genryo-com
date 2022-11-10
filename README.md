# 開発メモ

## build 
---
#Build
docker-compose up -d
#コンテナ内に入る
docker-compose exec lara_base_web bash
---

## DBログイン
```
#dbコンテナ内に入る
$ docker compose exec lara_base_db bash

#ログイン
$ mysql -u laravel -p secret
```


## migrateの実行
webコンテナに入りその中で実行する
```
$ php artisan migrate
```# weight-management
# weight-management

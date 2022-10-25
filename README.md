# Start instruction
## Requirements
* PHP version - ^8.0.2
* Composer version - ^2.2.7

## Installation

Clone repository from GitHub:

```shell
 git clone https://github.com/antspring/cloud-storage-api
 cd cloud-storage-api
```

Installing Composer Dependencies:

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

Copy .env.example

```shell
cp .env.example .env
```

Configure .env file

* DB_HOST=mysql
* DB_DATABASE
* DB_USERNAME
* DB_PASSWORD
* QUEUE_CONNECTION=database

Create alias for sail:

```shell
alias sail='./vendor/bin/sail'
```

Run docker container:

```shell
sail up -d
```

Generate application key:

```shell
sail artisan key:generate
```

Run database migrations:

```shell
sail artisan migrate
```

Run queue:

```shell
sail artisan queue:work
```

Run schedule in different terminal:

```shell
sail artisan schedule:work
```

# Описание сервиса

#### Cloud-storage-api - сервис облачного хранилища для файлов.

Сервис включает в себя функции загрузки, просмотра, удаления, переименования файлов. Пользователь может создавать папки и также переименовывать их.

Из расширенных функций - пользователь может узнать размер файлов в определенноый директории, размер всех загруженных файлов.

Так же присутствует возможность публикации файла для общего доступа.

При загрузке файла можно указать срок его хранения.

Авторизация пользователя работает с помощью пакета Laravel/Sanctum.


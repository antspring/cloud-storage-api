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

Install PHP dependencies:

```shell
composer install
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
sail up
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


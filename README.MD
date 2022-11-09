# Laravel Health Check

## Version Compatibility

| Releases | Laravel          |
|:---------|:-----------------|
| 1.x      | ^8.22.1; ^9.3.0  |

## Install

```shell script
composer require meysam-znd/laravel_health_check
```
## Publish Config
```
php artisan vendor:publish --provider="Laravel\Health\Providers\HealthServiceProvider"

```
## Usage
Edit the config file `config/health-checker.php` see the comments there for more information

## Available checkers
- `database` Tests database connections.
- `cache` Tests for caching data
- `directory-permission` Tests permission in directories
- `queue` Tests for queue

## How to add a new checker
You only need to extend `\Laravel\Health\Checkers\BaseChecker` and add to services in `config/health-checker.php`.

## Routes and Responses

To access the health status you can use the follow routes:

- `health/status` Load and list all check services.
- `health/{service_name}/status` Load only the chosen service and show his status.

The response for both cases will be like that:

```
{
    status => false
    health_status: [
        {
            cache: {
                status: true,
                message: null
            }
        },
        {
            database: {
                status: true,
                message: null
            }
        },
        {
            directory-permission: {
                status: false,
                message: "The directory /application/public/../storage/ is not writable."
            }
        },
        {
            queue: {
                status: true,
                message: null
            }
        }
    ]
}
```

## Command usage

You can use the follow commands to check healthy in your cli application:

```sh
php artisan application-health:check-health
```
Or

```sh
php artisan application:health-check
```
Note: this package was made a fork from https://github.com/arquivei/laravel-health-checker

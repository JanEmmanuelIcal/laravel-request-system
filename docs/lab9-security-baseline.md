# Lab 9 – Security Configuration Baseline

## Project Information
- Project: Laravel Request System
- Environment: Localhost / XAMPP
- Framework: Laravel 12.69.2
- Database: laravel_request_system_db

## Security Configuration Requirements

| Setting | Approved Requirement |
|---|---|
| APP_ENV | local |
| APP_DEBUG | false |
| APP_KEY | Must be present |
| Database Host | localhost |
| Database Port | 3306 |
| Database | laravel_request_system_db |
| Passwords and Tokens | Must not be committed |
| Environment File | .env must remain excluded from Git |

## Verification
- Check application debug configuration.
- Check database connectivity.
- Inspect file permissions.
- Review configuration files for exposed secrets.
- Run the configuration audit.
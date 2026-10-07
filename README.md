# Laravel Request System

## Project Description

The Laravel Request System is a web-based application developed using Laravel and MySQL. It is created as part of the DevOps Laboratory 1 activity.

## Student Information

**Name:** Jan Emmanuel Ical  
**Course:** BSIT  
**Year and Section:** 4th Year - Block 3

## Software Requirements

- PHP
- Composer
- Laravel
- MySQL
- XAMPP
- Git
- GitHub
- Node.js and NPM

## Installation

1. Clone the repository.
2. Open the project folder in the terminal.
3. Install the Laravel dependencies:

```bash
composer install

## Laboratory 2 - Request Data Model

### Request Table

The Laravel request system uses a `requests` table to store submitted requests.

| Field | Type | Constraint | Purpose |
|---|---|---|---|
| id | BIGINT UNSIGNED | Primary Key, Auto Increment | Unique request number |
| requester_name | VARCHAR(100) | Required | Person submitting the request |
| requester_email | VARCHAR(255) | Required | Contact email of requester |
| item_name | VARCHAR(150) | Required | Requested item or service |
| quantity | INT UNSIGNED | Required, greater than 0 | Requested quantity |
| purpose | TEXT | Required | Reason for the request |
| status | VARCHAR(20) | Default: pending | Current request state |
| created_at | TIMESTAMP | Required | Creation time |
| updated_at | TIMESTAMP | Required | Last update time |

### Migration

Create the migration using:

```bash
php artisan make:migration create_requests_table

### Lab 3
Driver: [Jan Emmanuel M. Ical]
Reviewer: [Myla A. Barrameda]

Driver Responsibilities:
- Implement the security changes
- Run tests
- Push the feature branch
- Create the pull request

Reviewer Responsibilities:
- Inspect the implementation
- Test the system
- Leave a substantive review comment
- Approve the pull request after fixes
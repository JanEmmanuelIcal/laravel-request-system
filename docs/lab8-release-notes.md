# Lab 8 - Controlled Staging Release

## Starting Release
- Project: laravel-request-system
- Laravel Version: 12.69.2
- Starting Commit: 9ead5f0
- Target: Staging

## Release Workflow
1. Prepare release.
2. Start deployment workflow.
3. Record pending approval.
4. Obtain approval.
5. Deploy approved artifact.
6. Perform health checks.
7. Run smoke tests.
8. Verify release.

## Required Smoke Tests
- Application health and deployed revision.
- Student login.
- Create request using STAGE-LIB-08.
- Retrieve the saved request.
- Admin status updates.
- Verify students cannot update admin-only statuses.

## Failure and Rollback
- Deploy instructor-approved faulty version.
- Record the failed smoke test.
- Roll back to the known-good version.
- Redeploy the known-good version.
- Repeat smoke tests.
- Confirm saved data remains available.

## Current Status
Release preparation documented.
Deployment and approval not yet performed.

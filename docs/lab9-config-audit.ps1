
$ErrorActionPreference = "Continue"

Write-Host "================================="
Write-Host " LAB 9 CONFIGURATION SECURITY AUDIT"
Write-Host "================================="

$envFile = ".env"

# Check APP_DEBUG
$debugLine = Select-String -Path $envFile -Pattern '^APP_DEBUG='
if ($debugLine -and $debugLine.Line -eq 'APP_DEBUG=false') {
    Write-Host "debug_off: PASS"
} else {
    Write-Host "debug_off: FAIL"
}

# Check APP_KEY without displaying its value
$keyLine = Select-String -Path $envFile -Pattern '^APP_KEY=.+'
if ($keyLine) {
    Write-Host "app_key_present: PASS"
} else {
    Write-Host "app_key_present: FAIL"
}

# Check whether .env is ignored by Git
$ignored = git check-ignore .env
if ($ignored) {
    Write-Host "env_file_ignored: PASS"
} else {
    Write-Host "env_file_ignored: FAIL"
}

# Check database connectivity
php artisan migrate:status
if ($LASTEXITCODE -eq 0) {
    Write-Host "database_connection: PASS"
} else {
    Write-Host "database_connection: FAIL"
}

Write-Host "database_access_scope: UNVERIFIED"
Write-Host "================================="
Write-Host " AUDIT COMPLETED"
Write-Host "================================="

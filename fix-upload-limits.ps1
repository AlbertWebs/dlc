# PowerShell script to fix PHP upload limits
# Run this as Administrator

$phpIniPath = "C:\php-8.4.13\php.ini"

if (Test-Path $phpIniPath) {
    Write-Host "Reading php.ini file..." -ForegroundColor Yellow
    
    # Read the file
    $content = Get-Content $phpIniPath -Raw
    
    # Replace post_max_size
    $content = $content -replace 'post_max_size\s*=\s*\d+[KMGT]?', 'post_max_size = 220M'
    
    # Also update max_input_time if it's too low
    $content = $content -replace 'max_input_time\s*=\s*\d+', 'max_input_time = 300'
    
    # Write back to file
    Set-Content -Path $phpIniPath -Value $content -NoNewline
    
    Write-Host "✅ Successfully updated php.ini!" -ForegroundColor Green
    Write-Host ""
    Write-Host "Changes made:" -ForegroundColor Cyan
    Write-Host "  - post_max_size = 220M" -ForegroundColor White
    Write-Host "  - max_input_time = 300" -ForegroundColor White
    Write-Host ""
    Write-Host "⚠️  IMPORTANT: You must restart your Laravel server!" -ForegroundColor Yellow
    Write-Host "   1. Stop php artisan serve (Ctrl+C)" -ForegroundColor White
    Write-Host "   2. Run: php artisan serve" -ForegroundColor White
    Write-Host ""
} else {
    Write-Host "❌ Error: php.ini file not found at: $phpIniPath" -ForegroundColor Red
    Write-Host "Please check the path and try again." -ForegroundColor Yellow
}

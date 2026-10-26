@echo off
REM Deployment von mdc-facility.de (Windows) - per Doppelklick oder: deploy\deploy.bat --dry-run
chcp 65001 >nul
cd /d "%~dp0.."

where py >nul 2>nul
if %errorlevel%==0 (
    set "PYTHON=py -3"
) else (
    set "PYTHON=python"
)

%PYTHON% -c "import paramiko" 2>nul
if errorlevel 1 (
    echo Installiere benoetigtes Paket "paramiko" ...
    %PYTHON% -m pip install --user paramiko
)

%PYTHON% deploy\deploy.py %*
echo.
pause

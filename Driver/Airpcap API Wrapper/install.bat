@ECHO OFF

echo Install Acrylic WiFi driver
echo ----------------------------------------
echo .

1>nul 2>nul reg query HKU\S-1-5-19 || (
	echo You must run the command prompt as administrator to install.
	ping 127.0.0.1 > NUL 2>&1
    exit /b 1
)


cd "%~dp0"
"Driver\TRLNDIS_Installer64.exe" 1 1 1
pause
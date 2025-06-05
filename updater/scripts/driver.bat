@ECHO OFF
REM Injected parameters
SET "TOOL_NAME=%~1"
SET "UNPACK_DIR=%~2"
SET "DOWNLOAD_VER=%~3"

REM Compute path to ../Driver relative to UNPACK_DIR
SET "TARGET_DIR=%UNPACK_DIR%\..\..\..\Driver"

echo Post-update cleanup for %TOOL_NAME% version %DOWNLOAD_VER%

REM Delete any old Npcap installer in ../Driver
del /Q "%TARGET_DIR%\npcap-*.exe" 2>nul

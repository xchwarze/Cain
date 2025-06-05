@ECHO OFF
REM Injected parameters
SET "TOOL_NAME=%~1"
SET "UNPACK_DIR=%~2"
SET "DOWNLOAD_VER=%~3"
SET "BIN_DIR=%UNPACK_DIR%\..\..\bin"
SET "SCRIPTS_DIR=%UNPACK_DIR%\..\..\scripts"

echo Post-update cleanup for %TOOL_NAME% version %DOWNLOAD_VER%

REM Execute cain oui parser
"%BIN_DIR%\php.exe" "%SCRIPTS_DIR%\oui-to-cain.php" "%UNPACK_DIR%\oui.txt"

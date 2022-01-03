@echo off

rem -------------------------------------------------------------
rem  YiiMan API init script for Windows.
rem
rem  @author gholamreza beheshtian <info@YiiMan.ir>
rem  @link https://yiiman.ir/
rem  @copyright Copyright (c) 2018 YiiMan Software LLC
rem  @license https://yiiman.ir/license/
rem -------------------------------------------------------------

@setlocal

set YII_PATH=%~dp0

if "%PHP_COMMAND%" == "" set PHP_COMMAND=php.exe

"%PHP_COMMAND%" "init" %*

@endlocal

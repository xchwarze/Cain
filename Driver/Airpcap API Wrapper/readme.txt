Acrylic WiFi
-------------------------------------------------

We have developed a Airpcap compatible library that encapsulates Acrylic WiFi NDIS driver logic to allow software compatibility with most WiFi cards in the market. This Airpcap Wrapper is an alternative to Acrylic NDIS WiFi interface, and has been developed in order to obtain maximum compatibility with software products.

When installing Acrylic WiFi a dll called Airpcap.dll is copied on %SystemRoot% and on 64bit environments the x86 version in %SystemRoot%\SysWOW64 and the original library Airpcap that might exist in the system airpcap.orig.dll is renamed. This allows that as soon as Acrylic is installed, any compatible software with airpcap, as Wireshark and Cain, are capable of automatically capturing WiFi traffic with almost any WiFi card in the market, and capture 802.11ac traffic, which is not currently supported by Airpcap.

Airpcap API specifications are the following. By including this library in your project you can capture WiFi packet natively on Windows. The only requirement is to have Acrylic WiFi Free installed on the system.



Instructions
--------------------------------------------------
Install: exec "TRLNDIS_Installer64.exe" 1 1 1
Uninstall: exec "TRLNDIS_Installer64.exe" 2
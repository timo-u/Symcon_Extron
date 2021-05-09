# DMP64
Beschreibung des Moduls.

### Inhaltsverzeichnis

1. [Funktionsumfang](#1-funktionsumfang)
2. [Voraussetzungen](#2-voraussetzungen)
3. [Software-Installation](#3-software-installation)
4. [Einrichten der Instanzen in IP-Symcon](#4-einrichten-der-instanzen-in-ip-symcon)
5. [Statusvariablen und Profile](#5-statusvariablen-und-profile)
6. [WebFront](#6-webfront)
7. [PHP-Befehlsreferenz](#7-php-befehlsreferenz)

### 1. Funktionsumfang

*Einstellen der Eingangs- und Ausgangspegel sowie der Matrix-Punke

### 2. Vorraussetzungen

- IP-Symcon ab Version 5.0

### 3. Software-Installation

* Über den Module Store das 'Extron'-Modul installieren.
* Alternativ über das Module Control folgende URL hinzufügen: https://github.com/timo-u/Symcon_Extron

* Die Datei /docs/api.html in der DMP64 Audiomatrix in den Root-Ordner hochladen 

### 4. Einrichten der Instanzen in IP-Symcon

 Unter 'Instanz hinzufügen' kann das 'DMP64'-Modul mithilfe des Schnellfilters gefunden werden.  
	- Weitere Informationen zum Hinzufügen von Instanzen in der [Dokumentation der Instanzen](https://www.symcon.de/service/dokumentation/konzepte/instanzen/#Instanz_hinzufügen)

__Konfigurationsseite__:

Name     | Beschreibung
-------- | ------------------
IP-Adresse| IP-Adresse der Audiomatrix
         |

### 5. Statusvariablen und Profile

Die Statusvariablen/Kategorien werden keine angelegt.

#### Statusvariablen
-
#### Profile
-

### 6. WebFront

Die Funktionalität, die das Modul im WebFront bietet.

### 7. PHP-Befehlsreferenz

`boolean EXDMP_LoadPreset(12345, Preset);
Preset Laden

Beispiel:
	EXDMP_LoadPreset(12345, Preset);

`boolean EXDMP_SendCommand(12345, string);
Benutzerdefinierten Befehl senden. 

Beispiel:
	EXDMP_SendCommand(12345, "1.");
	
	
`boolean EXDMP_SetInputGain(12345, Kanal, Gain);
Eingangspegel (in dB) einstellen

Beispiel:
	EXDMP_SetInputGain(12345, 1, -20);

`boolean EXDMP_SetInputMute(12345, Kanal, Mute);
Eingang Muten 

Beispiel:
	EXDMP_SetInputMute(12345, 1, true);

`boolean EXDMP_SetMixPointGain(12345, From, To, Gain);
Pegel eins Matrixpunktes setzen 
Von: 
	Eingänge 1...6
	Virtual Return 7...10
Nach:
	Ausgänge 1...4
	Virtual Reruen 5...8


Beispiel:
	EXDMP_SetMixPointGain(12345, 1, 1, +5);
	Eingang 1 auf Ausgang 1 mit +5dB 

`boolean EXDMP_SetMixPointMute(12345, From, To, Mute);
 Matrixpunkt Muten

Beispiel:
	EXDMP_SetMixPointMute(12345, 1, 1, true);
	Eingang 1 auf Ausgang 1 Muten

`boolean EXDMP_SetOutputGain(12345, Kanal, Gain);
Ausgangspegel setzten. 

Beispiel:
	EXDMP_SetOutputGain(12345, 1, 10)
	Ausgang 1 auf +10 dB setzen 

`boolean EXDMP_SetOutputMute(12345, Kanal, false);
Ausgang stumm schalten

Beispiel:
	EXDMP_SetOutputMute(12345, 1, true);

`boolean EXDMP_SetPreMixerGain(12345, Kanal, Gain);
Premixcer Gain setzen 

Beispiel:
	EXDMP_SetPreMixerGain(12345, 1, 0)

`boolean EXDMP_SetPreMixerMute(12345, Kanal, Mute);


Beispiel:
	EXDMP_SetPreMixerMute(12345, 1, true);

`boolean EXDMP_SetVirtualReturnGain(12345, Kanal, Gain);


Beispiel:
	EXDMP_SetVirtualReturnGain(12345, 1, 0);

`boolean EXDMP_SetVirtualReturnMute(12345, Kanal, Mute);


Beispiel:
	EXDMP_SetVirtualReturnMute(12345, 1, false);







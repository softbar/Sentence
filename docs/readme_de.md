[![Version](https://img.shields.io/badge/IP--Symcon-Modul-red.svg?style=flat-square)](docs/readme_de.md) [![Version](https://img.shields.io/badge/IP--Symcon-5.2-blue.svg?style=flat-square)](docs/readme_de.md) [![Code](https://img.shields.io/badge/PHP-7.0-blue.svg?style=flat-square)](docs/readme_de.md)

# Modul Sentence v1.0
- Author **Xaver Bauer**
- Version **1.0**
- Date **15.03.2020**

Dieses Modul ermöglicht es, aus einfachen Wortlisten mit wenigen wörtern, viele unterschiedliche (teils sehr witzige) Sätze zu bilden.

## Inhaltsverzeichnis
- [Einleitung](#1-einleitung)
- [Funktionsumfang](#2-funktionsumfang)
- [Voraussetzungen](#3-voraussetzungen)
- [Installation](#4-installation)
- [Funktionsreferenz](#5-funktionsreferenz)
    - [SENTENCE_Get](#51-sentence_get)
    - [SENTENCE_Speak](#52-sentence_speak)
- [Anmerkungen](#6-anmerkungen)

## 1. Einleitung
Dank des Genialen EchoRemote Moduls ist es ja einfach bei bestimmten Ereignisse einen Text ansagen zu lassen, der haken ... immer der gleiche Text wird 1. Irgendwann überhört und 2. wird es schnell eintönig.

Daher habe ich mir wieder einmal gedacht, ein Modul zu basteln das verschieden Texte ausgibt. Die Logik dahinter ist ziemlich einfach, es wird je ein zufälliger Begriff aus den Listen gewählt und zu einem Satz zusammengefügt.

Bei 4 Wortlisten mit je 4 Satzteilen ergeben sich somit 4x4x4x4 = 256 verschieden Kombinationen und das ergibt,je nach Wortwahl, schon mal ziemlich lustig Sätze.

## 2. Funktionsumfang
Das Modul **Sentence** unterstützt folgendes:
- einen zufälligen Text ausgeben
- ECHO Remote Unterstützung 
>Wenn eine ECHORemote Instanz konfiguriert ist
- Humor

[Zum Anfang](#inhaltsverzeichnis)

## 3. Voraussetzungen
- IP-Symcon v5.2

[Zum Anfang](#inhaltsverzeichnis)

## 4. Installation
Installation über das Module Control von IP-Symcon mit folgender URL

```
https://github.com/softbar/Sentence
```

[Zum Anfang](#inhaltsverzeichnis)

## 5. Funktionsreferenz
[Zum Anfang](#inhaltsverzeichnis)

#### 51. SENTENCE_Get
Erstellt einen zufälligen Text

```php
SENTENCE_Get ( $SentenceID, )
```

Parameter

| Name        | Typ | Beschreibung                  
|-------------|-----|--------------------------------
| $SentenceID | int | InstanceID des Sentence Moduls

Rückgabe

| Typ    | Beschreibung                                      
|--------|----------------------------------------------------
| string | Ein zufälliger Text oder leer wenn keine Texte Konfiguriert sind

[Zum Anfang](#inhaltsverzeichnis)

#### 52. SENTENCE_Speak
Spricht einen zufälligen Text, falls eine EchoRemot Instance im Modul gewählt wurde

```php
SENTENCE_Speak ( $SentenceID, )
```

Parameter

| Name        | Typ | Beschreibung                  
|-------------|-----|--------------------------------
| $SentenceID | int | InstanceID des Sentence Moduls

Rückgabe

| Typ                 | Beschreibung                                      
|---------------------|----------------------------------------------------
| string oder boolean | Wenn kein Echo Konfiguriert ist den Text wie mit Get, anderenfalls das Ergenis des aufrufs von ECHOREMOTE_TextToSpeak

[Zum Anfang](#inhaltsverzeichnis)


## 6. Anmerkungen
>Wenn das ECHO Remote Modul installiert und mindestens ein ECHO Gerät konfiguriert ist, dann wird im Sentence Modul- Einstellungen der Menüpunkt "An Echo Remote Gerät ausgeben" erscheinen und es ist möglich ein Gerät zur Ausgabe mit SENTENCE_Speek() auszuwählen

>Seit ich das Modul bei mir laufen habe, freue ich mich jeden Abend auf die Ansage im Schlafzimmer das Fenster zu schließen :-)

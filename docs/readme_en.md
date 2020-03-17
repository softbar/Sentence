[![Version](https://img.shields.io/badge/IP--Symcon-Modul-red.svg?style=flat-square)](docs/readme_de.md) [![Version](https://img.shields.io/badge/IP--Symcon-5.2-blue.svg?style=flat-square)](docs/readme_de.md) [![Code](https://img.shields.io/badge/PHP-7.0-blue.svg?style=flat-square)](docs/readme_de.md)

# Module Sentence v1.0
- Author **Xaver Bauer**
- Version **1.0**
- Date **03/15/2020**

This module enables simple word lists with a few words, To form many different (sometimes very funny) sentences.

## Table of Contents
- [Introduction](#1-introduction)
- [Features](#2-features)
- [Requirements](#3-requirements)
- [Installation](#4-installation)
- [Function reference](#5-function-reference)
    - [SENTENCE_Get](#51-sentence_get)
    - [SENTENCE_Speak](#52-sentence_speak)
- [Remarks](#6-remarks)

## 1. Introduction
Thanks to the ingenious EchoRemote module, it is easy to have a text announced for certain events, the tick ... always the same text will be 1. overheard at some point and 2. it quickly becomes monotonous.
Therefore, I once again thought of building a module that outputs different texts. The logic behind this is fairly simple, a random term is chosen from the lists and put together to form a sentence.
With 4 word lists, each with 4 parts of the sentence, there are 4x4x4x4 = 256 different combinations and this, depending on the choice of words, sometimes results in quite funny sentences.

## 2. Features
The **Sentence** module supports the following:
- Output a random text
- ECHO Remote Support 
>If an ECHORemote instance is configured
- Humor

[At the beginning](#table-of-contents)

## 3. Requirements
- IP-Symcon v5.2

[At the beginning](#table-of-contents)

## 4. Installation
Installation via the Module Control from IP-Symcon with the following URL

```
https://github.com/softbar/Sentence
```

[At the beginning](#table-of-contents)

## 5. Function reference
[At the beginning](#table-of-contents)

#### 51. SENTENCE_Get
Creates random text

```php
SENTENCE_Get ( $SentenceID, )
```

Parameter

| Surname     | Type | Description                      
|-------------|-----|-----------------------------------
| $SentenceID | int | InstanceID of the Sentence module

Return

| Type   | Description                                      
|--------|---------------------------------------------------
| string | A random text or empty if no texts are configured

[At the beginning](#table-of-contents)

#### 52. SENTENCE_Speak
Speaks a random text if an EchoRemot instance was selected in the module

```php
SENTENCE_Speak ( $SentenceID, )
```

Parameter

| Surname     | Type | Description                      
|-------------|-----|-----------------------------------
| $SentenceID | int | InstanceID of the Sentence module

Return

| Type                | Description                                       
|---------------------|----------------------------------------------------
| string oder boolean | If no echo is configured the text as with Get, otherwise the result of calling ECHOREMOTE_TextToSpeak

[At the beginning](#table-of-contents)


## 6. Remarks
> If the ECHO Remote module is installed and at least one ECHO device is configured, the menu item "Output to Echo Remote device" will appear in the sentence module settings and it is possible to select a device for output with SENTENCE_Speek ()

> Since I have run the module with me, I look forward to the announcement in the bedroom every evening to close the window :-)

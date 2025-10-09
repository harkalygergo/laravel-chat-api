# 💬 LaraTalk
###### v2025.10.09.4

---

## Description

LaraTalk is a Laravel-based chat web application as a test project. Visitor can register and login, after login, can search and add friends. Friends can write message to each other.

---

## Installation and usage

- clone this repository
- install dependencies:
  - `composer install`
  - `npm install && npm run build` (if needed)
- set up `.env` file (copy from `.env.example` and modify)
- run migrations:
  - `php artisan migrate`
- start the server:
  - `php artisan serve`
- run tests (optional):
    - `php artisan test`
- reach site at `http://localhost:8000`
- login and registration under `http://localhost:8000/auth`

---

## Task

### Chat API fejlesztése Laravel keretrendszerrel

Készíts egy REST alapú chat API-t a Laravel keretrendszer (legalább v11) felhasználásával.
Az API célja, hogy lehetővé tegye a felhasználók számára a regisztrációt, ismerősök
hozzáadását és üzenetküldést egymás között. A projekt során törekedj a moduláris felépítésre,
tiszta kódszerkezetre és tesztelhető megoldásra.

#### Funkcionális követelmények

- Felhasználói regisztráció
  - A felhasználók email-címmel regisztrálhatnak.
  - A regisztrációhoz emailes megerősítés szükséges (email-verifikáció). 
- Ismerősök kezelése
  - Regisztrált és aktív felhasználók ismerősnek jelölhetik egymást.
  - Ismerősnek jelölés csak akkor lehetséges, ha a másik fél is aktív.
  - Az ismerős kapcsolatok kölcsönösek legyenek (kétirányú kapcsolat).
- Felhasználók listázása
  - Lehessen kilistázni az aktív felhasználókat ismerősnek jelölés céljából.
  - A lista legyen lapozható (pagination) és szűrhető (pl. név szerint).
- Üzenetküldés
  - Két ismerős felhasználó tudjon egymásnak szöveges üzeneteket küldeni.
  - A rendszer tárolja az üzeneteket és biztosítson végpontokat azok lekérdezésére.

#### Technikai követelmények

- Nyelv: PHP 8.3 vagy újabb
- Keretrendszer: Laravel 11 vagy újabb
- Adatbázis: MySQL vagy MariaDB
- Autentikáció: Laravel beépített email-verifikációs rendszere
- API struktúra: RESTful elvek szerint
- Tesztelés: Legalább egy feature test elkészítése a legfontosabb funkcionalitásra (pl. regisztráció, ismerős jelölés, üzenetküldés)

#### Elvárt kimenet

- A teljes API kódja egy Laravel projektben
- Adatbázismigrációk, modellek, kontrollerek, validációk stb.
- Példák a tesztekre (`Feature Test`) a `tests/Feature` mappában
- README.md fájl, amely tartalmazza a telepítési és használati útmutatót (opcionális, de javasolt)

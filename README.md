# Alkoholprojekt

Laravel 12 és Bootstrap alkalmazás alkoholkategóriák és termékek kezelésére.
Kategória és termék CRUD, részletező oldalak, név szerinti keresés és kategóriaszűrés.
Terméket tartalmazó kategória csak a termékek áthelyezése vagy törlése után törölhető.

## Indítás Windows parancssorból

PHP 8.2 vagy újabb és Composer szükséges. SQLite-hoz PDO SQLite,
MySQL-hez PDO MySQL kell. A Bootstrap CDN miatt a megjelenítéshez internet kell.
Az alkalmazás CRUD-oldalai nem használnak Vite-ot; ezekhez nem szükséges npm build.

A parancsokat az artisan és composer.json mappájában add ki, egyesével.
Hiba esetén ne lépj tovább.

```cmd
composer install
if not exist .env copy .env.example .env
php artisan key:generate
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan migrate
php artisan serve
```

A .env.example alapértelmezése DB_CONNECTION=sqlite. Meglévő .env esetén ellenőrizd ezt.
Az új adatbázis kezdetben üres; az űrlapokon vegyél fel kategóriákat és termékeket.
Megnyitás: http://127.0.0.1:8000. A terminált hagyd nyitva; leállítás: Ctrl+C.

## MySQL használata

Indítsd el a MySQL-t, és hozz létre külön új, üres adatbázist, például alkoholprojekt_beadas néven.
A .env fájlban állítsd be:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alkoholprojekt_beadas
DB_USERNAME=root
DB_PASSWORD=
```

A felhasználónevet és jelszót a saját MySQL-ed szerint add meg.
Ezután: php artisan config:clear, majd php artisan migrate és php artisan serve.
SQLite-fájlt MySQL esetén nem kell létrehozni.

## Korábban létrehozott adatbázis

A javított két migráció új adatbázisban hozza létre a teljes sémát.
A már lefutott migrációkat a migrate nem futtatja újra. Ha a korábbi táblákból
hiányoznak az oszlopok, használj külön új adatbázist, vagy készíts adatmegőrző
módosító migrációt. A meglévő adatbázist ne töröld a telepítés kedvéért.

## Ellenőrzés

```cmd
php artisan test
```

A phpunit.xml a tesztekhez külön, memóriában tárolt SQLite-adatbázist állít be.
Kézzel próbáld ki mindkét CRUD-ot, a keresést, a kategóriaszűrést és a hibás bevitelt is.

## GitHub

Feltöltendő a .env.example, composer.json és composer.lock is.
Nem feltöltendő: .env, vendor, node_modules, helyi SQLite-adatbázis, cache és naplók.
A vendor minden gépen a composer install paranccsal jön létre.
Mindkét csapattag saját fiókkal és Git-szerzőazonosítóval, a tényleges munkáját commitolja.
A Gitben használt e-mail-cím legyen hozzáadva az adott GitHub-fiókhoz,
vagy az adott fiók saját GitHub noreply-címe legyen.
Másik gépen git clone-nal tölthető le a repository, majd a helyi telepítést meg kell ismételni.

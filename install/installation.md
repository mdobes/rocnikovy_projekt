# Obecné info
Pro správný běh aplikace je potřeba na webovém serveru mít `PHP 8.2`, databázový server `MySQL` nebo `MariaDB` a nainstalovaný správce balíčků `composer`

# Postup instalace na webový server

1. Na webový server nahrajte všechny soubory aplikace
2. Zkopírujte soubor `.env.example` do souboru `.env` a vyplňte všechny údaje
3. Inportujte do databáze soubor `schema.sql`, který vytvoří všechny potřebné tabulky
4. (volitené) Importujte do databáze soubor `data.sql`, který obsahuje pár příspěvků a výchozího uživatele (username: `admin`, password: `test`)
3. Nainstalujte knihovny pomocí příkazu `composer install`
4. Vytvořte prvního uživatele pomocí `php create_user.php <username> <heslo>`
5. Přihlaste se do administrace na adrese `/admin`
6. Tímto je blog nainstalován


# Další konfigurace
- V souboru `.env` je možnost nastavit, kolik příspěvků se má zobrazovat na jedné stránce, pomocí direktivy `POSTS_PER_PAGE`

# Documentazione per Creare un Progetto Laravel

Questa guida copre i comandi principali per iniziare un progetto Laravel, le configurazioni base e i problemi più comuni con le relative soluzioni.

---

## 1. Installazione Laravel

### Prerequisiti
- PHP >= 8.1 (o versione richiesta da Laravel)
- Composer installato
- Estensioni PHP richieste da Laravel (OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath)

---

### Creazione progetto Laravel

```bash
composer create-project laravel/laravel nome_progetto
```
### Avviare il server di sviluppo
bash
Copia
Modifica

```bash
cd nome_progetto
php artisan serve
```
Accesso da browser a:

```bash
http://127.0.0.1:8000
```
## 2. Configurazione base
Configurare .env  
Copia .env.example in .env (automatico con composer):
```bash
cp .env.example .env
```
### Generare la chiave dell'applicazione (APP_KEY)
```bash
php artisan key:generate
```
## Configurare connessione database in .env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_database
DB_USERNAME=utente_db
DB_PASSWORD=password_db
```
## 3. Creare un Model
```bash
php artisan make:model NomeModel
```
Se la tabella non usa la convenzione plurale, definisci nel model:
```bash
protected $table = 'nome_tabella';
```
Se non hai id come primary key, disabilita:
```bash
protected $primaryKey = null;
public $incrementing = false;
```
Se la tabella non ha campi timestamps:
```bash
public $timestamps = false;
```
## 4. Creare un Controller
```bash
php artisan make:controller NomeController
```

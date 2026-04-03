# ⛳ Golf Buddy

**Golf Buddy** è un'applicazione web che permette ai giocatori di golf di organizzare e trovare compagni di gioco. Gli utenti possono creare partite, iscriversi a quelle degli altri e gestire il proprio profilo con il club di appartenenza.

---

## Funzionalità

- **Registrazione e autenticazione** — sistema di login completo con recupero password
- **Gestione partite** — crea, visualizza e cancella partite con data, orario e numero massimo di giocatori
- **Iscrizione alle partite** — unisciti alle partite di altri giocatori o abbandonale
- **Filtro per club** — sfoglia le partite disponibili filtrando per campo da golf
- **Dashboard personale** — visualizza le tue prossime partite e quelle del tuo club di appartenenza
- **Profilo utente** — aggiorna i tuoi dati e il club di appartenenza
- **Landing page pubblica** — vetrina dei club disponibili e delle prossime partite per gli utenti non registrati

---

## Stack tecnologico

| Layer | Tecnologia |
|---|---|
| Backend | Laravel 12 |
| Frontend | Blade + Tailwind CSS |
| Autenticazione | Laravel Breeze |
| Database | SQLite (sviluppo) / MySQL (produzione) |
| Asset bundling | Vite |

---

## Struttura del database

```
clubs
├── id
├── name
├── city
├── holes
└── timestamps

users
├── id
├── name
├── email
├── password
├── club_id (FK → clubs)
└── timestamps

games
├── id
├── user_id (FK → users)
├── club_id (FK → clubs)
├── date
├── tee_time
├── max_players
├── notes
└── timestamps

game_user (pivot)
├── game_id (FK → games)
└── user_id (FK → users)
```

---

## Installazione in locale

### Requisiti

- PHP 8.2+
- Composer
- Node.js 18+
- npm

### Procedura

```bash
# Clona il repository
git clone https://github.com/tuo-username/golf-buddy.git
cd golf-buddy

# Installa le dipendenze PHP
composer install

# Installa le dipendenze JavaScript
npm install

# Copia il file di configurazione
cp .env.example .env

# Genera la chiave dell'applicazione
php artisan key:generate

# Esegui le migration
php artisan migrate

# Avvia il server di sviluppo
php artisan serve

# In un terminale separato, compila gli asset
npm run dev
```

Apri il browser su `http://localhost:8000`.

---

## Variabili d'ambiente

Copia `.env.example` in `.env` e configura le variabili principali:

```env
APP_NAME="Golf Buddy"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
```

Per la produzione imposta:

```env
APP_ENV=production
APP_DEBUG=false
```

---

## Deploy

Il progetto è configurato per il deploy su [Railway](https://railway.app). Consulta la documentazione ufficiale di Railway per i dettagli sulla configurazione.

---

## Crediti

Sviluppato da **Jacopo** — © 2026

# Yowl

Yowl est une application web qui permet aux utilisateurs de commenter n'importe quel contenu trouvé sur Internet. Les commentaires sont partagés par toute la communauté Yowl, décentralisant ainsi les discussions des réseaux sociaux.

## Stack technique

- **Backend** : Laravel 10 (PHP 8.2)
- **Base de données** : MySQL 8.0
- **Authentification** : Session custom + Laravel Sanctum (API)
- **Frontend** : Blade + Bootstrap 5 + Vite
- **Conteneurisation** : Docker (app PHP-FPM + nginx + MySQL)

---

## Démarrage rapide avec Docker (recommandé)

### Prérequis Docker

- Docker >= 24
- Docker Compose >= 2.20

### Installation Docker

```bash
# 1. Cloner le dépôt
git clone <url-du-repo> && cd Yowl

# 2. Copier et configurer l'environnement
cp .env.example .env

# 3. Construire et démarrer les conteneurs
docker compose up -d --build

# 4. Générer la clé applicative
docker compose exec app php artisan key:generate

# 5. Lancer les migrations
docker compose exec app php artisan migrate

# 6. (Optionnel) Peupler avec des données de test
docker compose exec app php artisan db:seed
```

L'application est disponible sur <http://localhost:8080>.

### Commandes utiles

```bash
# Arrêter les conteneurs
docker compose down

# Voir les logs
docker compose logs -f

# Accéder au shell de l'app
docker compose exec app sh

# Lancer les tests
docker compose exec app php artisan test

# Reconstruire après modification du Dockerfile
docker compose up -d --build
```

### Troubleshooting Docker

| Problème | Solution |
| -------- | -------- |
| Port 8080 déjà utilisé | Modifier le port dans `docker-compose.yml` (`"XXXX:80"`) |
| Erreur de connexion DB | Attendre que le healthcheck MySQL passe (`docker compose ps`) |
| Permissions storage | `docker compose exec app chmod -R 777 storage bootstrap/cache` |
| Assets non compilés | `docker compose exec app npm run build` |

---

## Installation locale (sans Docker)

### Prérequis locaux

- PHP >= 8.2 avec extensions : `pdo_mysql`, `zip`, `dom`
- Composer >= 2
- Node.js >= 18 + npm
- MySQL 8.0

### Installation locale

```bash
# 1. Cloner et installer les dépendances PHP
git clone <url-du-repo> && cd Yowl
composer install

# 2. Installer les dépendances JS et compiler les assets
npm install && npm run build

# 3. Configurer l'environnement
cp .env.example .env
# Editer .env : DB_HOST=127.0.0.1, DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 4. Générer la clé
php artisan key:generate

# 5. Lancer les migrations
php artisan migrate

# 6. Démarrer le serveur de développement
php artisan serve
```

L'application est disponible sur <http://localhost:8000>.

Pour le développement frontend en hot-reload :

```bash
npm run dev
```

---

## Variables d'environnement clés

| Variable | Description | Valeur par défaut (Docker) |
| -------- | ----------- | -------------------------- |
| `APP_KEY` | Clé de chiffrement Laravel | généré via `artisan key:generate` |
| `DB_HOST` | Hôte MySQL | `db` (Docker) / `127.0.0.1` (local) |
| `DB_DATABASE` | Nom de la base | `yowl` |
| `DB_USERNAME` | Utilisateur MySQL | `yowl` |
| `DB_PASSWORD` | Mot de passe MySQL | `secret` |
| `MAIL_MAILER` | Driver mail | `smtp` |
| `MAIL_FROM_ADDRESS` | Adresse d'expédition | `no-reply@yowl.local` |

---

## Fonctionnalités

- Inscription / connexion avec confirmation par email
- Commenter n'importe quelle URL
- Répondre à un commentaire
- Liker / unliker un commentaire
- Voir tous les commentaires d'un utilisateur
- Modifier / supprimer ses propres commentaires
- Panel d'administration (gestion des users et commentaires)
- API REST (Sanctum)

---

## Tests

```bash
php artisan test
```

Les tests utilisent une base de données dédiée configurée dans `phpunit.xml`.

---

## CI/CD

Le pipeline GitHub Actions (`.github/workflows/ci.yml`) exécute automatiquement :

1. **Tests PHP** sur MySQL 8.0 (à chaque push sur `main` et `develop`, et PR vers `main`)
2. **Build Docker** pour vérifier que l'image se construit correctement

---

## Architecture Docker

```text
┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│    nginx    │────▶│  app (fpm)  │────▶│   MySQL 8   │
│  port 8080  │     │  port 9000  │     │  port 3306  │
└─────────────┘     └─────────────┘     └─────────────┘
```

- **nginx** : sert les fichiers statiques, proxifie PHP vers `app:9000`
- **app** : PHP-FPM 8.2, Laravel, Composer, Node (build assets)
- **db** : MySQL 8.0 avec volume persistant `db_data`

# 🚀 GoStage

Plateforme de mise en relation entre **étudiants** et **entreprises** pour les **stages**.

---

## 🎬 Vidéo de démonstration

👉 [Voir la démonstration sur Loom](https://www.loom.com/share/c7f3c287c3aa46538f4237d122a4dbba?sid=df6e2b08-933a-4c27-ab87-2dc6cb9f42e7)

---

## 🛠️ Installation locale (WAMP recommandé)

1. Télécharger et installer **WampServer** : [https://www.wampserver.com/](https://www.wampserver.com/)
2. Lancer WAMP et accéder à **phpMyAdmin**
3. Importer la base de données :
   - Aller dans phpMyAdmin
   - Créer une nouvelle base nommée **gostage_database**
   - Importer le fichier `gostage_database.sql` fourni dans ce dépôt
4. Copier le dossier du projet dans :
   C:\wamp64\www\GoStage\

markdown
5. Accéder au site depuis :
http://localhost/GoStage/view/connexion.php



---

## 📦 Fonctionnalités principales

### 👤 Authentification

- **Création de compte étudiant**  
  ↳ `view/inscription.php` → `Profil-be/create-user.php`

- **Création de compte entreprise**  
  ↳ `view/inscriptionEntreprise.php` → `Profil-entreprise-be/backInscription-entreprise.php`

- **Connexion**  
  ↳ `view/connexion.php` → `Logs-be/`

---

### 🧑‍🎓 Espace Étudiant

- **Modification du profil**  
  ↳ `view/profil.php` → `Profil-be/`

- **Consulter des offres**  
  ↳ `view/homeOffre.php`

- **Ajouter aux favoris / voir les offres**  
  ↳ `view/offres.php`  
  ↳ `Composant/tableauDeBord.php` → `Composant/tableauDeBord-be/`

---

### 🏢 Espace Entreprise

- **Modification du profil entreprise**  
  ↳ `view/profil-entreprise.php` → `Profil-entreprise-be/`

- **Création d’offres**  
  ↳ `view/ajoutOffres.php` → `Profil-entreprise-be/addOffre.php`

---

## 🧪 Technologies utilisées

- PHP / HTML / CSS / JavaScript
- MySQL (via phpMyAdmin)
- WAMP (développement local)
- GitHub (gestion de version)

---

## ✅ Contenu du dépôt

- Code source complet du projet
- Composants réutilisables (`header`, `footer`, `tableaux`)
- Fichier SQL : `gostage_database.sql`
- README explicatif
- Lien vers la **vidéo de démonstration**

---

## 🔗 Liens utiles

- 🎥 Démo : [Loom Video](https://www.loom.com/share/c7f3c287c3aa46538f4237d122a4dbba?sid=df6e2b08-933a-4c27-ab87-2dc6cb9f42e7)
- 📁 Dossier projet : `GoStage`
- 🗃️ Base de données : `gostage_database.sql`

---

## 📌 Remarques

Ce projet a été réalisé dans un cadre scolaire et n’est pas destiné à une mise en production sans sécurisation supplémentaire (hashage des mots de passe, CAPTCHA, validation côté serveur...).

---

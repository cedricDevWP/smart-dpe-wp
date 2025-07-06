
# Smart DPE

**Smart DPE** est une extension WordPress qui permet de **générer et afficher facilement des étiquettes DPE et GES** sur votre site web.

Elle se connecte à [https://smart-dpe.immo/](https://smart-dpe.immo/) : 
 
✅ Les utilisateurs possédant un compte peuvent directement récupérer et afficher leurs étiquettes enregistrées.  
✅ Pour les utilisateurs sans compte, une étiquette sera générée avec un filigrane.  
✅ Un abonnement premium permet de supprimer le filigrane et d’accéder à toutes les fonctionnalités.

---

## ✨ Fonctionnalités

- Génération d’étiquettes DPE & GES dynamiques.
- Connexion sécurisée à un compte Smart DPE.
- Stockage chiffré de l’identifiant et du mot de passe.
- Rafraîchissement automatique du token JWT via une tâche cron quotidienne.
- Shortcode configurable avec ou sans ID d’étiquette.
- Support des formats JPG et PNG.
- Plugin prêt pour la traduction (interface en anglais, étiquettes en français).

---

## 🔌 Prérequis

- **WordPress :** 5.8 ou plus récent
- **PHP :** version recommandée 7.4 ou supérieure  
  *(Vérifiez votre version PHP pour être compatible avec le chargement automatique Composer PSR-4.)*

- **Composer :** utilisé pour l’autoload PSR-4 des classes du plugin.

---

## 🚀 Installation

### 📦 Avec Git (pour développeurs)

```bash
git clone https://github.com/votre-repo/smart-dpe.git wp-content/plugins/smart-dpe
cd wp-content/plugins/smart-dpe
composer install
```

Activez l’extension depuis l’admin WordPress.

---

### 📥 Depuis WordPress.org *(à venir)*

- Téléchargez et téléversez l’archive ZIP.
- Activez l’extension depuis **Extensions > Extensions installées**.
- Configurez vos identifiants Smart DPE dans **Réglages > Smart DPE**.

---

## 🏷️ Utilisation

Ajoutez le shortcode dans vos pages ou articles :

```plaintext
[smart_dpe dpe="50" ges="3" format="jpg"]
```

Ou, si vous avez déjà une étiquette enregistrée sur [smart-dpe.immo](https://smart-dpe.immo/) :

```plaintext
[smart_dpe id="123"]
```

> 🔑 L’attribut `id` est prioritaire si présent.

---

## 🌍 Traduction

- L’interface du plugin est traduisible (anglais/français).
- Un fichier `.pot` est disponible dans le dossier `languages/`.
- Les étiquettes générées restent en français pour respecter les normes DPE.

> wp i18n make-pot . languages/smart-dpe.pot

---

## 🔒 Sécurité & Mises à jour

- Les tokens JWT sont stockés de manière sécurisée et chiffrée.
- Les credentials sont cryptés côté base de données.
- Les mises à jour seront distribuées via le dépôt officiel WordPress.org.

---

## 📢 Site officiel

[https://smart-dpe.immo/](https://smart-dpe.immo/)

---

## 📄 Licence

_La licence sera définie prochainement (GPLv2, GPLv3 ou licence privée)._

---

## 🛠️ Auteur

Développé par [Cédric Chevillard](https://cedricchevillard.fr/) pour [Smart DPE](https://smart-dpe.immo/).

---

## 🤝 Contributions

Suggestions et contributions bienvenues pour la version Git.

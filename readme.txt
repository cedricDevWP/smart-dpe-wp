=== Smart DPE ===
Contributors: cedricchevillard
Tags: dpe, ges, energy label, immobilier, étiquette énergétique
Requires at least: 5.8
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Génération et affichage d’étiquettes DPE et GES connectées à Smart DPE.

== Description ==

**Smart DPE** vous permet d'afficher facilement et automatiquement des étiquettes DPE et GES à jour sur votre site WordPress.

Conçu pour les professionnels de l'immobilier, propriétaires bailleurs ou gestionnaires de biens, ce plugin est directement connecté au service [Smart DPE](https://smart-dpe.immo/).

Gagnez du temps pour rester conforme aux obligations de performance énergétique, sans ressaisir vos données à chaque fois.

- Génération dynamique d’étiquettes aux normes.
- Connexion sécurisée à votre compte Smart DPE (ou usage gratuit avec filigrane).
- Affichage responsive sur toutes vos pages, articles ou annonces.
- Système de **cache automatique pendant 7 jours** pour limiter les requêtes à l’API.
- Option pour **vider le cache manuellement** par page ou contenu pour forcer la régénération.
- Mises à jour automatiques des étiquettes si vos diagnostics changent.

== Installation ==

1. Téléchargez l’extension depuis WordPress.org ou votre tableau de bord WordPress.
2. Activez l’extension via le menu **Extensions > Extensions installées**.
3. Rendez-vous dans **Réglages > Smart DPE** pour connecter votre compte Smart DPE avec votre email et mot de passe.
4. Copiez-collez le shortcode `[smart_dpe]` où vous souhaitez afficher l’étiquette.

== Frequently Asked Questions ==

= Est-ce que le plugin est gratuit ? =
Oui, le plugin est utilisable gratuitement. Sans compte Smart DPE, vos étiquettes générées contiendront un filigrane. Avec un compte premium, le filigrane est supprimé et vous accédez à vos étiquettes sauvegardées.

= Où trouver mon ID d'étiquette ? =
Depuis votre compte [Smart DPE](https://smart-dpe.immo/), récupérez l'ID de l’étiquette que vous souhaitez afficher.

= Comment utiliser le shortcode ? =
Vous pouvez insérer le shortcode dans vos pages, articles ou modèles. Exemples :
- Génération simple : `[smart_dpe dpe="50" ges="3" format="jpg"]`
- Affichage d’une étiquette existante : `[smart_dpe id="123"]`

Le format par défaut est le format "jpg".

= Comment fonctionne le cache ? =
Chaque étiquette est sauvegardée dans un cache interne pendant 7 jours pour réduire le nombre de requêtes vers l’API Smart DPE.  
Vous pouvez à tout moment vider le cache pour un contenu spécifique depuis l’éditeur WordPress.

= Les étiquettes sont-elles aux normes ? =
Oui, Smart DPE génère des étiquettes respectant la réglementation en vigueur.

== Screenshots ==

1. Réglages Smart DPE dans l’admin WordPress.
2. Exemple d’étiquette DPE affichée sur une page.
3. Bouton pour vider le cache Smart DPE d’un contenu.

== Changelog ==

= 1.0.0 =
* Version initiale : connexion API, gestion token JWT, cron de vérification, shortcode étiquette, système de cache de 7 jours avec bouton pour vider le cache.

== Upgrade Notice ==

= 1.0.0 =
Première version stable.

== License ==

Smart DPE est distribué sous licence GPLv3 ou ultérieure.

---

## 🔑 À savoir
- Mettez à jour votre site WordPress pour bénéficier des dernières améliorations.
- Toutes les données sensibles (identifiant / mot de passe) sont chiffrées.
- Le plugin est prêt pour la traduction (interface en anglais, étiquettes générées en français).
- Plus d’infos et support sur [https://smart-dpe.immo/](https://smart-dpe.immo/).

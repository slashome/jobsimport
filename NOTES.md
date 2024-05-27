# TEST DE FLORIAN BOULESTREAU

## 1. Liste des changements effectués
 - Déplacement des fichiers de liés à la base de données dans un dossier `database`
 - Déplacement des fichiers de scripts dans un dossier `scripts`
 - Création d'un fichier .env importé par Docker afin de gérer les variables d'environnement en dehors du code
 - Remplacer les `include` par des `require` pour que l'application s'arrête si un fichier n'est pas trouvé
 - Sortir la connection a la Database du JobImporter
 - Utilisation de namespaces et remplacemement de l'autoloader
 - Utilisation de requetes preparées au lieu de faire des execs

## 2. Liste des changements à effectuer
- Utiliser composer et son autoloader pour charger les classes
- Ajouter php-di pour gérer les dépendances proprement avec de l'injection
- Ajouter une gestion de migration avec un dossier `migrations` dans database et un fichier `migrations/20240616-1010.sql` (YMd-Hs) pour faciliter la mise en production et le suivi des mises a jours suivantes touchant la base de donnée.
- Séparer la config de dev et de prod
- Ajouter un linter
- Refactorer le importXML et importJSON pour faire un seul import qui prend en compte le type de fichier et le mapping des champs
- Creer un model NewJob séparé du model Job pour gérer les nouveaux jobs sans faire de champs NULL (interface Job ?)

## 3. Raisons de depassement du temps
- Cleaning avant ajout de feature pour que l'ajut de la feature se fasse dans de bonnes conditions
- Travail PHP hors framework
- Volonté de faire un code propre et maintenable

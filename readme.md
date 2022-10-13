# Déploiement de TRT_Conseil

## Prérequis sur le serveur

Que ce soit dans le cadre d'un déploiement en local ou en ligne, plusieurs éléments sont requis afin de permettre la bonne exécution de Symfony sur un serveur :

- PHP, dans sa version 8.0 au minimum

- Composer

## Cloner le dépot git en local ou sur un serveur

Un dépot git public est associé au projet TRT_Conseil. Pour le cloner en local ou sur un serveur, exécuter la commande :

`git clone https://github.com/cyrisa02/trt_app.git`

# On se déplace dans le dossier

cd trt

## Installer les dépendances du projet

Pour installer les dépendances du projet à partir du fichier composer.json, exécuter la commande :

`composer install`

## Configurer l'accès à la base de données et les variables d'environnement

Accéder au fichier .env à la racine du projet. A la ligne DATABASE_URL, renseignez vos informations de connexion à votre propre base de donnée sous la forme :

`DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"`

## Configurer la base de données ou avec le Makefile

Créer la base de donnée si elle n'existe pas déjà :

`php bin/console doctrine:database:create --if-not-exists` ou `make sf-dc`

Effectuer les migrations dans la base de données pour créer les différentes tables :

`php bin/console doctrine:migrations:migrate` ou `make sf-dmm`

## Ajouter des fausses données générées automatiquement dans la base de donnée (OPTIONNEL), un compte admin sera créé

Afin de tester le projet dans des conditions proches du réel, il est possible de générer des utilisateurs, ainsi que des formations automatiquement pour remplir la base de donnée ainsi que le site. Pour cela, exécuter la commande :

`php bin/console doctrine:fixtures:load` ou `make sf-fixtures`

## Lancer le serveur

`php bin/console server:run` ou `make sf-start`

## Créer un compte d'administrateur pour gérer le site et les demandes de formateur

Après création de la base de données, il est nécessaire de créer un compte d'administrateur qui pourra se connecter au site web et gérer celui-ci.

Tout d'abord, définir un mot de passe sécurisé pour l'administrateur. Ensuite, aller sur https://www.bcrypt.fr/ et générer un cryptage du mot de passe avec l'algorithme bcrypt.

Ensuite, exécutez la commande, en remplaçant, entre les parenthèses suivant 'VALUES' le nom_utilisateur, le hash_mot_de_passe généré précédemment, ainsi que l'email :

`php bin/console doctrine:query:sql "INSERT INTO user(id,email,roles,password,lastname,firstname) VALUES (UUID(),'email','['ROLE_ADMIN']','hash_mot_de_passe','2022-08-06 17:13:11',NULL,NULL,NULL,'nom_utilisateur','prenom_utilisateur');"`

Comme l'exemple:

INSERT INTO `user` VALUES (15,'cyrisa02.test@gmail.com','[\"ROLE_ADMIN\"]','$2y$13$2UdMQSEcgrMj0xkVgmTx6.0tqK5riv3zCu.DMwgntsfY/kaia7Bl.',NULL,NULL,NULL,'Nom','Prénom');

## Comptes déjà créés sur le site en ligne. https://trt-cyrisa.herokuapp.com/ ou par les fixtures

<h2>Admin: Equipe technique TRT_Conseil</h2>
	<p>recruteur@gmail.com     validé   code: azerty</p>
		<p>testrecrut@gmail.com    non validé   code: azerty </p>

    	<p>consultantok@gmail.com      code:azerty</p>

    	<p>candidat@test1.com   code: azerty</p>

    	<p>admin@trt.fr     code: azerty</p>

## Vidéos du mode d'emploi du site

en cours

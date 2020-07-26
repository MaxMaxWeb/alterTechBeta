# alterTechBeta
alterTech est un projet permettant aux futurs alternants de trouver des offres qui leur correspondent, ce projet utilise le protocole mercure (dans une forme prototypale) afin d'envoyer des notifications en temps réel au client


Afin d'utiliser le projet correctement ou vous servir du chat prototypale se trouvant dans la branche "Mercure-Testing"

Veuillez vous assurer d'avoir la version 0.3.3 de Mercure et la version 3.3.2

!!! Si vous souhaitez utiliser le "chat prototypal" veuillez cloner le repertoire : "Mercure-Testing" 



comme indiqué dans le composer.lock : 

"symfony/mercure-bundle": "^0.2.5",

 {
            "name": "lcobucci/jwt",
            "version": "3.3.2",
            "source": {
                "type": "git",
                "url": "https://github.com/lcobucci/jwt.git",
                "reference": "56f10808089e38623345e28af2f2d5e4eb579455"
            },
            
            
            {
            "name": "symfony/mercure",
            "version": "v0.3.0",
            "source": {
                "type": "git",
                "url": "https://github.com/symfony/mercure.git",
                "reference": "999c125d3a8f96a2b6e9be3da40ff4c25844d1da"
            },
}

Getting Started: 

- rendez vous à la racine du dossier "cd alterTech3" lancez la commande sudo-docker compose up 
- rendez vous ensuite sur "localhost:8095"

logs : 
serveur: mysql
Utilisateur: root
mot de passe root

créez une base de donnée du nom de alterTechDB2

uploadez le fichier alterTechDB2.sql qui se trouve dans le repertoire Github 

revenz à votre éditeur de texte, ouvrez le terminal rendez vous à nouveau à la racine du dossier avec la commande cd alterTech3

entrez la commande "symfony server:start" 

entrez la commande "composer require" ça ne fait jamais de mal 

Afin de lancer Mercure 

veuillez à nouveau entrez dans votre terminal entrez la commande:  cd /mercure suivi de la commande 

JWT_KEY='aVerySecretKey' ADDR='localhost:3000' ALLOW_ANONYMOUS=1 CORS_ALLOWED_ORIGINS='http://localhost:8000' ./mercure

Vous être prêts à utiliser le projet ! :) 


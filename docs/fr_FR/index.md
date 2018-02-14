# Présentation

Le plugin dialogflow permet de connecter Jeedom à Google Home/Assistant par une application native et les intéractions

> **NOTE**
>
> Il existe aussi le plugin Google Smarthome qui permet de connecter Jeedom à Google Home/Assitant mais cette fois par le biais de l'intégration Smarthome de Google, celui-ci n'utilise donc pas les intéractions. CE PLUGIN N'EST PAS ENCORE DISPONIBLE

# Configuration

Après l'installation et activation du plugin, il vous suffit d'aller dans le menu Administration de Jeedom, puis Configuration, onglet API et de récupérer (copier) la clef API du plugin Dialogflow. Ensuite aller dans le menu Plugins -> Communication -> Dialog flow.

![dialogflow](../images/dialogflow1.png)

> **IMPORTANT**
>
> Vous n'avez pas à créer d'équipement pour ce plugin. Il vous suffit de suivre les instructions ci-dessous.

Connectez-vous au Market via votre navigateur Internet (et pas via Jeedom), activez "Google Smarthome" dans l'onglet "Mes Jeedoms" à partir de votre profil et renseignez les champs : 

- URL de votre Jeedom (https obligatoire)
- Clef API Dialoglow (Jeedom Interaction) : réupérée précédemment

![dialogflow](../images/dialogflow7.png)

> **NOTE**
>
> Vous ne pouvez connecter qu'un seul Jeedom à Google par compte utilisateur Market

> **IMPORTANT**
>
> Suite à l'activation et/ou modification des informations pour Google Smarthome il faut **attendre 24h** pour que cela soit pris en compte (Status Actif vert)

Sur un téléphone avec l'application Google Assistant, dites "Parler avec Jeedom", Google va vous indiquer qu'il faut lier votre compte Jeedom et Google cliquez sur oui : 

![dialogflow](../images/dialogflow2.png)

Entrez vos identifiants Market : 

![dialogflow](../images/dialogflow3.png)

Google va vous indiquer que la configuration est crée/mise à jour avec succès : 

![dialogflow](../images/dialogflow4.png)

Voilà, le lien entre votre Jeedom et Google Home/Assistant est fait.

Vous pouvez maintenant parler à votre Jeedom et utiliser toutes les intéractions de votre Jeedom directement depuis votre Google Home/Assistant.
Depuis votre Google Home/Assistant, dites simplement "Parler à Jeedom", "Demande à Jeedom" ou encore "Dis à Jeedom" pour démarrer l'interaction avec Jeedom et "Merci" quand vous avez terminé pour clore la conversation.

# Mode sécurisé

Le mode sécurisé rajoute une couche d'autorisation au niveau de Jeedom. Par défaut seule la clef API est nécessaire, en mode securisé il y a une 2eme chaine de caractères unique par utilisateur (non stockée complétement en base) qui doit être valide.

Pour s'en servir rien de plus simple il faut aller sur la page de configuration du plugin et activer le mode sécurisé, ensuite vous faite une demande à Google pour Jeedom. Enfin aller sur dans le menu Plugins -> Communication -> Dialogflow vous allez voir une demande d'acceptation d'identifiant, il suffit de la valider.

> **NOTE**
>
> Le mode sécurisé n'est pas actif par défaut pour pouvoir passer la validation Google mais il est grandement conseillé de l'activer !


# FAQ

>**Google me dit que l'application n'est pas disponible**
>
>L'application est pour l'instant limitée géographiquement à la France. Nous l'ouvrirons dans un second après les premiers retours

# Presentation

Le plugin dialogflow permet de connecter Jeedom à Google Home/Assitant par une application native et les interactions

> **NOTE**
>
> Il existe aussi le plugin Google Smarthome qui permet de connecter Jeedom à Google Home/Assitant mais cette fois par le bias de l'intégration Smarthome de Google, celui-ci n'utilise donc pas les intéractions

# Configuration

Installez le plugin et activez-le. Ensuite allez sur la page Plugin -> Communication -> Dialog flow.

![dialogflow](../images/dialogflow1.png)

> **IMPORTANT**
>
> Vous n'avez pas à créer d'équipement pour ce plugin. Il vous suffit de suivre les instructions ci-dessous.

Sur le market il vous faut activer "Google Smarthome" dans l'onglet "Mes Jeedoms" à partir de votre profils et renseigner les champs : 

- URL du Jeedom
- Clef API Dialoglow (Jeedom Interaction) : vous la trouverez sur la page d'administration de Jeedom, onglet API

![dialogflow](../images/dialogflow7.png)

> **NOTE**
>
> Vous ne pouvez connecter que un seul Jeedom à Google par compte market

> **IMPORTANT**
>
> Suite à l'activation et/ou modification des informations pour Google Smarthome il faut attendre 24h pour que cela soit prise en compte

Sur votre Google Home ou sur un téléphone avec Google Assistant, dites "Parler avec Jeedom", Google va vous indiquer qu'il faut lier votre compte Jeedom et Google cliquez sur oui : 

![dialogflow](../images/dialogflow2.png)

Indiquez vos identifiants market : 

![dialogflow](../images/dialogflow3.png)

Google va vous indiquer que la configuration est crée/mise à jour avec succès : 

![dialogflow](../images/dialogflow4.png)

Vous pouvez ensuite parler à Jeedom, lors du premiere échange vous allez avoir :

![dialogflow](../images/dialogflow5.png)

Il faut aller Jeedom puis la Plugin -> Communication -> Dialog flow (ou la rafraichir si vous êtes déja dessus). Vous allez avoir une demande d'acceptation d'un utilisateur Google, il vous faut la valider :

![dialogflow](../images/dialogflow6.png)

Voilà, le lien entre votre Jeedom et Google Home/Assistant est fait.

Vous pouvez maintenant parler à votre Jeedom et utiliser toutes les interactions de votre Jeedom directement depuis votre Google Home/Assistant.
Depuis votre Google Home/Assistant, dites simplement "Parler à Jeedom", "Demande à Jeedom" ou encore "Dis à Jeedom" pour démarrer l'interaction avec Jeedom et "Merci" quand vous avez terminé pour clore la conversation.

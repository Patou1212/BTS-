# projet_panier
Le but de ce devoir est de créer un panier virtuel PHP


* BASES DE DONNEES
------------------

Une base de données "panier_projet" a été créée avec une table "products" contenant 4 champs : ID produits, article, prix et stock.

Le champs permet d'ajouter les articles en fonction du stock.

* PANIER VIRTUEL
----------------

Le panier est constitué par le "client" en créant une variable $_SESSION ['panier'] [$id] qui représente la quantité de l'article. $id représente l'identifiant de l'article.
Ainsi le panier est en fait un array qu'on peut représenter par ex. comme suit :

$_SESSION ['panier'] = (

1 => 1,
3 => 2
);

Dans cet exemple, le panier est constitué d'un article possédant l'identifiant 1 et de deux articles possédant l'identifiant 2.

Comme demander dans l'énoncé, ce panier est automatiquement stocké dans une variable $_COOKIE ['panier'] sous forme "serialize" pendant 15 jours dans l'ordinateur du "client".


* FICHIERS
----------

Ce devoir a deux fichiers principaux : index.php (page d'accueil où le catalogue produit s'affiche) et panier.php (où le panier s'affiche)



Un répertoire "include" regroupe les "bout de codes" répétitifs comme le header, la connexion à la BDD ou le footer et un fichier inc_refresh.php. 

Ce dernier set à éviter qu'à chaque rafraichissement de la page panier.php, le navigateur reprenne en compte le $_POST. Cela est génant, car en plus du message d'erreur du navigateur, si le "client" clique sur 
"renvoyer", la quantité du dernier produit s'incrémente !

L'astuce consiste à stocker le $_POST dans une variable temporaire $_SESSION['sauvegarde'], puis recharge de panier.php et arrêt du script. Ensuite, on teste l'existence de $_SESSION['sauvegarde'],
puis si elle existe, on l'affecte à $_POST et on détruit $_SESSION['sauvegarde']. Si elle n'existe pas, on poursuit le srcipt.



Un répertoire "scripts" regroupe les scripts php nécessaires au fonctionnement du panier : 


- session_panier.php : Fonctionnement du panier (création, mise à jour ou "vidange" de $_SESSION ['panier'] - création, mise à jour ou suppression de $_COOKIE ['panier'],
création des messages d'erreur)

- add.php : Ajoute une quantité en plus à un article et vérifie que le stock est suffisant

- less.php : Enlève une quantité à un article et supprime l'article si la quantié est égale à 0

- del.php : supprime un article (ou une ligne de $_SESSION['panier']). Si le nombre d'éléments de $_SESSION ['panier'] est supérieure à 1, alors on ne supprime que 
le produit en question. Si le nombre d'éléments de $_SESSION ['panier'] est égale à 1, alors on vide le panier (on créé un array vide) et on créé une variable 
$_SESSION ['del'], puis redirection vers panier.php . Ensuite, un isset ($_session['del']) permet de supprimer cette variable et surtout de supprimer $-COOKIE['panier'].
De cette manière, on vide le panier et on supprime $_COOKIE ['panier']. 

Nota : J'ai été obligé de créer temporairement $_SESSION['del'], car si la suppression du cookie dans la page del.php avec la redirection vers panier.php ne fonctionne pas. 
Le cookie n'est pas mis à jour.


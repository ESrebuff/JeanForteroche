# JeanForteroche
Pour faire fonctionner le site il faudra suivre les étapes suivantes :

1- Ajouter a votre base des données les imports de base de donnée en les rentrént dans l'ordre suivant :
    1er - `alaska_jf_admin`. 2ᵉ `alaska_jf_posts`. 3ᵉ `alaska_jf_comments`. C'est important de rentré le `alaska_jf_comments` après `alaska_jf_posts` car il y a une clef étrangère qui permet de faire fonctionner DELETE CASCADE
    
2- Changer les identifiants pour vous connecter a votre base de données dans le `Manager.php` qui se trouve lui-même dans `model`

3 - les identifiants pour l'espace administrateur :
    Compte : pseudoAdmin
    Mot de passe : passAdmin

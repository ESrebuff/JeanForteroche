<?php
require_once("model/Manager.php"); // Vous n'alliez pas oublier cette ligne ? ;o)
class AccountManager extends Manager
{  
    public function getPassAdmin($passconnect, $pseudoconnect)
    {   
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pass, role, pseudo FROM alaska_jf_admin WHERE pseudo = :pseudo');
        $req->execute(array('pseudo' => $pseudoconnect));
        $connecAccount = $req->fetch();
        return $connecAccount;
    }
}

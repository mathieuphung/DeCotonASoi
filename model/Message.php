<?php
class Message {
    public $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function addMessage($id, $message) {
        /*prepare sert à préparé une requête*/
        $requete = $this->connection-> prepare('INSERT INTO messages(login_id, message) VALUES (?, ?)');
        /*execute sert à mettre ce qu'il faut à la place des '?'*/
        $requete->execute(array($id, $message));
    }

    public function getAllMessages() {
        $reponse = $this->connection-> query('SELECT message, login FROM messages INNER JOIN users ON messages.login_id=users.id');
        $donnees = $reponse->fetchAll();

        return $donnees;
    }

    public function getUserByMessage($name) {
        $response = $this->connection-> prepare('SELECT * FROM messages INNER JOIN users ON messages.login_id=users.id WHERE login=?');
        $response->execute(array($name));
        $donnees = $response->fetchAll();

        return $donnees;
    }
}

class pooMail
{
    // Mail du destinataire
    public $mail = 'snydesign75@gmail.com';
    public $subject = 'Transversale';
    public $message = 'Message';
    public $header = 'From:"De Coton à Soie" <snydesign75@gmail.com>';
    public $r = "\r\n";

    public function subscriptionMail(){
        // Titre du Mail
        $this->subject = 'Votre inscription';
        // Message du Mail
        $this->message = 'Message pour votre inscription';
        // Condition pour empecher l'envois auto
        if (isset($_POST['nickname'])) {
            $testMail = mail($this->mail, $this->subject, $this->message);
                if ($testMail === true) {
                    echo "Message envoyé";   
                } else {
                    echo "Probleme technique";
                }
        }   
    }

    public function newsletterMail(){
        $this->subject = 'Votre newsletter';
        $this->message = 'Message pour la newsletter';
        if (isset($_POST['nickname'])) {
            $testMail = mail($this->mail, $this->subject, $this->message);
                if ($testMail === true) {
                    echo "Message envoyé";
                } else {
                    echo "Probleme technique";
                }
        }
    }

    public function buyMail(){
        $this->subject = 'Votre achat';
        $this->message = 'Message pour votre achat';
        if (isset($_POST['nickname'])) {
            $testMail = mail($this->mail, $this->subject, $this->message);
            if ($testMail === true) {
                echo "Message envoyé";
            } else {
                echo "Probleme technique";
            }
        }
    }
}

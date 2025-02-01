<?php
namespace Core\Authentication\Models;
use \Core\Base\Database as Database;
class RecoverModel {

    public function __construct() {
    }

    public function recover($usr) {
        if ((\Helpers::session('csrf') != \Helpers::post("csrf")) OR \Helpers::post("csrf") == "") {
            return "Rilevato errore nel CSRF.";
        }
        sleep(1);
        $user = Database::sql()->select("SELECT * FROM users WHERE email=? AND attivo=1", array($usr, $usr));
        if (sizeof($user) != 0) {

            $email = $user[0]["email"];
            $id = $user[0]["id"];

            $code = $this->randomString(10);
            $scadenza = date("Y-m-d", time() + (60 * 60 * 24));
            Database::sql()->update("UPDATE users SET codiceRecupero=?, codiceRecuperoScadenza=? WHERE id=? AND attivo=1", array($code, $scadenza, $id));


            $smtp = new \SMTP("..net", 25, '', "", "");
            $smtp->set('Content-Type', 'text/html; charset=UTF-8');
            $smtp->set('From', "recovery@" . $_SERVER['SERVER_NAME']);
            $smtp->set('To', $email);
            $smtp->set('Subject', "Recupero password account " . $_SERVER['SERVER_NAME']);


            $body = "Hai ricevuto questa email, perchè è stato chiesto un recupero password per il tuo account su " . $_SERVER['SERVER_NAME'] . ".<br>"
                    . "Se non hai chiesto nessun recupero password, ignora questa email. Per procedere al recupero clicca sul link qui sotto:<br>"
                    . " <a href='" . $_SERVER['SERVER_NAME'] . "/admin/recover/" . $code . "'>Resetta password </a>";
            $smtp->send($body);
            return "Email inviata";
        } else {
            return "Utente non trovato";
        }
    }

    public function checkRecoverCode($code) {
        $info = Database::sql()->select("SELECT * FROM users WHERE codiceRecupero=? AND codiceRecuperoScadenza>?", array($code, date("Y-m-d")));
        return (sizeof($info) != 0) ? $info[0] : false;
    }
    public function changePassword($id,$password) {
        Database::sql()->update("UPDATE users SET password=? WHERE id=?", array($password, $id));
        return true;
    }

    public function cleanRecoverCode($id) {
        Database::sql()->update("UPDATE users SET codiceRecupero='',codiceRecuperoScadenza='0000-00-00' WHERE id=?", array($id));
    }

}
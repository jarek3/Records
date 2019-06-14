<?php
// Správce uživatelů redakčního systému
class UserManager
{

        // Vrátí otisk hesla
        public function getHash($password)
        {
                return password_hash($password, PASSWORD_DEFAULT);
        }

        // Registruje nového uživatele do systému
        public function register($name, $password, $confirm_password, $rok)
        {
                if ($rok != date('Y'))
                        throw new UserError('Chybně vyplněný antispam.');
                if ($password != $confirm_password)
                        throw new UserError('Hesla nesouhlasí.');
                $user = array(
                        'name' => $name,
                        'password' => $this->getHash($password),
                );
                try
                {
                        Db::insert('uzivatele', $user);
                }
                catch (PDOException $chyba)
                {
                        throw new UserError('Uživatel s tímto jménem je již zaregistrovaný.');
                }
        }

        // Přihlásí uživatele do systému
        public function login($name, $password)
        {
                $user = Db::queryOne('
                        SELECT uzivatele_id, jmeno, admin, heslo
                        FROM uzivatele
                        WHERE jmeno = ?
                ', array($name));
                if (!$user || !password_verify($password, $user['heslo']))
                        throw new UserError('Neplatné jméno nebo heslo.');
                $_SESSION['user'] = $user;
        }

        // Odhlásí uživatele
        public function logout()
        {
                unset($_SESSION['user']);
        }

        // Zjistí, zda je přihlášený uživatel administrátor
        public function getUser()
        {
                if (isset($_SESSION['user']))
                        return $_SESSION['user'];
                return null;
        }

}
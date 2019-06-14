<?php

// Třída poskytuje metody pro správu kosmonautú v jejich evidenci
class CosmonautManager
{
         
        // Vrátí kosmonauta z databáze podle jeho id
        public function getCosmonaut($kosmonaut_id)
        {
            return Db::queryOne('
                SELECT `kosmonaut_id`, `jmeno`, `prijmeni`, `datum_narozeni`, `superschopnost`
                FROM `kosmonauti`
                WHERE `kosmonaut_id` = ?
                ', array($kosmonaut_id));
        }

        // Vrátí seznam kosmonautů v databázi
        public function getCosmonauts()
        {
            return Db::queryAll('
                SELECT `kosmonaut_id`, `jmeno`, `prijmeni`, `datum_narozeni`, `superschopnost`
                FROM `kosmonauti`
                ORDER BY `kosmonaut_id` DESC
                ');
        }
        
        public function insertCosmonaut($kosmonaut_id, $cosmonaut)
        {    
            if (!$kosmonaut_id)
                Db::insert('kosmonauti', $cosmonaut);
            else
                Db::update('kosmonauti', $cosmonaut, 'WHERE `kosmonaut_id` = ?', array($kosmonaut_id));
        }

        public function deleteCosmonaut($kosmonaut_id)
        {
            Db::query('
                DELETE FROM `kosmonauti`
                WHERE `kosmonaut_id` = ?
            ', array($kosmonaut_id));
        }
}
<?php
session_start();
mb_internal_encoding("UTF-8");

function autoloadFunkce($class)
{
        // Končí název třídy řetězcem "Kontroler" ?
        if (preg_match('/Controller/', $class))
                require("controllers/" . $class . ".php");
        else
                require("models/" . $class . ".php");
}
spl_autoload_register("autoloadFunkce");
// Připojení k databázi
Db::connect("sql2.webzdarma.cz", "evidencewzsk0356", "***", "evidencewzsk0356");
$router = new RouterController();
$router->process(array($_SERVER['REQUEST_URI']));
$router->renderView();
?> 
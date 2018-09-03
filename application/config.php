<?php
return array(
  'sitename' => 'Тестовая страница php фреймворка',
  'encode' => 'utf-8',
  'cookietime' => 3600, // время жизни куков администратора в секундах
  'version' => '1.0.0 ',
  'default_module' => 'index',
  'default_controller' => 'index',
  'default_action' => 'index',
  'db' => include 'config.db.php',
  'router' => array(
  '([a-z0-9+_\-]+)/([a-z0-9+_\-]+)/([0-9+_\-]+)' => 'controller/action/table/id',
  '([a-z0-9+_\-]+)/([a-z0-9+_\-]+)/([a-z0-9+_\-]+)' => 'controller/action/table',
  '([a-z0-9+_\-]+)/([a-z0-9+_\-]+)' => 'controller/action',
  '([a-z0-9+_\-]+)\.html' => 'page',
  '([a-z0-9+_\-]+)(/)?' => 'controller')
);
<?php
$arUrlRewrite=array (
  0 =>
  array (
    'CONDITION' => '#^/services/[^/]+/([^/]+)/?$#',
    'RULE' => 'CODE=$1',
    'ID' => 'best:service.detail',
    'PATH' => '/services/element.php',
    'SORT' => 10,
  ),
  1 =>
  array (
    'CONDITION' => '#^/services/([^/]+)/?$#',
    'RULE' => 'CODE=$1',
    'ID' => 'best:service.section',
    'PATH' => '/services/section.php',
    'SORT' => 20,
  ),
  2 =>
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
);

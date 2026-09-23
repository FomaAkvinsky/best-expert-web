<?php
$arUrlRewrite=array (
  0 =>
  array (
    'CONDITION' => '#^/services/([a-z0-9_-]+)/([a-z0-9_-]+)/?$#',
    'RULE' => 'SECTION_CODE=$1&CODE=$2',
    'ID' => 'best:service.detail',
    'PATH' => '/services/element.php',
    'SORT' => 10,
  ),
  1 =>
  array (
    'CONDITION' => '#^/services/([a-z0-9_-]+)/?$#',
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

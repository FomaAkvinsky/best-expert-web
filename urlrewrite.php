<?php
$arUrlRewrite=array (
  0 =>
  array (
    'CONDITION' => '#^/services/sudebnye-ekspertizy/([^/]+)/?$#',
    'RULE' => 'ELEMENT_CODE=$1',
    'ID' => 'best:service.detail',
    'PATH' => '/services/sudebnye-ekspertizy/detail.php',
    'SORT' => 50,
  ),
  1 =>
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
);
<?php

return array (
  'autoload' => false,
  'hooks' => 
  array (
    'app_init' => 
    array (
      0 => 'cms',
    ),
    'response_send' => 
    array (
      0 => 'cms',
    ),
    'user_sidenav_after' => 
    array (
      0 => 'cms',
      1 => 'signin',
    ),
    'admin_login_init' => 
    array (
      0 => 'loginbg',
    ),
    'config_init' => 
    array (
      0 => 'qcloudsms',
    ),
    'sms_send' => 
    array (
      0 => 'qcloudsms',
    ),
    'sms_notice' => 
    array (
      0 => 'qcloudsms',
    ),
    'sms_check' => 
    array (
      0 => 'qcloudsms',
    ),
  ),
  'route' => 
  array (
    '/$' => 'cms/index/index',
    '/cms/a/[:diyname]' => 'cms/archives/index',
    '/cms/t/[:name]' => 'cms/tags/index',
    '/cms/p/[:diyname]' => 'cms/page/index',
    '/cms/s' => 'cms/search/index',
    '/cms/c/[:diyname]' => 'cms/channel/index',
    '/cms/d/[:diyname]' => 'cms/diyform/index',
    '/cms/special/[:diyname]' => 'cms/special/index',
    '/u/[:id]' => 'cms/user/index',
  ),
);
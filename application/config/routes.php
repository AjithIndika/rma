<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'page';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['dash'] = 'sys/dash';
$route['setting'] = 'sys/setting';
$route['supplier'] = 'sys/supplier';
$route['items'] = 'sys/items';
$route['image_remove'] = 'sys/image_remove';
$route['roles'] = 'sys/roles';
$route['myimage'] = 'sys/myimage';

$route['logout'] = 'page/logout';


//users 

$route['usersr'] = 'account/usersr';

//repair 
$route['new'] = 'repair/new';
$route['sucess'] = 'repair/sucess';
$route['rma'] = 'repair/rma';
$route['supplier'] = 'repair/supplier';

$route['supplierupdate'] = 'repair/supplierupdate';


$route['ready'] = 'repair/ready';
$route['readyone'] = 'repair/readyone';
$route['print'] = 'repair/print';
$route['print_list'] = 'repair/print_list';
$route['supplier_repair'] = 'repair/supplier_repair';
$route['not_riceve'] = 'repair/not_riceve';
$route['doredy'] = 'repair/doredy';
$route['dispatch'] = 'repair/dispatch';
$route['liveserch'] = 'repair/liveserch';
$route['detailsrma'] = 'repair/detailsrma';
$route['estimate'] = 'repair/estimate';
$route['live'] = 'repair/live';
$route['handover'] = 'repair/handover';
$route['barcord'] = 'page/barcord';
$route['smssetting'] = 'sys/smssetting';
$route['mypassword'] = 'sys/mypassword';
$route['cash'] = 'sys/cash';
$route['oldcash'] = 'sys/oldcash';
$route['reedit'] = 'repair/reedit';
$route['immediate_job'] = 'repair/immediate_job';
$route['immediate_job_invoice'] = 'repair/immediate_job_invoice';
$route['warranty_send'] = 'report/warranty_send';









//report
$route['moneyReport'] = 'report/moneyReport';
$route['moneyReportTowdate'] = 'report/moneyReportTowdate';
$route['myprograss'] = 'report/myprograss';
$route['monthlyreport'] = 'report/monthlyreport';
$route['allpending_supplier_wise/(:any)'] = 'report/allpending_supplier_wise';
$route['shop/(:any)'] = 'report/shop';
$route['myreport'] = 'report/myreport';


























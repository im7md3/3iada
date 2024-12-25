<?php
$map = ['create', 'read', 'update', 'delete'];
$map_patients = ['create', 'read', 'update', 'delete', 'profile', 'transfer', 'show_phone', 'presence'];
$map_invoices = ['create', 'read', 'update', 'delete', 'retrieve', 'discount', 'pay_visit'];
$map_appointments = ['create', 'read', 'update', 'delete', 'transfered', 'waiting_patients'];
$map_read = ['read'];
$map_r_u_d = ['read', 'update', 'delete'];
$map_settings = ['read', 'update'];
return [
    'settings' => $map_settings,
    'roles' => $map,
    'departments' => $map,
    'countries' => $map,
    'cities' => $map,
    'relationships' => $map,
    'insurances' => $map,
    'notifications' => $map,
    'accounting_tree_and_daily_entries' => $map,
    'cost_centers' => $map,
    'doctors_statistics' => $map_read,
    'branches' => $map,
    'users' => $map,
    'appointments' => $map_appointments,
    'invoices' => $map_invoices,
    'products' => $map,
    'forms' => $map,
    'scan_names' => $map,
    'offers' => $map,
    'patients' => $map_patients,
    'diagnoses' => array_merge($map, ['recipe','show_teeth_model']),
    'patient_groups' => $map,
    'patient_group_discounts' => $map,
    'files' => $map,
    'scan_requests' => $map,
    'purchases' => $map,
    'expenses' => $map,
    'reports' => $map_r_u_d,
    'emergency' => $map,
    'pregnancy' => $map,
    'lab_requests' => $map,

];

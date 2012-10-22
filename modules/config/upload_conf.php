<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * upload folder where your product items will be stored
 * */
$config['product_directory'] = base_url().'uploads/product/';
$config['default_directory'] = base_url().'uploads/default/';
$config['default_file'] = 'default.png';
/*
 * this is the config for uploading product item
 * */
$config = array('upload_path'=>'./uploads/products',
                'allowed_types'=>'jpg|gif|png',
                'remove_spaces'=>TRUE,
                'overwrite'=>FALSE,
                'max_filename'=>0,
                'max_width'=>890);
                

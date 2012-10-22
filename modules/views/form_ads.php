<?php

echo form_open('administrator/admin_controller/create_new_ads');
$ads_title = array('name'=>'ads_title',
                   'id'=>'ads_title',
                   'value'=>set_value('ads_title'));

$ads_description = array('name'=>'ads_description',
                         'id'=>'ads_description',
                         'value'=>set_value('ads_description'));
$submit = array('name' =>'submit',
                'value'=>'submit');      
echo $this->session->flashdata('success'); 
echo validation_errors();            
echo form_input($ads_title);
echo form_input($ads_description);
echo form_submit($submit);
echo form_close();

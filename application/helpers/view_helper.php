<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('input_text'))
{
    function input_text($type,$name,$placeholder)
    {
       $input_html='<div class="form-group"><div class="col-md-10"> <input type="'.$type.'" name="'.$name.'" id="'.$name.'" placeholder="'.$placeholder.'" class="form-control input-md" /> </div></div>' ;
       return $input_html;
    }   
}

if ( ! function_exists('input_button'))
{
    function input_button($inputs)
    {
       $input_html='<div class="actions">'.$inputs.'  </div>' ;
       return $input_html;
    }   
}
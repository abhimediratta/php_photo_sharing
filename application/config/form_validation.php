<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
           'users/add_user' => array(
                                    array(
                                            'field' => 'name',
                                            'label' => 'name',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'password',
                                            'label' => 'password',
                                            'rules' => 'trim|required|min_length[6]'
                                         ),
                                    array(
                                            'field' => 'password_confirmation',
                                            'label' => 'password confirmation',
                                            'rules' => 'trim|required|matches[password]'
                                         ),
                                    array(
                                            'field' => 'email',
                                            'label' => 'Email',
                                            'rules' => 'trim|required|valid_email|callback__check_unique_email|xss_clean'
                                         )
                                    ),
            'sessions/login' => array(
                                array(
                                        'field' => 'email',
                                        'label' => 'Email',
                                        'rules' => 'trim|required|valid_email|xss_clean|callback__authenticate_user'
                                    ),
                                    array(
                                        'field' => 'password',
                                        'label' => 'password',
                                        'rules' => 'trim|required'
                                    )

                                ),
            'users/update_user' => array(
                                    array(
                                            'field' => 'name',
                                            'label' => 'name',
                                            'rules' => 'trim|required|xss_clean'
                                         ),
                                    array(
                                            'field' => 'password',
                                            'label' => 'password',
                                            'rules' => 'trim|required|min_length[6]'
                                         ),
                                    array(
                                            'field' => 'password_confirmation',
                                            'label' => 'password confirmation',
                                            'rules' => 'trim|required|matches[password]'
                                         ),
                                    array(
                                            'field' => 'email',
                                            'label' => 'Email',
                                            'rules' => 'trim|required|valid_email|xss_clean'
                                         )
                                    )
               );

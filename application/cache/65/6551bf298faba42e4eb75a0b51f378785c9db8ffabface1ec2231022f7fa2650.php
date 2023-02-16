<?php

/* admin/member/account_settings.twig */
class __TwigTemplate_261cf06bfb9fab36a29b659c72eddf6e0fab5b223111fd6aa7641cd922211b93 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->loadTemplate("admin/layout/header.twig", "admin/member/account_settings.twig", 1)->display($context);
        // line 2
        echo "<div id=\"js_messages\" style=\"display: none;\"> 
    <span id=\"please_enter_new_username_js\">";
        // line 3
        echo twig_escape_filter($this->env, lang("please_enter_new_username"), "html", null, true);
        echo "</span>
    <span id=\"username_not_available_js\">";
        // line 4
        echo twig_escape_filter($this->env, lang("username_not_available_js"), "html", null, true);
        echo "</span>
    <span id=\"please_re_enter_username_js\">";
        // line 5
        echo twig_escape_filter($this->env, lang("please_re_enter_username"), "html", null, true);
        echo "</span>
    <span id=\"user_name_mismatch_js\">";
        // line 6
        echo twig_escape_filter($this->env, lang("user_name_mismatch_js"), "html", null, true);
        echo "</span>
    <span id=\"pls_select_user_name_js\">";
        // line 7
        echo twig_escape_filter($this->env, lang("pls_select_user_name"), "html", null, true);
        echo "</span>
    <span id=\"please_wait_js\">";
        // line 8
        echo twig_escape_filter($this->env, lang("please_wait_js"), "html", null, true);
        echo "</span>
    <span id=\"sucessfully_changed_user_name_js\">";
        // line 9
        echo twig_escape_filter($this->env, lang("sucessfully_changed_user_name"), "html", null, true);
        echo "</span>
    <span id=\"success_js\">";
        // line 10
        echo twig_escape_filter($this->env, lang("success"), "html", null, true);
        echo "</span>
    <span id=\"failed_changed_user_name_js\">";
        // line 11
        echo twig_escape_filter($this->env, lang("failed_changed_user_name_js"), "html", null, true);
        echo "</span>
    <span id=\"failed_changed_email_js\">";
        // line 12
        echo twig_escape_filter($this->env, lang("failed_changed_email_js"), "html", null, true);
        echo "</span>
    <span id=\"please_enter_new_email_js\">";
        // line 13
        echo twig_escape_filter($this->env, lang("please_enter_new_email"), "html", null, true);
        echo "</span>
    <span id=\"invalid_email_js\">";
        // line 14
        echo twig_escape_filter($this->env, lang("invalid_email_js"), "html", null, true);
        echo "</span>
    <span id=\"please_re_enter_email_js\">";
        // line 15
        echo twig_escape_filter($this->env, lang("please_re_enter_email"), "html", null, true);
        echo "</span>
    <span id=\"email_mismatch_js\">";
        // line 16
        echo twig_escape_filter($this->env, lang("email_mismatch_js"), "html", null, true);
        echo "</span>
    <span id=\"failed_changed_tran_pass_js\">";
        // line 17
        echo twig_escape_filter($this->env, lang("failed_changed_tran_pass_js"), "html", null, true);
        echo "</span>
    <span id=\"failed_changed_pass_js\">";
        // line 18
        echo twig_escape_filter($this->env, lang("failed_changed_pass_js"), "html", null, true);
        echo "</span>
    <span id=\"please_enter_new_password_js\">";
        // line 19
        echo twig_escape_filter($this->env, lang("please_enter_new_password"), "html", null, true);
        echo "</span>
    <span id=\"please_re_enter_password_js\">";
        // line 20
        echo twig_escape_filter($this->env, lang("please_re_enter_password"), "html", null, true);
        echo "</span>
    <span id=\"password_mismatch_js\">";
        // line 21
        echo twig_escape_filter($this->env, lang("password_empty_or_missmatching_pls_try_again"), "html", null, true);
        echo "</span>
    <span id=\"transation_mismatch_js\">";
        // line 22
        echo twig_escape_filter($this->env, lang("transation_mismatch_js"), "html", null, true);
        echo "</span>
    <span id=\"please_re_enter_transation_password_js\">";
        // line 23
        echo twig_escape_filter($this->env, lang("please_re_enter_transation_password"), "html", null, true);
        echo "</span>
    <span id=\"please_enter_new_transation_password_js\">";
        // line 24
        echo twig_escape_filter($this->env, lang("please_enter_new_transation_password"), "html", null, true);
        echo "</span>
    <span id=\"sucessfully_changed_password_js\">";
        // line 25
        echo twig_escape_filter($this->env, lang("sucessfully_changed_password"), "html", null, true);
        echo "</span>
    <span id=\"sucessfully_changed_user_email_js\">";
        // line 26
        echo twig_escape_filter($this->env, lang("sucessfully_changed_user_email"), "html", null, true);
        echo "</span>
    <span id=\"sucessfully_changed_user_status_js\">";
        // line 27
        echo twig_escape_filter($this->env, lang("sucessfully_changed_user_status"), "html", null, true);
        echo "</span>
    <span id=\"sucessfully_changed_transation_password_js\">";
        // line 28
        echo twig_escape_filter($this->env, lang("sucessfully_changed_transation_password"), "html", null, true);
        echo "</span>
    <span id=\"updation_failed_js\">";
        // line 29
        echo twig_escape_filter($this->env, lang("updation_failed_js"), "html", null, true);
        echo "</span>
    <span id=\"suc_activated_user_js\">";
        // line 30
        echo twig_escape_filter($this->env, lang("suc_activated_user_js"), "html", null, true);
        echo "</span>
    <span id=\"suc_inactivated_user_js\">";
        // line 31
        echo twig_escape_filter($this->env, lang("suc_inactivated_user_js"), "html", null, true);
        echo "</span>
    <span id=\"suc_activated_user_login_js\">";
        // line 32
        echo twig_escape_filter($this->env, lang("suc_activated_user_login_js"), "html", null, true);
        echo "</span>
    <span id=\"suc_inactivated_user_login_js\">";
        // line 33
        echo twig_escape_filter($this->env, lang("suc_inactivated_user_login_js"), "html", null, true);
        echo "</span>
    <span id=\"suc_activated_user_reg_js\">";
        // line 34
        echo twig_escape_filter($this->env, lang("suc_activated_user_reg_js"), "html", null, true);
        echo "</span>
    <span id=\"suc_inactivated_user_reg_js\">";
        // line 35
        echo twig_escape_filter($this->env, lang("suc_inactivated_user_reg_js"), "html", null, true);
        echo "</span>
    <span id=\"failed_js\">";
        // line 36
        echo twig_escape_filter($this->env, lang("failed_js"), "html", null, true);
        echo "</span>

    <span id=\"failed_msg_js\">";
        // line 38
        echo twig_escape_filter($this->env, lang("failed_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"success_msg_js\">";
        // line 39
        echo twig_escape_filter($this->env, lang("success_msg_js"), "html", null, true);
        echo "</span>
    <span id=\"pls_enter_your_current_password_js\">";
        // line 40
        echo twig_escape_filter($this->env, lang("pls_enter_your_current_password"), "html", null, true);
        echo "</span>
    <span id=\"please_enter_your_current_user_name_js\">";
        // line 41
        echo twig_escape_filter($this->env, lang("please_enter_your_current_user_name"), "html", null, true);
        echo "</span>
    <span id=\"please_enter_your_current_transation_password_js\">";
        // line 42
        echo twig_escape_filter($this->env, lang("please_enter_your_current_transation_password"), "html", null, true);
        echo "</span>
    <span id=\"sucessfully_login_blocked_user_js\">";
        // line 43
        echo twig_escape_filter($this->env, lang("sucessfully_login_blocked_user"), "html", null, true);
        echo "</span>
    <span id=\"sucessfully_login_unblocked_user_js\">";
        // line 44
        echo twig_escape_filter($this->env, lang("sucessfully_login_unblocked_user"), "html", null, true);
        echo "</span>
    <span id=\"sucessfully_inactivated_user_registration_js\">";
        // line 45
        echo twig_escape_filter($this->env, lang("sucessfully_inactivated_user_registration"), "html", null, true);
        echo "</span>
    <span id=\"sucessfully_activated_user_registration_js\">";
        // line 46
        echo twig_escape_filter($this->env, lang("sucessfully_activated_user_registration"), "html", null, true);
        echo "</span>
    <span id=\"sucessfully_inactivated_user_login_js\">";
        // line 47
        echo twig_escape_filter($this->env, lang("sucessfully_inactivated_user_login"), "html", null, true);
        echo "</span>
    <span id=\"sucessfully_activated_user_login_js\">";
        // line 48
        echo twig_escape_filter($this->env, lang("sucessfully_activated_user_login"), "html", null, true);
        echo "</span>
    <span id=\"sucessfully_inactivated_user_js\">";
        // line 49
        echo twig_escape_filter($this->env, lang("sucessfully_inactivated_user"), "html", null, true);
        echo "</span>
    <span id=\"sucessfully_activated_user_js\">";
        // line 50
        echo twig_escape_filter($this->env, lang("sucessfully_activated_user"), "html", null, true);
        echo "</span>
    <span id=\"please_enter_username_js\">";
        // line 51
        echo twig_escape_filter($this->env, lang("please_enter_username_js"), "html", null, true);
        echo "</span>
    <span id=\"alphanumeric_js\">";
        // line 52
        echo twig_escape_filter($this->env, lang("alphanumeric_js"), "html", null, true);
        echo "</span>
    <span id=\"email_change_enabled_js\">";
        // line 53
        echo twig_escape_filter($this->env, lang("email_change_enabled_js"), "html", null, true);
        echo "</span>
    <span id=\"email_change_disabled_js\">";
        // line 54
        echo twig_escape_filter($this->env, lang("email_change_disabled_js"), "html", null, true);
        echo "</span>
    <span id=\"username_change_enabled_js\">";
        // line 55
        echo twig_escape_filter($this->env, lang("username_change_enabled_js"), "html", null, true);
        echo "</span>
    <span id=\"username_change_disabled_js\">";
        // line 56
        echo twig_escape_filter($this->env, lang("username_change_disabled_js"), "html", null, true);
        echo "</span>
    <span id=\"alphanumeric\">";
        // line 57
        echo twig_escape_filter($this->env, lang("alphanumeric"), "html", null, true);
        echo "</span>
    <span id=\"passwaord_validation_js\">";
        // line 58
        echo twig_escape_filter($this->env, lang("passwaord_validation_js"), "html", null, true);
        echo "</span>


</div>

<div class=\"row\">
    <div class=\"col-md-12\">
        <div class=\"panel panel-white\">
            <div class=\"panel-heading\">
                <h4 class=\"panel-title\"> <span class=\"text-bold\">";
        // line 67
        echo twig_escape_filter($this->env, lang("account_settings"), "html", null, true);
        echo "</span></h4>
                <div class=\"panel-tools\">
                    <div class=\"dropdown\">
                        <a data-toggle=\"dropdown\" class=\"btn btn-xs dropdown-toggle btn-transparent-grey\"><i class=\"fa fa-cog\"></i></a>
                        <ul class=\"dropdown-menu dropdown-light pull-right\" role=\"menu\">
                            <li><a class=\"panel-collapse collapses\" href=\"#\"><i class=\"fa fa-angle-up\"></i> <span>";
        // line 72
        echo twig_escape_filter($this->env, lang("collapse"), "html", null, true);
        echo "</span> </a></li>
                            <li><a class=\"panel-refresh\" href=\"#\"><i class=\"fa fa-refresh\"></i> <span>";
        // line 73
        echo twig_escape_filter($this->env, lang("refresh"), "html", null, true);
        echo "</span></a></li>
                            <li><a class=\"panel-expand\" href=\"#\"><i class=\"fa fa-expand\"></i> <span>";
        // line 74
        echo twig_escape_filter($this->env, lang("full_screen"), "html", null, true);
        echo "</span></a></li>
                        </ul>
                    </div>
                    <a class=\"btn btn-xs btn-link panel-close\" href=\"#\"><i class=\"fa fa-times\"></i></a>
                </div>
            </div>
            <div class=\"panel-body\">  
                <div class=\"alert alert-info\">
                    <button data-dismiss=\"alert\" class=\"close\">
                        ×
                    </button>
                    <strong>";
        // line 85
        echo twig_escape_filter($this->env, lang("notice"), "html", null, true);
        echo "</strong> :-
                    <a href=\"#\" class=\"alert-link\" data-toggle=\"modal\" data-target=\"#search_member_modal\">";
        // line 87
        echo twig_escape_filter($this->env, lang("click_here"), "html", null, true);
        echo "</a>";
        // line 88
        echo twig_escape_filter($this->env, lang("for_updating_others"), "html", null, true);
        echo ".
                </div>

                <div id=\"search_member_modal\" style=\"width: 750px;\" class=\"modal extended-modal fade no-display\" tabindex=\"-1\" data-focus-on=\"input:first\">
                    <div class=\"modal-header\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">
                            &times;
                        </button>
                        <h4 class=\"modal-title\">";
        // line 96
        echo twig_escape_filter($this->env, lang("search_member"), "html", null, true);
        echo "</h4>
                    </div>

                    <div class=\"modal-body\">";
        // line 100
        echo form_open("", " id=\"search_member_form\" name=\"search_member_form\"");
        echo "
                        <div class=\"form-horizontal\">                                            
                            <div class=\"errorHandler alert alert-danger no-display\">
                                <i class=\"fa fa-remove-sign\"></i>";
        // line 103
        echo twig_escape_filter($this->env, lang("form_error_msg"), "html", null, true);
        echo "
                            </div>                    
                            <div class=\"form-group\">
                                <label class=\"col-sm-4 control-label\">";
        // line 107
        echo twig_escape_filter($this->env, lang("username"), "html", null, true);
        echo ":<span class=\"symbol required\"></span>
                                </label>
                                <div class=\"col-sm-6\">
                                    <input class=\"typeahead form-control\" placeholder=\"";
        // line 110
        echo twig_escape_filter($this->env, lang("username"), "html", null, true);
        echo "\" type=\"text\" name=\"username\" id=\"username\" autocomplete=\"off\">
                                    <div  id=\"full_name\">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-default\">";
        // line 119
        echo twig_escape_filter($this->env, lang("cancel"), "html", null, true);
        echo "
                            </button>

                            <button type=\"submit\" class=\"btn btn-primary\" value=\"search_member\" name=\"search_member\">";
        // line 123
        echo twig_escape_filter($this->env, lang("search"), "html", null, true);
        echo " <i class=\"fa fa-arrow-circle-right\"></i>
                            </button> 
                        </div>";
        // line 126
        echo form_close();
        echo "
                    </div>
                </div>


                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <div class=\"tabbable tabs-left faq\">
                            <ul id=\"myTab3\" class=\"nav nav-tabs\">

                                <li class=\"";
        // line 136
        echo twig_escape_filter($this->env, ($context["tab1"] ?? null), "html", null, true);
        echo "\">
                                    <a href=\"javascript:#account_set_tab1\" data-toggle=\"tab\">
                                        <i class=\"fa fa-lock\"></i>";
        // line 138
        echo twig_escape_filter($this->env, lang("change_password"), "html", null, true);
        echo "
                                    </a>
                                </li>
                                <li class=\"";
        // line 141
        echo twig_escape_filter($this->env, ($context["tab2"] ?? null), "html", null, true);
        echo "\">
                                    <a href=\"javascript:#account_set_tab2\" data-toggle=\"tab\">
                                        <i class=\"fa fa-user\"></i>";
        // line 143
        echo twig_escape_filter($this->env, lang("change_user_name"), "html", null, true);
        echo "
                                    </a>
                                </li>
                                <li class=\"";
        // line 146
        echo twig_escape_filter($this->env, ($context["tab6"] ?? null), "html", null, true);
        echo "\">
                                    <a href=\"javascript:#account_set_tab6\" data-toggle=\"tab\">
                                        <i class=\"fa fa-envelope\"></i>";
        // line 148
        echo twig_escape_filter($this->env, lang("change_email"), "html", null, true);
        echo "
                                    </a>
                                </li>
                                <li class=\"";
        // line 151
        echo twig_escape_filter($this->env, ($context["tab3"] ?? null), "html", null, true);
        echo "\">
                                    <a href=\"javascript:#account_set_tab3\" data-toggle=\"tab\">
                                        <i class=\"fa fa-key\"></i>";
        // line 153
        echo twig_escape_filter($this->env, lang("change_transation_password"), "html", null, true);
        echo "
                                    </a>
                                </li>";
        // line 156
        if (($context["flag"] ?? null)) {
            // line 157
            echo "                                    <li class=\"";
            echo twig_escape_filter($this->env, ($context["tab4"] ?? null), "html", null, true);
            echo "\">
                                        <a href=\"javascript:#account_set_tab4\" data-toggle=\"tab\">
                                            <i class=\"fa fa-undo\"></i>";
            // line 159
            echo twig_escape_filter($this->env, lang("activate_inactivate"), "html", null, true);
            echo "
                                        </a>
                                    </li>";
        }
        // line 163
        echo "                                <li class=\"";
        echo twig_escape_filter($this->env, ($context["tab5"] ?? null), "html", null, true);
        echo "\">
                                    <a href=\"javascript:#account_set_tab5\" data-toggle=\"tab\">
                                        <i class=\"fa fa-forward\"></i>";
        // line 165
        echo twig_escape_filter($this->env, lang("forgot_transation_password"), "html", null, true);
        echo "
                                    </a>
                                </li>
                            </ul>
                            <div class=\"tab-content\">
                                <div class=\"tab-pane";
        // line 170
        echo twig_escape_filter($this->env, ($context["tab1"] ?? null), "html", null, true);
        echo "\" id=\"account_set_tab1\">
                                    <div id=\"accordion\" class=\"panel-group accordion accordion-custom accordion-teal\">

                                        <h3 class=\"margin-bottom-15\">";
        // line 173
        echo twig_escape_filter($this->env, lang("change_password"), "html", null, true);
        echo " - <b>";
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo "</b></h3>

                                        <br>";
        // line 176
        echo form_open("", " id=\"pass_set_form\" name=\"pass_set_form\"");
        echo "

                                        <div class=\"form-horizontal\">
                                            <div class=\"errorHandler alert alert-danger no-display\">
                                                <i class=\"fa fa-remove-sign\"></i>";
        // line 180
        echo twig_escape_filter($this->env, lang("form_error_msg"), "html", null, true);
        echo "
                                            </div>
                                            <div class=\"form-group\">
                                                <label class=\"col-sm-3 control-label\">";
        // line 184
        echo twig_escape_filter($this->env, lang("new_password"), "html", null, true);
        echo ":<span class=\"symbol required\"></span>
                                                </label>
                                                <div class=\"col-sm-6\">
                                                    <span class=\"input-icon input-icon-right\">
                                                        <input name=\"pass_password\" type=\"password\" placeholder=\"";
        // line 188
        echo twig_escape_filter($this->env, lang("new_password"), "html", null, true);
        echo "\" id=\"pass_password\" class=\"form-control password_reset\" tabindex='2'>
                                                        <i class=\"fa fa-lock\" onclick=\"toggle_password0('pass_password');\" id=\"showhide0\">Show</i> 
                                                    </span>

                                                </div>
                                            </div>
                                            <div class=\"form-group\">
                                                <label class=\"col-sm-3 control-label\">";
        // line 196
        echo twig_escape_filter($this->env, lang("re_enter_password"), "html", null, true);
        echo ":<span class=\"symbol required\"></span>
                                                </label>
                                                <div class=\"col-sm-6\">
                                                    <span class=\"input-icon input-icon-right\">
                                                        <input name=\"pass_re_enter_password\" type=\"password\" placeholder=\"";
        // line 200
        echo twig_escape_filter($this->env, lang("re_enter_password"), "html", null, true);
        echo "\" id=\"pass_re_enter_password\" class=\"form-control\" tabindex='3'>

                                                        <i class=\"fa fa-lock\" onclick=\"toggle_password1('pass_re_enter_password');\" id=\"showhide1\">Show</i> 

                                                </div>
                                            </div>
                                            <div class=\"form-group\">
                                                <label class=\"col-sm-3 control-label\">

                                                </label>
                                                <div class=\"col-sm-6\">";
        // line 211
        if (($context["PRESET_DEMO_STATUS"] ?? null)) {
            // line 212
            echo "                                                        <button  type=\"button\" class=\"btn btn-primary\" onclick=\"show_notification('warning', \$('#operation_blocked').html(), \$('#operation_blocked_msg').html())\">";
            // line 213
            echo twig_escape_filter($this->env, lang("change_password"), "html", null, true);
            echo " <i class=\"fa fa-arrow-circle-right\"></i>
                                                        </button>";
        } else {
            // line 216
            echo "
                                                        <button  type=\"submit\" class=\"btn btn-primary\" value=\"1\" name=\"submit_password\">";
            // line 218
            echo twig_escape_filter($this->env, lang("change_password"), "html", null, true);
            echo " <i class=\"fa fa-arrow-circle-right\"></i>
                                                        </button>";
        }
        // line 221
        echo "                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>

                                        </div>";
        // line 229
        echo form_close();
        echo "            


                                    </div>
                                </div>

                                <div class=\"tab-pane";
        // line 235
        echo twig_escape_filter($this->env, ($context["tab2"] ?? null), "html", null, true);
        echo "\" id=\"account_set_tab2\">
                                    <div id=\"accordion2\" class=\"panel-group accordion accordion-custom accordion-teal\">                                        

                                        <div class=\"row\">
                                            <div class=\"col-md-8\">
                                                <h3 class=\"margin-bottom-15\">";
        // line 240
        echo twig_escape_filter($this->env, lang("change_user_name"), "html", null, true);
        echo " - <b>";
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo "</b></h3>
                                            </div>
                                            <div class=\"col-md-4\">
                                                <label class=\"switch\">
                                                    <input type=\"checkbox\"";
        // line 244
        if (($context["username_edit"] ?? null)) {
            echo " checked";
        }
        echo "  id=\"togBtn1\"";
        if (($context["PRESET_DEMO_STATUS"] ?? null)) {
            echo " onclick=\"show_notification('warning', \$('#operation_blocked').html(), \$('#operation_blocked_msg').html())\"";
        } else {
            echo " onchange='changeUsernameChangeStatus(this)'";
        }
        echo "  >  

                                                    <div class=\"slider round\">
                                                        <span class=\"on\" title=\"";
        // line 247
        echo twig_escape_filter($this->env, lang("username_off_title"), "html", null, true);
        echo "\"> <i class=\"fa fa-check\"></i></span>
                                                        <span class=\"off\" title=\"";
        // line 248
        echo twig_escape_filter($this->env, lang("username_on_title"), "html", null, true);
        echo "\"> <i class=\"fa fa-times\"></i></span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>


                                        <br>";
        // line 256
        echo form_open("", " id=\"username_set_form\" name=\"username_set_form\"");
        echo "
                                        <div class=\"form-horizontal\">
                                            <div class=\"errorHandler alert alert-danger no-display\">
                                                <i class=\"fa fa-remove-sign\"></i>";
        // line 259
        echo twig_escape_filter($this->env, lang("form_error_msg"), "html", null, true);
        echo "
                                            </div>
                                            <div class=\"form-group\">
                                                <label class=\"col-sm-3 control-label\">";
        // line 263
        echo twig_escape_filter($this->env, lang("new_user_name"), "html", null, true);
        echo ":<span class=\"symbol required\"></span>
                                                </label>
                                                <div class=\"col-sm-6\">
                                                    <span class=\"input-icon input-icon-right\">

                                                        <input name=\"uname_new_username\" type=\"text\" placeholder=\"";
        // line 268
        echo twig_escape_filter($this->env, lang("new_user_name"), "html", null, true);
        echo "\" id=\"uname_new_username\" class=\"form-control\" tabindex='4'>
                                                        <i class=\"fa fa-user\"></i> </span>

                                                </div>
                                            </div>
                                            <div class=\"form-group\">
                                                <label class=\"col-sm-3 control-label\">";
        // line 275
        echo twig_escape_filter($this->env, lang("re_enter_user_name"), "html", null, true);
        echo ":<span class=\"symbol required\"></span>
                                                </label>
                                                <div class=\"col-sm-6\">
                                                    <span class=\"input-icon input-icon-right\">
                                                        <input name=\"uname_re_entry_username\" type=\"text\" placeholder=\"";
        // line 279
        echo twig_escape_filter($this->env, lang("re_enter_user_name"), "html", null, true);
        echo "\" id=\"uname_re_entry_username\" class=\"form-control\" tabindex='5'>

                                                        <i class=\"fa fa-user\"></i> </span>

                                                </div>
                                            </div>
                                            <div class=\"form-group\">
                                                <label class=\"col-sm-3 control-label\">

                                                </label>
                                                <div class=\"col-sm-6\">";
        // line 290
        if (($context["PRESET_DEMO_STATUS"] ?? null)) {
            // line 291
            echo "                                                        <button  type=\"button\" class=\"btn btn-primary\" onclick=\"show_notification('warning', \$('#operation_blocked').html(), \$('#operation_blocked_msg').html())\">";
            // line 292
            echo twig_escape_filter($this->env, lang("change_user_name"), "html", null, true);
            echo " <i class=\"fa fa-arrow-circle-right\"></i>
                                                        </button>";
        } else {
            // line 295
            echo "                                                        <button  type=\"submit\"class=\"btn btn-primary\" value=\"1\" name=\"submit_password\">";
            // line 296
            echo twig_escape_filter($this->env, lang("change_user_name"), "html", null, true);
            echo " <i class=\"fa fa-arrow-circle-right\"></i>
                                                        </button>";
        }
        // line 299
        echo "

                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>

                                        </div>";
        // line 309
        echo form_close();
        echo "
                                    </div>
                                </div>

                                <div class=\"tab-pane";
        // line 313
        echo twig_escape_filter($this->env, ($context["tab3"] ?? null), "html", null, true);
        echo "\" id=\"account_set_tab3\">
                                    <div id=\"accordion3\" class=\"panel-group accordion accordion-custom accordion-teal\">
                                        <h3 class=\"margin-bottom-15\">";
        // line 315
        echo twig_escape_filter($this->env, lang("change_transation_password"), "html", null, true);
        echo " - <b>";
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo "</b></h3>";
        // line 316
        echo form_open("", " id=\"trans_set_form\" name=\"trans_set_form\"");
        echo "
                                        <div class=\"form-horizontal\">
                                            <div class=\"errorHandler alert alert-danger no-display\">
                                                <i class=\"fa fa-remove-sign\"></i>";
        // line 319
        echo twig_escape_filter($this->env, lang("form_error_msg"), "html", null, true);
        echo "
                                            </div>
                                            <div class=\"form-group\">
                                                <label class=\"col-sm-3 control-label\">";
        // line 323
        echo twig_escape_filter($this->env, lang("new_password"), "html", null, true);
        echo " :<span class=\"symbol required\"></span>
                                                </label>
                                                <div class=\"col-sm-6\">
                                                    <span class=\"input-icon input-icon-right\">
                                                        <input name=\"tran_pass_password\" type=\"password\" placeholder=\"";
        // line 327
        echo twig_escape_filter($this->env, lang("new_password"), "html", null, true);
        echo "\" id=\"tran_pass_password\" class=\"form-control\" tabindex='6'>

                                                        <i class=\"fa fa-lock\" onclick=\"toggle_password2('tran_pass_password');\" id=\"showhide2\">Show</i>
                                                </div>
                                            </div>
                                            <div class=\"form-group\">
                                                <label class=\"col-sm-3 control-label\">";
        // line 334
        echo twig_escape_filter($this->env, lang("re_enter_password"), "html", null, true);
        echo "   :<span class=\"symbol required\"></span>                                                                 </label>
                                                <div class=\"col-sm-6\">
                                                    <span class=\"input-icon input-icon-right\">
                                                        <input name=\"tran_pass_re_enter_password\" type=\"password\" placeholder=\"";
        // line 337
        echo twig_escape_filter($this->env, lang("re_enter_password"), "html", null, true);
        echo " \" id=\"tran_pass_re_enter_password\" class=\"form-control\" tabindex='7'>

                                                        <i class=\"fa fa-lock\" onclick=\"toggle_password3('tran_pass_re_enter_password');\" id=\"showhide3\">Show</i>

                                                </div>
                                            </div>
                                            <div class=\"form-group\">
                                                <label class=\"col-sm-3 control-label\">

                                                </label>
                                                <div class=\"col-sm-6\">";
        // line 348
        if (($context["PRESET_DEMO_STATUS"] ?? null)) {
            // line 349
            echo "                                                        <button  type=\"button\" class=\"btn btn-primary\" onclick=\"show_notification('warning', \$('#operation_blocked').html(), \$('#operation_blocked_msg').html())\">";
            // line 350
            echo twig_escape_filter($this->env, lang("change_transation_password"), "html", null, true);
            echo " <i class=\"fa fa-arrow-circle-right\"></i>
                                                        </button>";
        } else {
            // line 354
            echo "                                                        <button  type=\"submit\"class=\"btn btn-primary\" value=\"1\" name=\"submit_password\">";
            // line 355
            echo twig_escape_filter($this->env, lang("change_transation_password"), "html", null, true);
            echo " <i class=\"fa fa-arrow-circle-right\"></i>
                                                        </button>";
        }
        // line 358
        echo "
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <br>

                                        </div>";
        // line 366
        echo form_close();
        echo "        
                                    </div>
                                </div>

                                <div class=\"tab-pane";
        // line 370
        echo twig_escape_filter($this->env, ($context["tab4"] ?? null), "html", null, true);
        echo "\" id=\"account_set_tab4\" style=\"height:330px\">
                                    <div id=\"accordion4\" class=\"panel-group accordion accordion-custom accordion-teal\">
                                        <h3 class=\"margin-bottom-15\">";
        // line 372
        echo twig_escape_filter($this->env, lang("activate_inactivate_user"), "html", null, true);
        echo " - <b>";
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo "</b></h3>

                                        <div class=\"form-horizontal\">";
        // line 375
        if (($context["flag"] ?? null)) {
            // line 376
            echo "
                                                <div class=\"form-group\">
                                                    <label class=\"col-sm-4 control-label\">";
            // line 379
            echo twig_escape_filter($this->env, lang("user_status"), "html", null, true);
            echo " : 
                                                    </label>
                                                    <div class=\"col-sm-4\">
                                                        <label class=\"switch\">
                                                            <input type=\"checkbox\"";
            // line 383
            if (($this->getAttribute(($context["user_status"] ?? null), "status", array()) == "active")) {
                echo " checked";
            }
            echo "  id=\"togBtn1\"";
            if (($context["PRESET_DEMO_STATUS"] ?? null)) {
                echo " onclick=\"show_notification('warning', \$('#operation_blocked').html(), \$('#operation_blocked_msg').html())\"";
            } else {
                echo " onchange='changeUserStatus(this)'";
            }
            echo "  >  

                                                            <div class=\"slider round\" >
                                                                <span class=\"on\" title=\"";
            // line 386
            echo twig_escape_filter($this->env, lang("disable"), "html", null, true);
            echo "\"> <i class=\"fa fa-check\"></i></span>
                                                                <span class=\"off\" title=\"";
            // line 387
            echo twig_escape_filter($this->env, lang("enable"), "html", null, true);
            echo "\"> <i class=\"fa fa-times\"></i></span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>


                                                <div class=\"form-group\">
                                                    <label class=\"col-sm-4 control-label\">";
            // line 396
            echo twig_escape_filter($this->env, lang("login_permission"), "html", null, true);
            echo " : 
                                                    </label>
                                                    <div class=\"col-sm-4\">
                                                        <label class=\"switch\">
                                                            <input type=\"checkbox\"";
            // line 400
            if ($this->getAttribute(($context["user_status"] ?? null), "login_block", array())) {
                echo " checked";
            }
            echo "  id=\"togBtn1\"";
            if (($context["PRESET_DEMO_STATUS"] ?? null)) {
                echo " onclick=\"show_notification('warning', \$('#operation_blocked').html(), \$('#operation_blocked_msg').html())\"";
            } else {
                echo " onchange='changeUserLoginStatus(this)'";
            }
            echo "  >  

                                                            <div class=\"slider round\" >
                                                                <span class=\"on\" title=\"";
            // line 403
            echo twig_escape_filter($this->env, lang("disable"), "html", null, true);
            echo "\"> <i class=\"fa fa-check\"></i></span>
                                                                <span class=\"off\" title=\"";
            // line 404
            echo twig_escape_filter($this->env, lang("enable"), "html", null, true);
            echo "\"> <i class=\"fa fa-times\"></i></span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class=\"form-group\">
                                                    <label class=\"col-sm-4 control-label\">";
            // line 412
            echo twig_escape_filter($this->env, lang("registration_permission"), "html", null, true);
            echo " : 
                                                    </label>
                                                    <div class=\"col-sm-4\">
                                                        <label class=\"switch\">
                                                            <input type=\"checkbox\"";
            // line 416
            if ($this->getAttribute(($context["user_status"] ?? null), "registration_block", array())) {
                echo " checked";
            }
            echo "  id=\"togBtn1\"";
            if (($context["PRESET_DEMO_STATUS"] ?? null)) {
                echo " onclick=\"show_notification('warning', \$('#operation_blocked').html(), \$('#operation_blocked_msg').html())\"";
            } else {
                echo " onchange='changeUserRegisterStatus(this)'";
            }
            echo "  >  

                                                            <div class=\"slider round\">
                                                                <span class=\"on\" title=\"";
            // line 419
            echo twig_escape_filter($this->env, lang("disable"), "html", null, true);
            echo "\"> <i class=\"fa fa-check\"></i></span>
                                                                <span class=\"off\" title=\"";
            // line 420
            echo twig_escape_filter($this->env, lang("enable"), "html", null, true);
            echo "\"> <i class=\"fa fa-times\"></i></span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>";
        } else {
            // line 426
            echo "                                                <h2>";
            echo twig_escape_filter($this->env, lang("you_cant_change_these_for_this_user"), "html", null, true);
            echo "</h2>";
        }
        // line 428
        echo "                                        </div>";
        // line 429
        echo form_close();
        echo "
                                    </div>
                                </div>
                                <div class=\"tab-pane";
        // line 432
        echo twig_escape_filter($this->env, ($context["tab5"] ?? null), "html", null, true);
        echo "\" id=\"account_set_tab5\">
                                    <div id=\"accordion4\" class=\"panel-group accordion accordion-custom accordion-teal\">
                                        <h3 class=\"margin-bottom-15\">";
        // line 434
        echo twig_escape_filter($this->env, lang("forgot_transation_password"), "html", null, true);
        echo " - <b>";
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo "</b></h3>

                                        <div class=\"form-horizontal\"> 
                                            <div class=\"errorHandler alert alert-danger no-display\">
                                                <i class=\"fa fa-remove-sign\"></i>";
        // line 438
        echo twig_escape_filter($this->env, lang("form_error_msg"), "html", null, true);
        echo "
                                            </div>
                                            <br> 


                                            <div class=\"alert alert-block alert-warning fade in\">
                                                <button data-dismiss=\"alert\" class=\"close\" type=\"button\">
                                                    ×
                                                </button>
                                                <h4 class=\"alert-heading\"><i class=\"fa fa-exclamation\"></i> Notice!</h4>
                                                <p>";
        // line 449
        echo twig_escape_filter($this->env, lang("forget_transation_password_msg"), "html", null, true);
        echo "
                                                </p>
                                                <p>
                                                    <button type=\"\" class=\"btn btn-yellow\" name=\"send_forget_password\" id=\"send_forget_password\">";
        // line 453
        echo twig_escape_filter($this->env, lang("forgot_button"), "html", null, true);
        echo " <i class=\"fa fa-arrow-circle-right\"></i>
                                                    </button>                        
                                                </p>
                                            </div>


                                            <br>
                                            <br>
                                            <br>


                                        </div>

                                    </div>
                                </div>

                                <div class=\"tab-pane";
        // line 469
        echo twig_escape_filter($this->env, ($context["tab6"] ?? null), "html", null, true);
        echo "\" id=\"account_set_tab6\">
                                    <div id=\"accordion2\" class=\"panel-group accordion accordion-custom accordion-teal\">
                                        <div class=\"row\">
                                            <div class=\"col-md-8\">
                                                <h3 class=\"margin-bottom-15\">";
        // line 473
        echo twig_escape_filter($this->env, lang("change_email"), "html", null, true);
        echo " - <b>";
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo "</b> </h3>
                                            </div>
                                            <div class=\"col-md-4\">
                                                <label class=\"switch\">
                                                    <input type=\"checkbox\"";
        // line 477
        if (($context["email_edit"] ?? null)) {
            echo " checked";
        }
        echo "  id=\"togBtn1\"";
        if (($context["PRESET_DEMO_STATUS"] ?? null)) {
            echo " onclick=\"show_notification('warning', \$('#operation_blocked').html(), \$('#operation_blocked_msg').html())\"";
        } else {
            echo " onchange='changeEmailChangeStatus(this)'";
        }
        echo "  >  

                                                    <div class=\"slider round\">
                                                        <span class=\"on\" title=\"";
        // line 480
        echo twig_escape_filter($this->env, lang("email_off_title"), "html", null, true);
        echo "\"> <i class=\"fa fa-check\"></i></span>
                                                        <span class=\"off\" title=\"";
        // line 481
        echo twig_escape_filter($this->env, lang("email_on_title"), "html", null, true);
        echo "\"> <i class=\"fa fa-times\"></i></span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <br>";
        // line 487
        echo form_open("", " id=\"email_set_form\" name=\"email_set_form\"");
        echo "
                                        <div class=\"form-horizontal\">
                                            <div class=\"errorHandler alert alert-danger no-display\">
                                                <i class=\"fa fa-remove-sign\"></i>";
        // line 490
        echo twig_escape_filter($this->env, lang("form_error_msg"), "html", null, true);
        echo "
                                            </div>
                                            <div class=\"form-group\">
                                                <label class=\"col-sm-3 control-label\">";
        // line 494
        echo twig_escape_filter($this->env, lang("new_email_id"), "html", null, true);
        echo ":<span class=\"symbol required\"></span>
                                                </label>
                                                <div class=\"col-sm-6\">
                                                    <span class=\"input-icon input-icon-right\">

                                                        <input name=\"email_id\" type=\"text\" placeholder=\"";
        // line 499
        echo twig_escape_filter($this->env, lang("new_email_id"), "html", null, true);
        echo "\" id=\"email_id\" class=\"form-control\" tabindex='4'>
                                                        <i class=\"fa fa-user\"></i> </span>

                                                </div>
                                            </div>
                                            <div class=\"form-group\">
                                                <label class=\"col-sm-3 control-label\">";
        // line 506
        echo twig_escape_filter($this->env, lang("re_enter_email_id"), "html", null, true);
        echo ":<span class=\"symbol required\"></span>
                                                </label>
                                                <div class=\"col-sm-6\">
                                                    <span class=\"input-icon input-icon-right\">
                                                        <input name=\"re_enter_email_id\" type=\"text\" placeholder=\"";
        // line 510
        echo twig_escape_filter($this->env, lang("re_enter_email_id"), "html", null, true);
        echo "\" id=\"re_enter_email_id\" class=\"form-control\" tabindex='5'>

                                                        <i class=\"fa fa-user\"></i> </span>

                                                </div>
                                            </div>
                                            <div class=\"form-group\">
                                                <label class=\"col-sm-3 control-label\">

                                                </label>
                                                <div class=\"col-sm-6\">";
        // line 521
        if (($context["PRESET_DEMO_STATUS"] ?? null)) {
            // line 522
            echo "                                                        <button  type=\"button\" class=\"btn btn-primary\" onclick=\"show_notification('warning', \$('#operation_blocked').html(), \$('#operation_blocked_msg').html())\">";
            // line 523
            echo twig_escape_filter($this->env, lang("change_email"), "html", null, true);
            echo " <i class=\"fa fa-arrow-circle-right\"></i>
                                                        </button>";
        } else {
            // line 526
            echo "                                                        <button  type=\"submit\"class=\"btn btn-primary\" value=\"1\" name=\"submit_email_id\">";
            // line 527
            echo twig_escape_filter($this->env, lang("change_email"), "html", null, true);
            echo " <i class=\"fa fa-arrow-circle-right\"></i>
                                                        </button>";
        }
        // line 530
        echo "

                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>

                                        </div>";
        // line 540
        echo form_close();
        echo "
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                                    
    </div>
</div>";
        // line 551
        $this->loadTemplate("admin/layout/footer.twig", "admin/member/account_settings.twig", 551)->display($context);
        // line 552
        echo "<link rel=\"stylesheet\" href=\"assets/css/checkbox_switcher.css\">
<link href=\"assets/plugins/sweetalert/lib/sweet-alert.css\" rel=\"stylesheet\" />
<script src=\"assets/plugins/sweetalert/lib/sweet-alert.min.js\"></script>
<link href=\"assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css\" rel=\"stylesheet\" type=\"text/css\"/>
<link href=\"assets/plugins/bootstrap-modal/css/bootstrap-modal.css\" rel=\"stylesheet\" type=\"text/css\"/>
<script src=\"assets/js/typeahead.js\">
</script>
<script src=\"assets/js/acc_set_admin.js\">
</script>
<script>
    jQuery(document).ready(function () {
        valChangeUsername();
        valChangeEmail();
        valChangePassword();
        valChangeTransaction();
        valsearchUser();
    });

    \$('input.typeahead').typeahead({
        source: function (query, process) {
            var url = \"";
        // line 572
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "admin/member/get_usernames\";
            return \$.get(url, {query: query}, function (data) {
                data = \$.parseJSON(data);
                return process(data);
            });
        }
    });
</script>

";
    }

    public function getTemplateName()
    {
        return "admin/member/account_settings.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1088 => 572,  1066 => 552,  1064 => 551,  1051 => 540,  1040 => 530,  1035 => 527,  1033 => 526,  1028 => 523,  1026 => 522,  1024 => 521,  1011 => 510,  1004 => 506,  995 => 499,  987 => 494,  981 => 490,  975 => 487,  967 => 481,  963 => 480,  949 => 477,  940 => 473,  933 => 469,  914 => 453,  908 => 449,  895 => 438,  886 => 434,  881 => 432,  875 => 429,  873 => 428,  868 => 426,  860 => 420,  856 => 419,  842 => 416,  835 => 412,  825 => 404,  821 => 403,  807 => 400,  800 => 396,  789 => 387,  785 => 386,  771 => 383,  764 => 379,  760 => 376,  758 => 375,  751 => 372,  746 => 370,  739 => 366,  730 => 358,  725 => 355,  723 => 354,  718 => 350,  716 => 349,  714 => 348,  701 => 337,  695 => 334,  686 => 327,  679 => 323,  673 => 319,  667 => 316,  662 => 315,  657 => 313,  650 => 309,  639 => 299,  634 => 296,  632 => 295,  627 => 292,  625 => 291,  623 => 290,  610 => 279,  603 => 275,  594 => 268,  586 => 263,  580 => 259,  574 => 256,  564 => 248,  560 => 247,  546 => 244,  537 => 240,  529 => 235,  520 => 229,  511 => 221,  506 => 218,  503 => 216,  498 => 213,  496 => 212,  494 => 211,  481 => 200,  474 => 196,  464 => 188,  457 => 184,  451 => 180,  444 => 176,  437 => 173,  431 => 170,  423 => 165,  417 => 163,  411 => 159,  405 => 157,  403 => 156,  398 => 153,  393 => 151,  387 => 148,  382 => 146,  376 => 143,  371 => 141,  365 => 138,  360 => 136,  347 => 126,  342 => 123,  336 => 119,  325 => 110,  319 => 107,  313 => 103,  307 => 100,  301 => 96,  290 => 88,  287 => 87,  283 => 85,  269 => 74,  265 => 73,  261 => 72,  253 => 67,  241 => 58,  237 => 57,  233 => 56,  229 => 55,  225 => 54,  221 => 53,  217 => 52,  213 => 51,  209 => 50,  205 => 49,  201 => 48,  197 => 47,  193 => 46,  189 => 45,  185 => 44,  181 => 43,  177 => 42,  173 => 41,  169 => 40,  165 => 39,  161 => 38,  156 => 36,  152 => 35,  148 => 34,  144 => 33,  140 => 32,  136 => 31,  132 => 30,  128 => 29,  124 => 28,  120 => 27,  116 => 26,  112 => 25,  108 => 24,  104 => 23,  100 => 22,  96 => 21,  92 => 20,  88 => 19,  84 => 18,  80 => 17,  76 => 16,  72 => 15,  68 => 14,  64 => 13,  60 => 12,  56 => 11,  52 => 10,  48 => 9,  44 => 8,  40 => 7,  36 => 6,  32 => 5,  28 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/member/account_settings.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\member\\account_settings.twig");
    }
}

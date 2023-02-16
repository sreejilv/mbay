<?php

/* admin/profile/index.twig */
class __TwigTemplate_43dde4d0137702c1108ef28c82924e9f9784332476d44dbad5378ac84a26dc25 extends Twig_Template
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
        $this->loadTemplate("admin/layout/header.twig", "admin/profile/index.twig", 1)->display($context);
        // line 2
        echo "<link href=\"assets/plugins/cropper-master/dist/cropper.min.css\" rel=\"stylesheet\">
<script src=\"assets/plugins/cropper-master/dist/cropper.min.js\"></script>
<div id=\"js_messages\" style=\"display: none;\">
    <span id=\"first_name_js\">";
        // line 5
        echo twig_escape_filter($this->env, lang("first_name_js"), "html", null, true);
        echo "</span>
    <span id=\"phone_number_js\">";
        // line 6
        echo twig_escape_filter($this->env, lang("phone_number_js"), "html", null, true);
        echo "</span>
    <span id=\"gender_js\">";
        // line 7
        echo twig_escape_filter($this->env, lang("gender_js"), "html", null, true);
        echo "</span>
    <span id=\"dob_js\">";
        // line 8
        echo twig_escape_filter($this->env, lang("dob_js"), "html", null, true);
        echo "</span>
    <span id=\"address_js\">";
        // line 9
        echo twig_escape_filter($this->env, lang("address_js"), "html", null, true);
        echo "</span>
    <span id=\"country_js\">";
        // line 10
        echo twig_escape_filter($this->env, lang("country_js"), "html", null, true);
        echo "</span>
    <span id=\"user_name_req_js\">";
        // line 11
        echo twig_escape_filter($this->env, lang("user_name_req_js"), "html", null, true);
        echo "</span>
    <span id=\"user_name_inv_js\">";
        // line 12
        echo twig_escape_filter($this->env, lang("user_name_inv_js"), "html", null, true);
        echo "</span>
    <span id=\"validate_dob\">";
        // line 13
        echo twig_escape_filter($this->env, lang("validate_dob"), "html", null, true);
        echo "</span>
    <span id=\"validate_age\">";
        // line 14
        echo twig_escape_filter($this->env, lang("validate_age"), "html", null, true);
        echo "</span>
    <span id=\"success_js\">";
        // line 15
        echo twig_escape_filter($this->env, lang("success_js"), "html", null, true);
        echo "</span>
    <span id=\"social_profile_updated_js\">";
        // line 16
        echo twig_escape_filter($this->env, lang("social_profile_updated_js"), "html", null, true);
        echo "</span>
    <span id=\"social_profile_failed_js\">";
        // line 17
        echo twig_escape_filter($this->env, lang("social_profile_failed_js"), "html", null, true);
        echo "</span>

    <span id=\"cover_pic_req_js\">";
        // line 19
        echo twig_escape_filter($this->env, lang("cover_pic_req_js"), "html", null, true);
        echo "</span>
    <span id=\"cover_pic_ext_js\">";
        // line 20
        echo twig_escape_filter($this->env, lang("cover_pic_ext_js"), "html", null, true);
        echo "</span>
    <span id=\"prof_pic_req_js\">";
        // line 21
        echo twig_escape_filter($this->env, lang("prof_pic_req_js"), "html", null, true);
        echo "</span>
    <span id=\"prof_pic_ext_js\">";
        // line 22
        echo twig_escape_filter($this->env, lang("prof_pic_ext_js"), "html", null, true);
        echo "</span>
    <span id=\"link_copied_js\">";
        // line 23
        echo twig_escape_filter($this->env, lang("link_copied_js"), "html", null, true);
        echo "</span>
</div>
<div class=\"row\">
    <div class=\"col-md-12\">
        <div class=\"panel panel-white\">
            <div class=\"panel-heading\">
                <h4 class=\"panel-title\"><span class=\"text-bold\">";
        // line 29
        echo twig_escape_filter($this->env, lang("profile"), "html", null, true);
        echo " </span></h4>
                <div class=\"panel-tools\">
                    <div class=\"dropdown\">
                        <a data-toggle=\"dropdown\" class=\"btn btn-xs dropdown-toggle btn-transparent-grey\"><i
                                class=\"fa fa-cog\"></i></a>
                        <ul class=\"dropdown-menu dropdown-light pull-right\" role=\"menu\">
                            <li><a class=\"panel-collapse collapses\" href=\"#\"><i class=\"fa fa-angle-up\"></i>
                                    <span>";
        // line 36
        echo twig_escape_filter($this->env, lang("collapse"), "html", null, true);
        echo "</span> </a></li>
                            <li><a class=\"panel-refresh\" href=\"#\"><i class=\"fa fa-refresh\"></i>
                                    <span>";
        // line 38
        echo twig_escape_filter($this->env, lang("refresh"), "html", null, true);
        echo "</span></a></li>
                            <li><a class=\"panel-expand\" href=\"#\"><i class=\"fa fa-expand\"></i>
                                    <span>";
        // line 40
        echo twig_escape_filter($this->env, lang("full_screen"), "html", null, true);
        echo "</span></a></li>
                        </ul>
                    </div>
                    <a class=\"btn btn-xs btn-link panel-close\" href=\"#\"><i class=\"fa fa-times\"></i></a>
                </div>
            </div>
            <div class=\"panel-body\">
                <hr>

                <div class=\"alert alert-info\">
                    <button data-dismiss=\"alert\" class=\"close\">
                        ×
                    </button>
                    <strong>";
        // line 53
        echo twig_escape_filter($this->env, lang("notice"), "html", null, true);
        echo "</strong> :-
                    <a href=\"#\" class=\"alert-link\" data-toggle=\"modal\" data-target=\"#search_member_modal\">";
        // line 55
        echo twig_escape_filter($this->env, lang("click_here"), "html", null, true);
        echo "</a>";
        // line 56
        echo twig_escape_filter($this->env, lang("for_searching_a_member"), "html", null, true);
        echo ".
                </div>

                <div id=\"search_member_modal\" style=\"width: 750px;\" class=\"modal extended-modal fade no-display\"
                     tabindex=\"-1\" data-focus-on=\"input:first\">
                    <div class=\"modal-header\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">
                            &times;
                        </button>
                        <h4 class=\"modal-title\">";
        // line 65
        echo twig_escape_filter($this->env, lang("select_user_name"), "html", null, true);
        echo "</h4>
                    </div>

                    <div class=\"modal-body\">";
        // line 69
        echo form_open("", " id=\"search_member\" name=\"search_member\"");
        echo "
                        <div class=\"form-horizontal\">
                            <div class=\"errorHandler alert alert-danger no-display\">
                                <i class=\"fa fa-remove-sign\"></i>";
        // line 72
        echo twig_escape_filter($this->env, lang("form_error_msg"), "html", null, true);
        echo "
                            </div>

                            <div class=\"form-group\">
                                <label class=\"col-sm-5 control-label\">";
        // line 77
        echo twig_escape_filter($this->env, lang("select_user_name"), "html", null, true);
        echo "
                                </label>
                                <div class=\"col-sm-6\">
                                    <input class=\"typeahead form-control\" type=\"text\" name=\"user_name\" placeholder=\"";
        // line 80
        echo twig_escape_filter($this->env, lang("select_user_name"), "html", null, true);
        echo "\" id=\"user_name\" autocomplete=\"off\">
                                </div>
                            </div>
                        </div>

                        <div class=\"modal-footer\">
                            <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-default\">";
        // line 87
        echo twig_escape_filter($this->env, lang("cancel"), "html", null, true);
        echo "
                            </button>

                            <button type=\"submit\" class=\"btn btn-primary\" value=\"1\" name=\"search_member\">";
        // line 91
        echo twig_escape_filter($this->env, lang("select"), "html", null, true);
        echo " <i class=\"fa fa-arrow-circle-right\"></i>
                            </button>
                        </div>";
        // line 95
        echo form_close();
        echo "
                    </div>
                </div>



                <div class=\"fb-profile\">
                    
                    <div class=\"show-image\">
                        <div class=\"profileBanner\">
                            <img align=\"left\" class=\"fb-image-lg\"
                                 src=\"assets/images/users/";
        // line 106
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "user_cover", array()), "html", null, true);
        echo "\"/>
                            <button class=\"update btn btn-link\" data-toggle=\"modal\" data-target=\"#myModal\"><i
                                    class=\"fa fa-edit fa-fw\"></i></button>
                        </div>
                    </div>

                    <div class=\"show-image2\">
                        <div class=\"profilePic\">
                            <img class=\"img-circle fb-image-profile\" src=\"assets/images/users/";
        // line 114
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "user_dp", array()), "html", null, true);
        echo "\"/>
                            <button class=\"update2 btn btn-link\" data-toggle=\"modal\" data-target=\"#myModal2\"><i
                                    class=\"fa fa-edit fa-fw\"></i></button>
                        </div>
                    </div>

                </div>
                            
                <div class=\"fb-profile-text\">
                    <h2>";
        // line 123
        echo twig_escape_filter($this->env, lang("username"), "html", null, true);
        echo " :- <b>";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "user_name", array()), "html", null, true);
        echo "</b></h2>
                </div>

                <div id=\"myModal\" class=\"modal extended-modal fade no-display\" tabindex=\"-1\" data-width=\"760\">
                    <div class=\"modal-dialog\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                <h4 class=\"modal-title\">";
        // line 131
        echo twig_escape_filter($this->env, lang("change_cover_pic"), "html", null, true);
        echo "</h4>
                            </div>
                            <div class=\"modal-body\">

                                <div class=\"tabbable\">
                                    <ul class=\"nav nav-tabs\">
                                        <li class=\"active\">
                                            <a data-toggle=\"tab\" href=\"javascript:#cover_tab1\">";
        // line 139
        echo twig_escape_filter($this->env, lang("add_new"), "html", null, true);
        echo "
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle=\"tab\" href=\"javascript:#cover_tab2\">";
        // line 144
        echo twig_escape_filter($this->env, lang("photos_of_u"), "html", null, true);
        echo "
                                            </a>
                                        </li>

                                        <li>
                                            <a data-toggle=\"tab\" href=\"#cover_tab3\">";
        // line 150
        echo twig_escape_filter($this->env, lang("default_covers"), "html", null, true);
        echo "
                                            </a>
                                        </li>

                                        <li>
                                            <a data-toggle=\"tab\" href=\"#cover_tab4\">";
        // line 156
        echo twig_escape_filter($this->env, lang("crop"), "html", null, true);
        echo "
                                            </a>
                                        </li>

                                    </ul>
                                    <div class=\"tab-content\">
                                        <div id=\"cover_tab1\" class=\"tab-pane fade in active\">";
        // line 163
        echo form_open_multipart("", " id=\"cover_form\" name=\"cover_form\"");
        echo "
                                            <div class=\"form-horizontal\">
                                                <div class=\"errorHandler alert alert-danger no-display\">
                                                    <i class=\"fa fa-remove-sign\"></i>";
        // line 166
        echo twig_escape_filter($this->env, lang("form_error_msg"), "html", null, true);
        echo "
                                                </div>
                                                <div class=\"form-group\">
                                                    <label class=\"col-sm-3 control-label\">";
        // line 170
        echo twig_escape_filter($this->env, lang("select_image"), "html", null, true);
        echo "
                                                    </label>
                                                    <div class=\"fileupload fileupload-new col-sm-6\"
                                                         data-provides=\"fileupload\">
                                                        <div class=\"fileupload-new thumbnail\" style=\"height: 75px;\">
                                                            <img src=\"assets/images/users/";
        // line 175
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "user_cover", array()), "html", null, true);
        echo "\" alt=\"\">
                                                        </div>
                                                        <div class=\"fileupload-preview fileupload-exists thumbnail\"></div>
                                                        <div class=\"user-edit-image-buttons\">
                                                            <span class=\"btn btn-azure btn-file\">
                                                                <span class=\"fileupload-new\"><i
                                                                        class=\"fa fa-picture\"></i>";
        // line 181
        echo twig_escape_filter($this->env, lang("select_image"), "html", null, true);
        echo "</span>
                                                                <span class=\"fileupload-exists\"><i
                                                                        class=\"fa fa-picture\"></i>";
        // line 183
        echo twig_escape_filter($this->env, lang("change"), "html", null, true);
        echo "</span>
                                                                <input type=\"file\" id=\"cover_pic\" name=\"cover_pic\" accept=\"image/*\" />
                                                            </span>
                                                            <a href=\"#\" class=\"btn fileupload-exists btn-red\"
                                                               data-dismiss=\"fileupload\">
                                                                <i class=\"fa fa-times\"></i>";
        // line 188
        echo twig_escape_filter($this->env, lang("remove"), "html", null, true);
        echo "
                                                            </a>
                                                        </div>
                                                        <div class=\"alert alert-warning\">
                                                            <span class=\"label label-warning\">";
        // line 192
        echo twig_escape_filter($this->env, lang("note"), "html", null, true);
        echo "!</span>
                                                            <span>";
        // line 193
        echo twig_escape_filter($this->env, lang("supported_formats"), "html", null, true);
        echo " :";
        echo twig_escape_filter($this->env, lang("JPEG"), "html", null, true);
        echo " ,";
        echo twig_escape_filter($this->env, lang("PNG"), "html", null, true);
        echo " ,";
        echo twig_escape_filter($this->env, lang("JPG"), "html", null, true);
        echo " </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=\"form-group\">
                                                    <label class=\"col-sm-3 control-label\">

                                                    </label>
                                                    <div class=\"col-sm-4\">
                                                        <button type=\"submit\" class=\"btn btn-primary\"
                                                                value=\"cover_update\" name=\"cover_update\">";
        // line 204
        echo twig_escape_filter($this->env, lang("update"), "html", null, true);
        echo " <i
                                                                class=\"fa fa-arrow-circle-right\"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>";
        // line 210
        echo form_close();
        echo "
                                        </div>
                                        <div id=\"cover_tab2\" class=\"tab-pane fade\">

                                            <div class=\"row\">";
        // line 215
        if (twig_length_filter($this->env, ($context["user_cov"] ?? null))) {
            // line 216
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["user_cov"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["uco"]) {
                // line 217
                echo "                                                        <div class=\"col-sm-4\">
                                                            <img style=\"height:100px;width:auto;max-width:145px;\"
                                                                 src=\"assets/images/users/";
                // line 219
                echo twig_escape_filter($this->env, $this->getAttribute($context["uco"], "file", array()), "html", null, true);
                echo "\"
                                                                 class=\"img-responsive\">
                                                            <br>
                                                            <button type=\"button\" class=\"btn btn-blue btn-xs\"
                                                                    onclick=\"setCover(";
                // line 223
                echo twig_escape_filter($this->env, $this->getAttribute($context["uco"], "id", array()), "html", null, true);
                echo ");\">";
                // line 224
                echo twig_escape_filter($this->env, lang("set_this_cover"), "html", null, true);
                echo "
                                                            </button>
                                                            <p>
                                                        </div>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['uco'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 230
            echo "                                                    <h4 align=\"center\">";
            echo twig_escape_filter($this->env, lang("no_image_available"), "html", null, true);
            echo "</h4>";
        }
        // line 232
        echo "
                                            </div>
                                        </div>


                                        <div id=\"cover_tab3\" class=\"tab-pane fade\">
                                            <div class=\"row\">";
        // line 239
        if (twig_length_filter($this->env, ($context["def_cov"] ?? null))) {
            // line 240
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["def_cov"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["df"]) {
                // line 241
                echo "                                                        <div class=\"col-sm-4\">
                                                            <img style=\"height:100px;width:auto;max-width:145px;\"
                                                                 src=\"assets/images/users/";
                // line 243
                echo twig_escape_filter($this->env, $context["df"], "html", null, true);
                echo "\"
                                                                 class=\"img-responsive\">
                                                            <br>
                                                            <button type=\"button\" class=\"btn btn-blue btn-xs\"
                                                                    onclick=\"setDefCover('";
                // line 247
                echo twig_escape_filter($this->env, $context["df"], "html", null, true);
                echo "');\">";
                // line 248
                echo twig_escape_filter($this->env, lang("set_this_cover"), "html", null, true);
                echo "
                                                            </button>
                                                            <p>
                                                        </div>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['df'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 256
            echo "                                                    <h4 align=\"center\">";
            echo twig_escape_filter($this->env, lang("no_image_available"), "html", null, true);
            echo "</h4>";
        }
        // line 258
        echo "                                            </div>
                                        </div>


                                        <div id=\"cover_tab4\" class=\"tab-pane fade\">
                                            <div class=\"row\" id='crop_cvr' style=\"overflow:auto;\">
                                                <img src=\"assets/images/users/";
        // line 264
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "user_cover", array()), "html", null, true);
        echo "\"
                                                     id=\"crop_target2\"/>";
        // line 266
        echo form_open_multipart("", " id=\"cover_crop_form\" name=\"cover_crop_form\"");
        echo "

                                                <div class=\"inline-labels\" style=\"display:none\">
                                                    <label>
                                                        X1
                                                        <input type=\"text\" size=\"4\" id=\"x11\" name=\"x11\"/>
                                                    </label>
                                                    <label>
                                                        Y1
                                                        <input type=\"text\" size=\"4\" id=\"y11\" name=\"y11\"/>
                                                    </label>
                                                    <label>
                                                        X2
                                                        <input type=\"text\" size=\"4\" id=\"x22\" name=\"x22\"/>
                                                    </label>
                                                    <label>
                                                        Y2
                                                        <input type=\"text\" size=\"4\" id=\"y22\" name=\"y22\"/>
                                                    </label>
                                                    <label>
                                                        W
                                                        <input type=\"text\" size=\"4\" id=\"w2\" name=\"w2\"/>
                                                    </label>
                                                    <label>
                                                        H
                                                        <input type=\"text\" size=\"4\" id=\"h2\" name=\"h2\"/>
                                                    </label>
                                                </div>
                                                <br>
                                                <div class=\"col-sm-4\">
                                                    <button type=\"submit\" class=\"btn btn-primary\" value=\"cover_crop\"
                                                            name=\"cover_crop\">";
        // line 298
        echo twig_escape_filter($this->env, lang("crop"), "html", null, true);
        echo " <i class=\"fa fa-arrow-circle-right\"></i>
                                                    </button>
                                                </div>";
        // line 302
        echo form_close();
        echo "
                                            </div>
                                        </div>


                                    </div>
                                </div>


                                <div class=\"modal-footer\">
                                    <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-default\">";
        // line 313
        echo twig_escape_filter($this->env, lang("close"), "html", null, true);
        echo "
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id=\"myModal2\" class=\"modal extended-modal fade no-display\" tabindex=\"-1\" data-width=\"760\">
                    <div class=\"modal-dialog\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                <h4 class=\"modal-title\">";
        // line 326
        echo twig_escape_filter($this->env, lang("change_pro_pic"), "html", null, true);
        echo "</h4>
                            </div>
                            <div class=\"modal-body\">

                                <div class=\"tabbable\">
                                    <ul class=\"nav nav-tabs\">
                                        <li class=\"active\">
                                            <a data-toggle=\"tab\" href=\"javascript:#dp_tab1\">";
        // line 334
        echo twig_escape_filter($this->env, lang("add_new"), "html", null, true);
        echo "
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle=\"tab\" href=\"javascript:#dp_tab2\">";
        // line 339
        echo twig_escape_filter($this->env, lang("photos_of_u"), "html", null, true);
        echo "
                                            </a>
                                        </li>

                                        <li>
                                            <a data-toggle=\"tab\" href=\"javascript:#dp_tab3\">";
        // line 345
        echo twig_escape_filter($this->env, lang("def_photos"), "html", null, true);
        echo "
                                            </a>
                                        </li>


                                        <li>
                                            <a data-toggle=\"tab\" href=\"#dp_tab4\">";
        // line 352
        echo twig_escape_filter($this->env, lang("crop"), "html", null, true);
        echo "
                                            </a>
                                        </li>

                                    </ul>
                                    <div class=\"tab-content\">
                                        <div id=\"dp_tab1\" class=\"tab-pane fade in active\">";
        // line 359
        echo form_open_multipart("", " id=\"dp_form\" name=\"dp_form\"");
        echo "
                                            <div class=\"form-horizontal\">
                                                <div class=\"errorHandler alert alert-danger no-display\">
                                                    <i class=\"fa fa-remove-sign\"></i>";
        // line 362
        echo twig_escape_filter($this->env, lang("form_error_msg"), "html", null, true);
        echo "
                                                </div>
                                                <div class=\"form-group\">
                                                    <label class=\"col-sm-3 control-label\">";
        // line 366
        echo twig_escape_filter($this->env, lang("select_image"), "html", null, true);
        echo "
                                                    </label>
                                                    <div class=\"fileupload fileupload-new col-sm-6\"
                                                         data-provides=\"fileupload\">
                                                        <div class=\"fileupload-new thumbnail\"><img
                                                                src=\"assets/images/users/";
        // line 371
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "user_dp", array()), "html", null, true);
        echo "\"
                                                                alt=\"\">
                                                        </div>
                                                        <div class=\"fileupload-preview fileupload-exists thumbnail\"></div>
                                                        <div class=\"user-edit-image-buttons\">
                                                            <span class=\"btn btn-azure btn-file\">
                                                                <span class=\"fileupload-new\"><i
                                                                        class=\"fa fa-picture\"></i>";
        // line 378
        echo twig_escape_filter($this->env, lang("select_image"), "html", null, true);
        echo "</span>
                                                                <span class=\"fileupload-exists\"><i
                                                                        class=\"fa fa-picture\"></i>";
        // line 380
        echo twig_escape_filter($this->env, lang("change"), "html", null, true);
        echo "</span>
                                                                <input type=\"file\" id=\"prof_pic\" name=\"prof_pic\" accept=\"image/*\"/>
                                                            </span>
                                                            <a href=\"#\" class=\"btn fileupload-exists btn-red\"
                                                               data-dismiss=\"fileupload\">
                                                                <i class=\"fa fa-times\"></i>";
        // line 385
        echo twig_escape_filter($this->env, lang("remove"), "html", null, true);
        echo "
                                                            </a>
                                                        </div>
                                                        <div class=\"alert alert-warning\">
                                                            <span class=\"label label-warning\">";
        // line 389
        echo twig_escape_filter($this->env, lang("note"), "html", null, true);
        echo "!</span>
                                                            <span>";
        // line 390
        echo twig_escape_filter($this->env, lang("supported_formats"), "html", null, true);
        echo " :";
        echo twig_escape_filter($this->env, lang("JPEG"), "html", null, true);
        echo " ,";
        echo twig_escape_filter($this->env, lang("PNG"), "html", null, true);
        echo " ,";
        echo twig_escape_filter($this->env, lang("JPG"), "html", null, true);
        echo " </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class=\"form-group\">
                                                    <label class=\"col-sm-3 control-label\">

                                                    </label>
                                                    <div class=\"col-sm-4\">
                                                        <button type=\"submit\" class=\"btn btn-primary\" value=\"dp_update\"
                                                                name=\"dp_update\">";
        // line 402
        echo twig_escape_filter($this->env, lang("update"), "html", null, true);
        echo " <i
                                                                class=\"fa fa-arrow-circle-right\"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>";
        // line 408
        echo form_close();
        echo "
                                        </div>
                                        <div id=\"dp_tab2\" class=\"tab-pane fade\">

                                            <div class=\"row\">";
        // line 413
        if (twig_length_filter($this->env, ($context["user_dps"] ?? null))) {
            // line 414
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["user_dps"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["udp"]) {
                // line 415
                echo "                                                        <div class=\"col-sm-3\">
                                                            <img style=\"height:100px;width:auto;max-width:100px;\"
                                                                 src=\"assets/images/users/";
                // line 417
                echo twig_escape_filter($this->env, $this->getAttribute($context["udp"], "file", array()), "html", null, true);
                echo "\"
                                                                 class=\"img-responsive\">
                                                            <br>
                                                            <button type=\"button\" class=\"btn btn-blue btn-xs\"
                                                                    onclick=\"setCover(";
                // line 421
                echo twig_escape_filter($this->env, $this->getAttribute($context["udp"], "id", array()), "html", null, true);
                echo ");\">";
                // line 422
                echo twig_escape_filter($this->env, lang("set_this_pic"), "html", null, true);
                echo "
                                                            </button>
                                                            <p>
                                                        </div>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['udp'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 428
            echo "                                                    <h4 align=\"center\">";
            echo twig_escape_filter($this->env, lang("no_image_available"), "html", null, true);
            echo "</h4>";
        }
        // line 430
        echo "                                            </div>
                                        </div>


                                        <div id=\"dp_tab3\" class=\"tab-pane fade\">
                                            <div class=\"row\">";
        // line 436
        if (twig_length_filter($this->env, ($context["def_dp"] ?? null))) {
            // line 437
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["def_dp"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["dd"]) {
                // line 438
                echo "                                                        <div class=\"col-sm-3\">
                                                            <img style=\"height:100px;width:auto;max-width:100px;\"
                                                                 src=\"assets/images/users/";
                // line 440
                echo twig_escape_filter($this->env, $context["dd"], "html", null, true);
                echo "\"
                                                                 class=\"img-responsive\">
                                                            <br>
                                                            <button type=\"button\" class=\"btn btn-blue btn-xs\"
                                                                    onclick=\"setDefualtDp('";
                // line 444
                echo twig_escape_filter($this->env, $context["dd"], "html", null, true);
                echo "');\">";
                // line 445
                echo twig_escape_filter($this->env, lang("set_this_pic"), "html", null, true);
                echo "
                                                            </button>
                                                            <p>
                                                        </div>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dd'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 451
            echo "                                                    <h4 align=\"center\">";
            echo twig_escape_filter($this->env, lang("no_image_available"), "html", null, true);
            echo "</h4>";
        }
        // line 453
        echo "                                            </div>
                                        </div>


                                        <div id=\"dp_tab4\" class=\"tab-pane fade\">
                                            <div class=\"row\" id='crop_dp'>
                                                <img src=\"assets/images/users/";
        // line 459
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "user_dp", array()), "html", null, true);
        echo "\"
                                                     id=\"crop_target\"/>";
        // line 461
        echo form_open_multipart("", " id=\"dp_crop_form\" name=\"dp_crop_form\"");
        echo "

                                                <div class=\"inline-labels\" style=\"display:none\">
                                                    <label>
                                                        X1
                                                        <input type=\"text\" size=\"4\" id=\"x1\" name=\"x1\"/>
                                                    </label>
                                                    <label>
                                                        Y1
                                                        <input type=\"text\" size=\"4\" id=\"y1\" name=\"y1\"/>
                                                    </label>
                                                    <label>
                                                        X2
                                                        <input type=\"text\" size=\"4\" id=\"x2\" name=\"x2\"/>
                                                    </label>
                                                    <label>
                                                        Y2
                                                        <input type=\"text\" size=\"4\" id=\"y2\" name=\"y2\"/>
                                                    </label>
                                                    <label>
                                                        W
                                                        <input type=\"text\" size=\"4\" id=\"w\" name=\"w\"/>
                                                    </label>
                                                    <label>
                                                        H
                                                        <input type=\"text\" size=\"4\" id=\"h\" name=\"h\"/>
                                                    </label>
                                                </div>
                                                <br>
                                                <div class=\"col-sm-4\">
                                                    <button type=\"submit\" class=\"btn btn-primary\" value=\"dp_crop\"
                                                            name=\"dp_crop\">";
        // line 493
        echo twig_escape_filter($this->env, lang("crop"), "html", null, true);
        echo " <i class=\"fa fa-arrow-circle-right\"></i>
                                                    </button>
                                                </div>";
        // line 497
        echo form_close();
        echo "
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class=\"modal-footer\">
                                <button type=\"button\" data-dismiss=\"modal\" class=\"btn btn-default\">";
        // line 506
        echo twig_escape_filter($this->env, lang("close"), "html", null, true);
        echo "
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class=\"row\">
                    <div class=\"col-sm-5 col-md-4\">
                        <div class=\"user-left\">

                            <table class=\"table table-condensed table-hover\">
                                <thead>
                                    <tr>
                                        <th colspan=\"3\">";
        // line 520
        echo twig_escape_filter($this->env, lang("contact_info"), "html", null, true);
        echo "</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>";
        // line 525
        echo twig_escape_filter($this->env, lang("email"), "html", null, true);
        echo ":</td>
                                        <td>";
        // line 526
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "email", array()), "html", null, true);
        echo "</td>
                                    </tr>
                                    <tr>
                                        <td>";
        // line 529
        echo twig_escape_filter($this->env, lang("phone_number"), "html", null, true);
        echo ":</td>
                                        <td>";
        // line 530
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "phone_number", array()), "html", null, true);
        echo "</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class=\"table table-condensed table-hover\">
                                <thead>
                                    <tr>
                                        <th colspan=\"3\">";
        // line 537
        echo twig_escape_filter($this->env, lang("general_info"), "html", null, true);
        echo "</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>";
        // line 542
        echo twig_escape_filter($this->env, lang("joining_date"), "html", null, true);
        echo "</td>
                                        <td>";
        // line 543
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "date", array()), "html", null, true);
        echo "</td>
                                    </tr>";
        // line 546
        if ($this->getAttribute(($context["user_details"] ?? null), "sponsor_name", array())) {
            // line 547
            echo "                                        <tr>
                                            <td>";
            // line 548
            echo twig_escape_filter($this->env, lang("sponser_name"), "html", null, true);
            echo "</td>
                                            <td>";
            // line 549
            echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "sponsor_name", array()), "html", null, true);
            echo "</td>
                                        </tr>";
        }
        // line 552
        if ($this->getAttribute(($context["user_details"] ?? null), "rank_name", array())) {
            // line 553
            echo "                                        <tr>
                                            <td>";
            // line 554
            echo twig_escape_filter($this->env, lang("rank"), "html", null, true);
            echo "</td>
                                            <td>";
            // line 555
            echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "rank_name", array()), "html", null, true);
            echo "</td>
                                        </tr>";
        }
        // line 559
        if (($context["replica_status"] ?? null)) {
            // line 560
            echo form_open("", "id=\"replica_form\" name=\"pro_form\"");
            echo "
                                        <tr>
                                            <td>";
            // line 562
            echo twig_escape_filter($this->env, lang("replica_link"), "html", null, true);
            echo "</td>
                                            <td>
                                                <a class=\"btn btn-green btn-xs\" href=\"";
            // line 564
            echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "replica_link", array()), "html", null, true);
            echo "\" target=\"_BLANK\">";
            // line 565
            echo twig_escape_filter($this->env, lang("view"), "html", null, true);
            echo "
                                                </a>
                                                <button type=\"button\" class=\"btn btn-light-beige btn-xs\" onclick=\"copyToClipboard('replica_link1', 'replica_link2')\">";
            // line 568
            echo twig_escape_filter($this->env, lang("copy"), "html", null, true);
            echo "
                                                </button>
                                                <div style=\"position: absolute;left: -999em;\">
                                                    <span id=\"replica_link1\">";
            // line 571
            echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "replica_link", array()), "html", null, true);
            echo "</span>

                                                    <input type=\"text\" id=\"replica_link2\" value=\"";
            // line 573
            echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "replica_link", array()), "html", null, true);
            echo "\" />
                                                </div>
                                            </td>
                                        </tr>";
            // line 577
            echo form_close();
        }
        // line 579
        if (($context["lcp_status"] ?? null)) {
            // line 580
            echo form_open("", "id=\"replica_form\" name=\"pro_form\"");
            echo "
                                        <tr>
                                            <td>";
            // line 582
            echo twig_escape_filter($this->env, lang("lcp_link"), "html", null, true);
            echo "</td>
                                            <td>
                                                <a class=\"btn btn-light-purple btn-xs\" href=\"";
            // line 584
            echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "lcp_link", array()), "html", null, true);
            echo "\" target=\"_BLANK\">";
            // line 585
            echo twig_escape_filter($this->env, lang("view"), "html", null, true);
            echo "
                                                </a>
                                                <button type=\"button\" class=\"btn btn-light-yellow btn-xs\" onclick=\"copyToClipboard('lcp_link1', 'lcp_link2')\">";
            // line 588
            echo twig_escape_filter($this->env, lang("copy"), "html", null, true);
            echo "
                                                </button>
                                                <div style=\"position: absolute;left: -999em;\">
                                                    <span id=\"lcp_link1\">";
            // line 591
            echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "lcp_link", array()), "html", null, true);
            echo "</span>

                                                    <input type=\"text\" id=\"lcp_link2\" value=\"";
            // line 593
            echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "lcp_link", array()), "html", null, true);
            echo "\" />
                                                </div>
                                            </td>
                                        </tr>";
            // line 597
            echo form_close();
        }
        // line 599
        echo "                                    <tr>";
        // line 600
        echo form_open("", "id=\"replica_form\" name=\"pro_form\"");
        echo "
                                        <td>";
        // line 601
        echo twig_escape_filter($this->env, lang("ref_link"), "html", null, true);
        echo "</td>
                                        <td>
                                            <a class=\"btn btn-light-red btn-xs\" href=\"";
        // line 603
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "ref_link", array()), "html", null, true);
        echo "\" target=\"_BLANK\">";
        // line 604
        echo twig_escape_filter($this->env, lang("view"), "html", null, true);
        echo "
                                            </a>
                                            <button type=\"button\" class=\"btn btn-grey btn-xs\" onclick=\"copyToClipboard('ref_link1', 'ref_link2')\">";
        // line 607
        echo twig_escape_filter($this->env, lang("copy"), "html", null, true);
        echo "
                                            </button>
                                            <div style=\"position: absolute;left: -999em;\">
                                                <span id=\"ref_link1\">";
        // line 610
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "ref_link", array()), "html", null, true);
        echo "</span>

                                                <input type=\"text\" id=\"ref_link2\" value=\"";
        // line 612
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "ref_link", array()), "html", null, true);
        echo "\" />
                                            </div>
                                        </td>";
        // line 615
        echo form_close();
        echo "
                                    </tr>


                                </tbody>
                            </table>

                            <div class=\"table-responsive\">
                                <table class=\"table table-condensed table-hover\">
                                    <thead>
                                        <tr>
                                            <th colspan=\"3\">";
        // line 626
        echo twig_escape_filter($this->env, lang("social_profile"), "html", null, true);
        echo "</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href=\"";
        // line 632
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "facebook", array()), "html", null, true);
        echo "\" target=\"_BLANK\">
                                                    <i class=\"fa fa-facebook tooltips\" data-placement=\"top\" title=";
        // line 633
        echo twig_escape_filter($this->env, lang("facebook"), "html", null, true);
        echo "></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href=\"#\" id=\"facebook_xeditable\" data-type=\"url\" data-name=\"facebook\"
                                                   data-url=\"admin/profile/change_social_profile/post\"
                                                   data-original-title=\"";
        // line 639
        echo twig_escape_filter($this->env, lang("edit_facebook"), "html", null, true);
        echo "\" class=\"editable_fb\">";
        // line 640
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "facebook", array()), "html", null, true);
        echo "
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href=\"";
        // line 646
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "twiter", array()), "html", null, true);
        echo "\" target=\"_BLANK\">
                                                    <i class=\"fa fa-twitter tooltips\" data-placement=\"top\" title=";
        // line 647
        echo twig_escape_filter($this->env, lang("twiter"), "html", null, true);
        echo "></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href=\"#\" id=\"facebook_xeditable\" data-type=\"url\" data-name=\"twiter\"
                                                   data-url=\"admin/profile/change_social_profile/post\"
                                                   data-original-title=\"";
        // line 653
        echo twig_escape_filter($this->env, lang("edit_twiter"), "html", null, true);
        echo "\" class=\"editable_fb\">";
        // line 654
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "twiter", array()), "html", null, true);
        echo "
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href=\"";
        // line 660
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "gplus", array()), "html", null, true);
        echo "\" target=\"_BLANK\"><i class=\"fa fa-google-plus tooltips\" data-placement=\"top\" title=";
        echo twig_escape_filter($this->env, lang("gplus"), "html", null, true);
        echo "></i></a></td>
                                            <td>
                                                <a href=\"#\" id=\"facebook_xeditable\" data-type=\"url\" data-name=\"gplus\"
                                                   data-url=\"admin/profile/change_social_profile/post\"
                                                   data-original-title=\"";
        // line 664
        echo twig_escape_filter($this->env, lang("edit_gplus"), "html", null, true);
        echo "\" class=\"editable_fb\">";
        // line 665
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "gplus", array()), "html", null, true);
        echo "
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href=\"";
        // line 671
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "instagram", array()), "html", null, true);
        echo "\" target=\"_BLANK\">
                                                    <i class=\"fa fa-instagram tooltips\" data-placement=\"top\" title=";
        // line 672
        echo twig_escape_filter($this->env, lang("instagram"), "html", null, true);
        echo "></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href=\"#\" id=\"facebook_xeditable\" data-type=\"url\" data-name=\"instagram\"
                                                   data-url=\"admin/profile/change_social_profile/post\"
                                                   data-original-title=\"";
        // line 678
        echo twig_escape_filter($this->env, lang("edit_instagram"), "html", null, true);
        echo "\" class=\"editable_fb\">";
        // line 679
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "instagram", array()), "html", null, true);
        echo "
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <span id=\"referal_url\" style=\"visibility:hidden\">";
        // line 686
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "ref_link", array()), "html", null, true);
        echo "</span>
                            <span id=\"lcp_link\" style=\"visibility:hidden\">";
        // line 687
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "lcp_link", array()), "html", null, true);
        echo "</span>
                            <span id=\"replica_link\" style=\"visibility:hidden\">";
        // line 688
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "replica_link", array()), "html", null, true);
        echo "</span>
                        </div>
                    </div>
                    <div class=\"col-sm-7 col-md-8\">

                        <div class=\"center\">
                            <b>";
        // line 694
        echo twig_escape_filter($this->env, lang("edit_ur_profile"), "html", null, true);
        echo "</b>
                            <hr>
                        </div>";
        // line 698
        echo form_open("", "id=\"profile_update_form\" name=\"profile_update_form\"");
        echo "


                        <div class=\"col-md-12\">
                            <div class=\"errorHandler alert alert-danger no-display\">
                                <i class=\"fa fa-times-sign\"></i>";
        // line 703
        echo twig_escape_filter($this->env, lang("form_error_msg"), "html", null, true);
        echo "
                            </div>
                        </div>

                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <label class=\"control-label\">";
        // line 710
        echo twig_escape_filter($this->env, lang("first_name"), "html", null, true);
        echo " : <span class=\"symbol required\"></span>
                                </label>
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\"> <i class=\"fa fa-buysellads\"></i> </span>
                                    <input type=\"text\" value=\"";
        // line 714
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "first_name", array()), "html", null, true);
        echo "\" placeholder=\"";
        echo twig_escape_filter($this->env, lang("first_name"), "html", null, true);
        echo "\" class=\"form-control\" id=\"first_name\" name=\"first_name\" maxlength=\"15\" tabindex='1' style=\"text-transform: capitalize;\">
                                </div>";
        // line 717
        if ($this->getAttribute(($context["profile_error"] ?? null), "first_name", array(), "any", true, true)) {
            // line 718
            echo "                                    <code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["profile_error"] ?? null), "first_name", array()), "html", null, true);
            echo " </code>";
        }
        // line 720
        echo "                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label\">";
        // line 723
        echo twig_escape_filter($this->env, lang("last_name"), "html", null, true);
        echo "
                                </label>
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\"> <i class=\"fa fa-medium\"></i> </span>
                                    <input type=\"text\" value=\"";
        // line 727
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "last_name", array()), "html", null, true);
        echo "\"
                                           placeholder=\"";
        // line 728
        echo twig_escape_filter($this->env, lang("last_name"), "html", null, true);
        echo "\" class=\"form-control\" id=\"last_name\" name=\"last_name\" maxlength=\"15\" tabindex='2' style=\"text-transform: capitalize;\">
                                </div>";
        // line 730
        if ($this->getAttribute(($context["profile_error"] ?? null), "last_name", array(), "any", true, true)) {
            // line 731
            echo "                                    <code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["profile_error"] ?? null), "last_name", array()), "html", null, true);
            echo " </code>";
        }
        // line 733
        echo "                            </div>

                            <div class=\"form-group\">
                                <label class=\"control-label\">";
        // line 737
        echo twig_escape_filter($this->env, lang("phone_number"), "html", null, true);
        echo " : <span class=\"symbol required\"></span>
                                </label>
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\"> <i class=\"fa fa-phone\"></i> </span>

                                    <input type=\"text\" value=\"";
        // line 742
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "phone_number", array()), "html", null, true);
        echo "\"
                                           placeholder=\"";
        // line 743
        echo twig_escape_filter($this->env, lang("phone_number"), "html", null, true);
        echo "\" class=\"form-control\" id=\"phone_number\" name=\"phone_number\" maxlength=\"12\" tabindex='3'>
                                </div>";
        // line 745
        if ($this->getAttribute(($context["profile_error"] ?? null), "phone_number", array(), "any", true, true)) {
            // line 746
            echo "                                    <code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["profile_error"] ?? null), "phone_number", array()), "html", null, true);
            echo " </code>";
        }
        // line 748
        echo "                            </div>

                            <div class=\"form-group\">
                                <label class=\"control-label\">";
        // line 752
        echo twig_escape_filter($this->env, lang("dob"), "html", null, true);
        echo " (dd/mm/yyyy) : <span class=\"symbol required\"></span>
                                </label>
                                <div class=\"input-group\">
                                    <input type=\"text\" value=\"";
        // line 755
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "date_of_birth", array()), "html", null, true);
        echo "\" id=\"dob\" name=\"dob\"
                                           class=\"form-control input-mask-date\" tabindex='4'>
                                    <span class=\"input-group-btn\">
                                        <button type=\"button\" class=\"btn btn-green\">
                                            <i class=\"fa fa-calendar\"></i>
                                        </button> </span>
                                </div>";
        // line 762
        if ($this->getAttribute(($context["profile_error"] ?? null), "dob", array(), "any", true, true)) {
            // line 763
            echo "                                    <code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["profile_error"] ?? null), "dob", array()), "html", null, true);
            echo " </code>";
        }
        // line 765
        echo "                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label\">";
        // line 768
        echo twig_escape_filter($this->env, lang("gender"), "html", null, true);
        echo " : <span class=\"symbol required\"></span>
                                </label>
                                <div>
                                    <label class=\"radio-inline\">
                                        <input type=\"radio\" class=\"grey\"
                                               value=\"f\"";
        // line 773
        if (($this->getAttribute(($context["user_details"] ?? null), "gender", array()) == "f")) {
            echo " checked";
        }
        // line 774
        echo "                                               name=\"gender\" id=\"gender\" tabindex='5'>
                                        <i class=\"fa fa-female\"></i>";
        // line 775
        echo twig_escape_filter($this->env, lang("female"), "html", null, true);
        echo "
                                    </label>
                                    <label class=\"radio-inline\">
                                        <input type=\"radio\" class=\"grey\"
                                               value=\"m\"";
        // line 779
        if (($this->getAttribute(($context["user_details"] ?? null), "gender", array()) == "m")) {
            echo " checked";
        }
        // line 780
        echo "                                               name=\"gender\" id=\"gender\">
                                        <i class=\"fa fa-male\"></i>";
        // line 781
        echo twig_escape_filter($this->env, lang("male"), "html", null, true);
        echo "
                                    </label>
                                </div>";
        // line 784
        if ($this->getAttribute(($context["profile_error"] ?? null), "gender", array(), "any", true, true)) {
            // line 785
            echo "                                    <code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["profile_error"] ?? null), "gender", array()), "html", null, true);
            echo " </code>";
        }
        // line 787
        echo "                            </div>
                        </div>
                        <div class=\"col-md-6\">
                            <div class=\"form-group\">
                                <label class=\"control-label\">";
        // line 792
        echo twig_escape_filter($this->env, lang("address"), "html", null, true);
        echo " : <span class=\"symbol required\"></span>
                                </label>
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\"> <i class=\"fa fa-map-marker\"></i> </span>

                                    <input type=\"text\" value=\"";
        // line 797
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "address_1", array()), "html", null, true);
        echo "\" placeholder=\"";
        echo twig_escape_filter($this->env, lang("address"), "html", null, true);
        echo "\" class=\"form-control\" id=\"address\" name=\"address\" tabindex='6' style=\"text-transform: capitalize;\">
                                </div>";
        // line 799
        if ($this->getAttribute(($context["profile_error"] ?? null), "address", array(), "any", true, true)) {
            // line 800
            echo "                                    <code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["profile_error"] ?? null), "address", array()), "html", null, true);
            echo " </code>";
        }
        // line 802
        echo "                            </div>

                            <div class=\"form-group\">
                                <label class=\"control-label\">";
        // line 806
        echo twig_escape_filter($this->env, lang("country"), "html", null, true);
        echo " : <span class=\"symbol required\"></span>
                                </label>
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\"> <i class=\"fa fa-globe\"></i> </span>

                                    <select name=\"country\" id=\"country\" class=\"form-control search-select\" tabindex='7'>
                                        <option value=\"\">";
        // line 812
        echo twig_escape_filter($this->env, lang("select_a_country"), "html", null, true);
        echo "</option>";
        // line 813
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["countries"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["cntrs"]) {
            // line 814
            echo "                                            <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cntrs"], "id", array()), "html", null, true);
            echo "\"";
            if (($this->getAttribute(($context["user_details"] ?? null), "country", array()) == $this->getAttribute($context["cntrs"], "id", array()))) {
                echo " selected";
            }
            echo ">";
            echo $this->getAttribute($context["cntrs"], "name", array());
            echo "</option>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cntrs'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 816
        echo "

                                    </select>
                                </div>";
        // line 820
        if ($this->getAttribute(($context["profile_error"] ?? null), "country", array(), "any", true, true)) {
            // line 821
            echo "                                    <code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["profile_error"] ?? null), "country", array()), "html", null, true);
            echo " </code>";
        }
        // line 823
        echo "                            </div>

                            <div class=\"form-group\">
                                <label class=\"control-label\">";
        // line 827
        echo twig_escape_filter($this->env, lang("state"), "html", null, true);
        echo "
                                </label>
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\"> <i class=\"fa fa-flag\"></i> </span>
                                    <span class=\"input-icon\" id=\"state_span\">
                                        <select name=\"state\" id=\"state\" class=\"form-control search-select\" tabindex='8'>
                                            <option value=\"\">";
        // line 833
        echo twig_escape_filter($this->env, lang("select_a_state"), "html", null, true);
        echo "</option>";
        // line 834
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["states"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["sts"]) {
            // line 835
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["sts"], "id", array()), "html", null, true);
            echo "\"";
            if (($this->getAttribute(($context["user_details"] ?? null), "state", array()) == $this->getAttribute($context["sts"], "id", array()))) {
                echo " selected";
            }
            echo ">";
            echo $this->getAttribute($context["sts"], "name", array());
            echo "</option>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sts'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 837
        echo "                                        </select>
                                    </span>
                                </div>";
        // line 840
        if ($this->getAttribute(($context["profile_error"] ?? null), "state", array(), "any", true, true)) {
            // line 841
            echo "                                    <code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["profile_error"] ?? null), "state", array()), "html", null, true);
            echo " </code>";
        }
        // line 843
        echo "                            </div>

                            <div class=\"form-group\">
                                <label class=\"control-label\">";
        // line 847
        echo twig_escape_filter($this->env, lang("city"), "html", null, true);
        echo "
                                </label>
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\"> <i class=\"fa fa-location-arrow\"></i> </span>

                                    <input type=\"text\" value=\"";
        // line 852
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "city", array()), "html", null, true);
        echo "\" placeholder=\"";
        echo twig_escape_filter($this->env, lang("city"), "html", null, true);
        echo "\" class=\"form-control\" id=\"city\" name=\"city\" maxlength=\"20\" tabindex='9' style=\"text-transform: capitalize;\">
                                </div>";
        // line 854
        if ($this->getAttribute(($context["profile_error"] ?? null), "city", array(), "any", true, true)) {
            // line 855
            echo "                                    <code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["profile_error"] ?? null), "city", array()), "html", null, true);
            echo " </code>";
        }
        // line 857
        echo "                            </div>

                            <div class=\"form-group\">
                                <label class=\"control-label\">";
        // line 861
        echo twig_escape_filter($this->env, lang("zip_code"), "html", null, true);
        echo "
                                </label>
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\"> <i class=\"fa fa-eraser\"></i> </span>

                                    <input type=\"text\" value=\"";
        // line 866
        echo twig_escape_filter($this->env, $this->getAttribute(($context["user_details"] ?? null), "zipcode", array()), "html", null, true);
        echo "\" placeholder=\"";
        echo twig_escape_filter($this->env, lang("zip_code"), "html", null, true);
        echo "\" class=\"form-control\" id=\"zipcode\" name=\"zipcode\" maxlength=\"7\" tabindex='10'>
                                </div>";
        // line 868
        if ($this->getAttribute(($context["profile_error"] ?? null), "zipcode", array(), "any", true, true)) {
            // line 869
            echo "                                    <code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["profile_error"] ?? null), "zipcode", array()), "html", null, true);
            echo " </code>";
        }
        // line 871
        echo "                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-5 pull-right\">

                                <button type=\"submit\" class=\"btn btn-primary\" value=\"prof_update\" name=\"prof_update\">";
        // line 878
        echo twig_escape_filter($this->env, lang("update"), "html", null, true);
        echo " <i class=\"fa fa-arrow-circle-right\"></i>
                                </button>
                            </div>
                        </div>";
        // line 883
        echo form_close();
        echo "
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>";
        // line 890
        $this->loadTemplate("admin/layout/footer.twig", "admin/profile/index.twig", 890)->display($context);
        // line 891
        echo "<link rel=\"stylesheet\" href=\"assets/plugins/select2/select2.css\">
<link rel=\"stylesheet\" href=\"assets/css/plugins.css\">
<script src=\"assets/plugins/select2/select2.min.js\"></script>
<script src=\"assets/js/form-elements.js\"></script>

<link rel=\"stylesheet\" href=\"assets/plugins/datepicker/css/datepicker.css\">
<link rel=\"stylesheet\" href=\"assets/css/profile_update.css\">
<script src=\"assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js\"></script>
<script src=\"assets/js/lead_date_masker.js\"></script>
<script src=\"assets/js/profile_update.js\"></script>
<script src=\"assets/js/file_extension.js\"></script>
<script src=\"assets/js/typeahead.js\"></script>
<link href=\"assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css\" rel=\"stylesheet\" type=\"text/css\"/>
<link href=\"assets/plugins/bootstrap-modal/css/bootstrap-modal.css\" rel=\"stylesheet\" type=\"text/css\"/>
<link rel=\"stylesheet\" href=\"assets/plugins/x-editable/css/bootstrap-editable.css\">
<script src=\"assets/plugins/x-editable/js/bootstrap-editable.min.js\">
</script>


<script>
    \$(document).ready(function () {
        ValidateUserProfile.init();
        DmElements.init();
        FormElements.init2();
        \$('a[href=\"#dp_tab4\"]').click(function () {
            setTimeout(function () {
                initCrop(\$('#crop_dp img'), function (event) {
                    \$('#x1').val(event.detail.x);
                    \$('#y1').val(event.detail.y);
                    \$('#x2').val(event.detail.scaleX);
                    \$('#y2').val(event.detail.scaleY);
                    \$('#w').val(event.detail.width);
                    \$('#h').val(event.detail.height);
                });
            }, 500);
        });

        \$('a[href=\"#cover_tab4\"]').click(function () {
            setTimeout(function () {
                initCrop(\$('#crop_cvr img'), function (event) {
                    \$('#x11').val(event.detail.x);
                    \$('#y11').val(event.detail.y);
                    \$('#x22').val(event.detail.scaleX);
                    \$('#y22').val(event.detail.scaleY);
                    \$('#w2').val(event.detail.width);
                    \$('#h2').val(event.detail.height);
                });
            }, 500);
        });
    });

    function initCrop(\$image, cropCallback) {
        if (\$image.parent().find('.cropper-bg').length)
            return;

        \$image.cropper({
            viewMode: 2,
            crop: function (event) {
                if (cropCallback)
                    cropCallback(event);
            }
        });
        var cropper = \$image.data('cropper');
    }

    \$('input.typeahead').typeahead({
        source: function (query, process) {
            var url = \"admin/member/get_usernames\";
            return \$.get(url, {query: query}, function (data) {
                data = \$.parseJSON(data);
                return process(data);
            });
        }
    });


    \$('.editable_fb').editable({
        type: 'text',
        url: 'admin/profile/change_social_profile/post',
        pk: 1,
        title: 'Enter Menu Name',
        ajaxOptions: {
            dataType: 'json'
        },
        success: function (response, newValue) {
            var social_profile_failed = \$('#social_profile_failed_js').html();
            var social_profile_updated = \$('#social_profile_updated_js').html();
            var success_js = \$('#success_js').html();

            if (!response) {
                return social_profile_failed;
            }

            if (response.success === false) {
                return response.msg;
            } else {
                var msg = social_profile_updated;
                var flag = \"success\";
                var title = success_js;
                show_notification(flag, title, msg);
            }
        }
    });

    function copyToClipboard(elementId1, elementId2) {
        var isiOSDevice = navigator.userAgent.match(/ipad|iphone/i);

        if (isiOSDevice) {
            var input = document.getElementById(elementId2);

            var editable = input.contentEditable;
            var readOnly = input.readOnly;

            input.contentEditable = true;
            input.readOnly = false;

            var range = document.createRange();
            range.selectNodeContents(input);

            var selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);

            input.setSelectionRange(0, 999999);
            input.contentEditable = editable;
            input.readOnly = readOnly;
            document.execCommand('copy');
        } else {
            var input = document.getElementById(elementId1);
            var aux = document.createElement(\"input\");
            aux.setAttribute(\"value\", document.getElementById(elementId1).innerHTML);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand(\"copy\");
            document.body.removeChild(aux);
        }

        var msg = \$('#link_copied_js').html();
        var flag = \"success\";
        var title = \$('#success_js').html();

        show_notification(flag, title, msg);
    }
</script>
<style>
    div#crop_dp img, #crop_cvr img {
        max-width: 100%;
    }
</style>
";
    }

    public function getTemplateName()
    {
        return "admin/profile/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1526 => 891,  1524 => 890,  1515 => 883,  1509 => 878,  1501 => 871,  1496 => 869,  1494 => 868,  1488 => 866,  1480 => 861,  1475 => 857,  1470 => 855,  1468 => 854,  1462 => 852,  1454 => 847,  1449 => 843,  1444 => 841,  1442 => 840,  1438 => 837,  1424 => 835,  1420 => 834,  1417 => 833,  1408 => 827,  1403 => 823,  1398 => 821,  1396 => 820,  1391 => 816,  1377 => 814,  1373 => 813,  1370 => 812,  1361 => 806,  1356 => 802,  1351 => 800,  1349 => 799,  1343 => 797,  1335 => 792,  1329 => 787,  1324 => 785,  1322 => 784,  1317 => 781,  1314 => 780,  1310 => 779,  1303 => 775,  1300 => 774,  1296 => 773,  1288 => 768,  1284 => 765,  1279 => 763,  1277 => 762,  1268 => 755,  1262 => 752,  1257 => 748,  1252 => 746,  1250 => 745,  1246 => 743,  1242 => 742,  1234 => 737,  1229 => 733,  1224 => 731,  1222 => 730,  1218 => 728,  1214 => 727,  1207 => 723,  1203 => 720,  1198 => 718,  1196 => 717,  1190 => 714,  1183 => 710,  1174 => 703,  1166 => 698,  1161 => 694,  1152 => 688,  1148 => 687,  1144 => 686,  1134 => 679,  1131 => 678,  1122 => 672,  1118 => 671,  1109 => 665,  1106 => 664,  1097 => 660,  1088 => 654,  1085 => 653,  1076 => 647,  1072 => 646,  1063 => 640,  1060 => 639,  1051 => 633,  1047 => 632,  1038 => 626,  1024 => 615,  1019 => 612,  1014 => 610,  1008 => 607,  1003 => 604,  1000 => 603,  995 => 601,  991 => 600,  989 => 599,  986 => 597,  980 => 593,  975 => 591,  969 => 588,  964 => 585,  961 => 584,  956 => 582,  951 => 580,  949 => 579,  946 => 577,  940 => 573,  935 => 571,  929 => 568,  924 => 565,  921 => 564,  916 => 562,  911 => 560,  909 => 559,  904 => 555,  900 => 554,  897 => 553,  895 => 552,  890 => 549,  886 => 548,  883 => 547,  881 => 546,  877 => 543,  873 => 542,  865 => 537,  855 => 530,  851 => 529,  845 => 526,  841 => 525,  833 => 520,  816 => 506,  805 => 497,  800 => 493,  766 => 461,  762 => 459,  754 => 453,  749 => 451,  738 => 445,  735 => 444,  728 => 440,  724 => 438,  720 => 437,  718 => 436,  711 => 430,  706 => 428,  695 => 422,  692 => 421,  685 => 417,  681 => 415,  677 => 414,  675 => 413,  668 => 408,  660 => 402,  640 => 390,  636 => 389,  629 => 385,  621 => 380,  616 => 378,  606 => 371,  598 => 366,  592 => 362,  586 => 359,  577 => 352,  568 => 345,  560 => 339,  553 => 334,  543 => 326,  527 => 313,  514 => 302,  509 => 298,  475 => 266,  471 => 264,  463 => 258,  458 => 256,  447 => 248,  444 => 247,  437 => 243,  433 => 241,  429 => 240,  427 => 239,  419 => 232,  414 => 230,  403 => 224,  400 => 223,  393 => 219,  389 => 217,  385 => 216,  383 => 215,  376 => 210,  368 => 204,  349 => 193,  345 => 192,  338 => 188,  330 => 183,  325 => 181,  316 => 175,  308 => 170,  302 => 166,  296 => 163,  287 => 156,  279 => 150,  271 => 144,  264 => 139,  254 => 131,  241 => 123,  229 => 114,  218 => 106,  204 => 95,  199 => 91,  193 => 87,  184 => 80,  178 => 77,  171 => 72,  165 => 69,  159 => 65,  147 => 56,  144 => 55,  140 => 53,  124 => 40,  119 => 38,  114 => 36,  104 => 29,  95 => 23,  91 => 22,  87 => 21,  83 => 20,  79 => 19,  74 => 17,  70 => 16,  66 => 15,  62 => 14,  58 => 13,  54 => 12,  50 => 11,  46 => 10,  42 => 9,  38 => 8,  34 => 7,  30 => 6,  26 => 5,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/profile/index.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\profile\\index.twig");
    }
}

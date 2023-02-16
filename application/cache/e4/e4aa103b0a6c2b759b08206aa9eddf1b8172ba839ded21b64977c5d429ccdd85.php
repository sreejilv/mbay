<?php

/* admin/site_management/site_configuration.twig */
class __TwigTemplate_1f0e75d2991ab5017b71068a6b2d407c75d0a1730e730d661a94948b193ead1f extends Twig_Template
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
        $this->loadTemplate("admin/layout/header.twig", "admin/site_management/site_configuration.twig", 1)->display($context);
        // line 2
        echo "<div style=\"display:none\">
    <span id=\"js_error_message\">";
        // line 3
        echo twig_escape_filter($this->env, lang("js_error_message"), "html", null, true);
        echo "</span>
    <span id=\"user_logo_ext_js\">";
        // line 4
        echo twig_escape_filter($this->env, lang("user_logo_ext_js"), "html", null, true);
        echo "</span>  
    <span id=\"user_fav_ext_js\">";
        // line 5
        echo twig_escape_filter($this->env, lang("user_fav_ext_js"), "html", null, true);
        echo "</span>  
    <span id=\"company_name_req_js\">";
        // line 6
        echo twig_escape_filter($this->env, lang("company_name_req_js"), "html", null, true);
        echo "</span>  
    <span id=\"company_address_req_js\">";
        // line 7
        echo twig_escape_filter($this->env, lang("company_address_req_js"), "html", null, true);
        echo "</span>  
    <span id=\"min_length_address_js\">";
        // line 8
        echo twig_escape_filter($this->env, lang("min_length_address_js"), "html", null, true);
        echo "</span>  
    <span id=\"company_email_req_js\">";
        // line 9
        echo twig_escape_filter($this->env, lang("company_email_req_js"), "html", null, true);
        echo "</span>  
    <span id=\"min_length_js\">";
        // line 10
        echo twig_escape_filter($this->env, lang("min_length_js"), "html", null, true);
        echo "</span>    
    <span id=\"company_phone_req_js\">";
        // line 11
        echo twig_escape_filter($this->env, lang("company_phone_req_js"), "html", null, true);
        echo "</span>    
    <span id=\"min_phone_req_js\">";
        // line 12
        echo twig_escape_filter($this->env, lang("min_phone_req_js"), "html", null, true);
        echo "</span>     
</div>
<div class=\"row\">
    <div class=\"col-md-12\">
        <div class=\"panel panel-white\">
            <div class=\"panel-heading\">
                <h4 class=\"panel-title\"><span class=\"text-bold\">";
        // line 18
        echo twig_escape_filter($this->env, ($context["page_title"] ?? null), "html", null, true);
        echo " </span></h4>
                <div class=\"panel-tools\">
                    <div class=\"dropdown\">
                        <a data-toggle=\"dropdown\" class=\"btn btn-xs dropdown-toggle btn-transparent-grey\"><i class=\"fa fa-cog\"></i></a>
                        <ul class=\"dropdown-menu dropdown-light pull-right\" role=\"menu\">
                            <li><a class=\"panel-collapse collapses\" href=\"#\"><i class=\"fa fa-angle-up\"></i> <span>";
        // line 23
        echo twig_escape_filter($this->env, lang("collapse"), "html", null, true);
        echo "</span> </a></li>
                            <li><a class=\"panel-refresh\" href=\"#\"><i class=\"fa fa-refresh\"></i> <span>";
        // line 24
        echo twig_escape_filter($this->env, lang("refresh"), "html", null, true);
        echo "</span></a></li>
                            <li><a class=\"panel-expand\" href=\"#\"><i class=\"fa fa-expand\"></i> <span>";
        // line 25
        echo twig_escape_filter($this->env, lang("full_screen"), "html", null, true);
        echo "</span></a></li>
                        </ul>
                    </div>
                    <a class=\"btn btn-xs btn-link panel-close\" href=\"#\"><i class=\"fa fa-times\"></i></a>

                </div>
            </div>
            
            <div class=\"panel-body\">
                <hr>";
        // line 35
        echo form_open_multipart("", " method=\"post\" id=\"update_siteinfo_form\" name=\"update_siteinfo_form\"");
        echo "
                <div class=\"col-sm-12\">
                    <div class=\"tabbable\">
                        <ul id=\"myTab\" class=\"nav nav-tabs\">
                            <li class=\"active\">
                                <a href=\"javascript:#myTab_example1\" data-toggle=\"tab\">
                                    <i class=\"green fa fa-list\"></i>";
        // line 41
        echo twig_escape_filter($this->env, lang("general"), "html", null, true);
        echo "
                                </a>
                            </li>
                            <li>
                                <a href=\"javascript:#myTab_example2\" data-toggle=\"tab\">
                                    <i class=\"green fa fa-image\"></i>";
        // line 46
        echo twig_escape_filter($this->env, lang("image"), "html", null, true);
        echo "
                                </a>
                            </li>
                        </ul>
                        <div class=\"tab-content\">
                            <div class=\"tab-pane fade in active\" id=\"myTab_example1\">
                                <div class=\"form-horizontal\">
                                    <div class=\"form-group\">
                                        <label class=\"col-sm-3 control-label\">";
        // line 56
        echo twig_escape_filter($this->env, lang("company_name"), "html", null, true);
        echo ": <span class=\"symbol required\"></span>
                                        </label>
                                        <div class=\"input-group col-sm-4 \">
                                            <span class=\"input-group-addon\"> <i class=\"fa fa-user\"></i> </span>
                                            <input class=\"form-control\" type=\"text\" name=\"company_name\" id=\"company_name\" placeholder='";
        // line 60
        echo twig_escape_filter($this->env, lang("company_name"), "html", null, true);
        echo "' value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["site_info"] ?? null), "company_name", array(), "array"), "html", null, true);
        echo "\">
                                        </div>";
        // line 62
        if ($this->getAttribute(($context["error"] ?? null), "company_name", array())) {
            echo "<code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["error"] ?? null), "company_name", array()), "html", null, true);
            echo " </code>";
        }
        // line 63
        echo "                                    </div>";
        // line 75
        echo "                                    <div class=\"form-group\">
                                        <label class=\"col-sm-3 control-label\">";
        // line 78
        echo twig_escape_filter($this->env, lang("address"), "html", null, true);
        echo ": <span class=\"symbol required\"></span>
                                        </label>
                                        <div class=\"col-sm-8\">
                                            <textarea class=\"form-control ckeditor\" type=\"text\" rows=\"4\" cols=\"60\" name=\"company_address\" id=\"company_address\" placeholder='";
        // line 81
        echo twig_escape_filter($this->env, lang("address"), "html", null, true);
        echo "'>";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["site_info"] ?? null), "company_address", array(), "array"), "html", null, true);
        echo "</textarea>

                                        </div>";
        // line 84
        if ($this->getAttribute(($context["error"] ?? null), "company_address", array())) {
            echo "<code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["error"] ?? null), "company_address", array()), "html", null, true);
            echo " </code>";
        }
        // line 85
        echo "                                    </div>
                                    <div class=\"form-group\">
                                        <label class=\"col-sm-3 control-label\">";
        // line 89
        echo twig_escape_filter($this->env, lang("company_email"), "html", null, true);
        echo ": <span class=\"symbol required\"></span>
                                        </label>
                                        <div class=\"input-group col-sm-4 \">
                                            <span class=\"input-group-addon\"> <i class=\"fa fa-envelope\"></i> </span>
                                            <input class=\"form-control\" type=\"email\" name=\"company_email\" id=\"company_email\" placeholder='";
        // line 93
        echo twig_escape_filter($this->env, lang("company_email"), "html", null, true);
        echo "'value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["site_info"] ?? null), "company_email", array(), "array"), "html", null, true);
        echo "\">
                                        </div>";
        // line 95
        if ($this->getAttribute(($context["error"] ?? null), "company_email", array())) {
            echo "<code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["error"] ?? null), "company_email", array()), "html", null, true);
            echo " </code>";
        }
        // line 96
        echo "                                    </div>
                                    <div class=\"form-group\">
                                        <label class=\"col-sm-3 control-label\">";
        // line 100
        echo twig_escape_filter($this->env, lang("company_phone"), "html", null, true);
        echo ": <span class=\"symbol required\"></span>
                                        </label>
                                        <div class=\"input-group col-sm-4 \">
                                            <span class=\"input-group-addon\"> <i class=\"fa fa-phone\"></i> </span>
                                            <input class=\"form-control\" type=\"text\" name=\"company_phone\" id=\"company_phone\" placeholder='";
        // line 104
        echo twig_escape_filter($this->env, lang("company_phone"), "html", null, true);
        echo "' value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["site_info"] ?? null), "company_phone", array(), "array"), "html", null, true);
        echo "\">
                                        </div>";
        // line 106
        if ($this->getAttribute(($context["error"] ?? null), "company_phone", array())) {
            echo "<code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["error"] ?? null), "company_phone", array()), "html", null, true);
            echo " </code>";
        }
        // line 107
        echo "                                    </div>
                                    
                                     <div class=\"form-group\">
                                         
                                        <label class=\"col-sm-3 control-label\">";
        // line 112
        echo twig_escape_filter($this->env, lang("google_analytics"), "html", null, true);
        echo ": 
                                        </label>
                                        
                                        <div class=\"input-group col-sm-4 \">
                                            <span class=\"input-group-addon\"> <i class=\"fa fa-text-width\"></i> </span>
                                            <input class=\"form-control\" type=\"text\" name=\"google_analytics\" id=\"google_analytics\" placeholder='";
        // line 117
        echo twig_escape_filter($this->env, lang("google_analytics"), "html", null, true);
        echo "' value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["site_info"] ?? null), "google_analytics", array(), "array"), "html", null, true);
        echo "\">
                                         </div>";
        // line 119
        if ($this->getAttribute(($context["error"] ?? null), "google_analytics", array())) {
            echo "<code>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["error"] ?? null), "google_analytics", array()), "html", null, true);
            echo " </code>";
        }
        // line 120
        echo "                                         
                                    </div>
                                    <div class=\"form-group\">
                                         <div class=\"col-sm-3\">
                                         </div>
                                         <div class=\"col-sm-6 col-sm-offest-3\">
                                                <span class=\"label label-info\">";
        // line 126
        echo twig_escape_filter($this->env, lang("note"), "html", null, true);
        echo "</span>
                                              <span>";
        // line 127
        echo twig_escape_filter($this->env, lang("google_analytics_note"), "html", null, true);
        echo " </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"tab-pane fade\" id=\"myTab_example2\">
                                <div class=\"form-horizontal\">
                                    <div class=\"form-group\">
                                        <label class=\"col-sm-3 control-label\">";
        // line 137
        echo twig_escape_filter($this->env, lang("logo"), "html", null, true);
        echo "
                                        </label>
                                        <div class=\"fileupload fileupload-new col-sm-5\" data-provides=\"fileupload\">
                                            <div class=\"fileupload-new thumbnail\"><img src=\"";
        // line 140
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "assets/images/logos/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["site_info"] ?? null), "company_logo", array(), "array"), "html", null, true);
        echo "\" alt=\"\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["site_info"] ?? null), "company_logo", array(), "array"), "html", null, true);
        echo "\">
                                            </div>
                                            <div class=\"fileupload-preview fileupload-exists thumbnail\"></div>
                                            <div class=\"user-edit-image-buttons\">
                                                <span class=\"btn btn-azure btn-file\"><span class=\"fileupload-new\"><i class=\"fa fa-picture\"></i>";
        // line 144
        echo twig_escape_filter($this->env, lang("select_image"), "html", null, true);
        echo "</span><span class=\"fileupload-exists\"><i class=\"fa fa-picture\"></i>";
        echo twig_escape_filter($this->env, lang("change"), "html", null, true);
        echo "</span>
                                                    <input type=\"file\" name=\"company_logo\" id=\"company_logo\" value=\"";
        // line 145
        echo twig_escape_filter($this->env, $this->getAttribute(($context["site_info"] ?? null), "company_logo", array(), "array"), "html", null, true);
        echo "\" accept=\"image/*\">
                                                </span>
                                                <a href=\"#\" class=\"btn fileupload-exists btn-red\" data-dismiss=\"fileupload\">
                                                    <i class=\"fa fa-times\"></i>";
        // line 148
        echo twig_escape_filter($this->env, lang("remove"), "html", null, true);
        echo "
                                                </a>
                                            </div>
                                            <div class=\"alert alert-warning\">
                                                <span class=\"label label-warning\">";
        // line 152
        echo twig_escape_filter($this->env, lang("note"), "html", null, true);
        echo "!</span>
                                                <span>";
        // line 153
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
                                        <label class=\"col-sm-3 control-label\">";
        // line 159
        echo twig_escape_filter($this->env, lang("fav_icon"), "html", null, true);
        echo "
                                        </label>
                                        <div class=\"fileupload fileupload-new col-sm-5\" data-provides=\"fileupload\">
                                            <div class=\"fileupload-new thumbnail\"><img src=\"";
        // line 162
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "assets/images/logos/";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["site_info"] ?? null), "company_fav_icon", array(), "array"), "html", null, true);
        echo "\" alt=\"\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["site_info"] ?? null), "company_fav_icon", array(), "array"), "html", null, true);
        echo "\">
                                            </div>
                                            <div class=\"fileupload-preview fileupload-exists thumbnail\"></div>
                                            <div class=\"user-edit-image-buttons\">
                                                <span class=\"btn btn-azure btn-file\"><span class=\"fileupload-new\"><i class=\"fa fa-picture\"></i>";
        // line 166
        echo twig_escape_filter($this->env, lang("select_image"), "html", null, true);
        echo "</span><span class=\"fileupload-exists\"><i class=\"fa fa-picture\"></i>";
        echo twig_escape_filter($this->env, lang("change"), "html", null, true);
        echo "</span>
                                                    <input type=\"file\" name=\"company_fav_icon\" id=\"company_fav_icon\" value=\"";
        // line 167
        echo twig_escape_filter($this->env, $this->getAttribute(($context["site_info"] ?? null), "company_fav_icon", array(), "array"), "html", null, true);
        echo "\" accept=\"image/*\">
                                                </span>
                                                <a href=\"#\" class=\"btn fileupload-exists btn-red\" data-dismiss=\"fileupload\">
                                                    <i class=\"fa fa-times\"></i>";
        // line 170
        echo twig_escape_filter($this->env, lang("remove"), "html", null, true);
        echo "
                                                </a>
                                            </div>

                                            <div class=\"alert alert-warning\">
                                                <span class=\"label label-warning\">";
        // line 175
        echo twig_escape_filter($this->env, lang("note"), "html", null, true);
        echo "!</span>
                                                <span>";
        // line 176
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
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class=\"form-group\">
                    <label class=\"col-sm-3 control-label\">

                    </label>
                    <div class=\"col-sm-4\">";
        // line 192
        if (($context["PRESET_DEMO_STATUS"] ?? null)) {
            // line 193
            echo "                            <button type=\"button\" class=\"btn btn-primary\" onclick=\"show_notification('warning', \$('#operation_blocked').html(), \$('#operation_blocked_msg').html())\">";
            // line 194
            echo twig_escape_filter($this->env, lang("update"), "html", null, true);
            echo " <i class=\"fa fa-arrow-circle-right\"></i>
                            </button>";
        } else {
            // line 196
            echo "                        
                            <button type=\"submit\"class=\"btn btn-primary\" value=\"update\" name=\"update_site_info\" id=\"update_site_info\">";
            // line 198
            echo twig_escape_filter($this->env, lang("update"), "html", null, true);
            echo " <i class=\"fa fa-arrow-circle-right\"></i>
                            </button>";
        }
        // line 201
        echo "                    </div>
                </div>";
        // line 203
        echo form_close();
        echo "
            </div>
        </div>                                    
    </div>
</div>";
        // line 208
        $this->loadTemplate("admin/layout/footer.twig", "admin/site_management/site_configuration.twig", 208)->display($context);
        // line 209
        echo "<script src=\"assets/plugins/ckeditor/ckeditor.js\"></script>
<script src=\"assets/js/file_extension.js\"></script>
<script src=\"assets/js/site_management.js\">
</script>
<script type=\"text/javascript\">
    jQuery(document).ready(function () {
        validateSiteSettings();
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "admin/site_management/site_configuration.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  411 => 209,  409 => 208,  402 => 203,  399 => 201,  394 => 198,  391 => 196,  386 => 194,  384 => 193,  382 => 192,  359 => 176,  355 => 175,  347 => 170,  341 => 167,  335 => 166,  324 => 162,  318 => 159,  304 => 153,  300 => 152,  293 => 148,  287 => 145,  281 => 144,  270 => 140,  264 => 137,  252 => 127,  248 => 126,  240 => 120,  234 => 119,  228 => 117,  220 => 112,  214 => 107,  208 => 106,  202 => 104,  195 => 100,  191 => 96,  185 => 95,  179 => 93,  172 => 89,  168 => 85,  162 => 84,  155 => 81,  149 => 78,  146 => 75,  144 => 63,  138 => 62,  132 => 60,  125 => 56,  114 => 46,  106 => 41,  97 => 35,  85 => 25,  81 => 24,  77 => 23,  69 => 18,  60 => 12,  56 => 11,  52 => 10,  48 => 9,  44 => 8,  40 => 7,  36 => 6,  32 => 5,  28 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/site_management/site_configuration.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\site_management\\site_configuration.twig");
    }
}

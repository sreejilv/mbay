<?php

/* admin/layout/main_container.twig */
class __TwigTemplate_ef018440e421ff3fcb5f497d89d03f38607e09a24133e040d138ef0191e02fd8 extends Twig_Template
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
        echo "           
<!-- start: MAIN CONTAINER -->
<div class=\"main-container inner\">
    <!-- start: PAGE -->
    <div class=\"main-content\">
        <!-- start: PANEL CONFIGURATION MODAL FORM -->
        <div class=\"modal fade\" id=\"panel-config\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
            <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">
                            &times;
                        </button>
                        <h4 class=\"modal-title\">";
        // line 15
        echo twig_escape_filter($this->env, lang("panel_configuration"), "html", null, true);
        echo "
                        </h4>
                    </div>
                    <div class=\"modal-body\">";
        // line 19
        echo twig_escape_filter($this->env, lang("here_will_be_a_config"), "html", null, true);
        echo "                                                                        
                    </div>
                    <div class=\"modal-footer\">
                        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">";
        // line 23
        echo twig_escape_filter($this->env, lang("close"), "html", null, true);
        echo "
                        </button>
                        <button type=\"button\" class=\"btn btn-primary\">";
        // line 26
        echo twig_escape_filter($this->env, lang("save_changes"), "html", null, true);
        echo "
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- end: SPANEL CONFIGURATION MODAL FORM -->
        <div class=\"container\">
            <!-- start: PAGE HEADER -->
            <!-- start: TOOLBAR -->
            <div class=\"toolbar row\">
                <div class=\"col-sm-4 hidden-xs\">
                    <div class=\"page-header\">
                        <h1>";
        // line 42
        if ( !twig_test_empty($this->getAttribute(($context["BREADCRUMBS"] ?? null), "page_title", array()))) {
            echo twig_escape_filter($this->env, lang(("menu_name_" . $this->getAttribute(($context["BREADCRUMBS"] ?? null), "page_title", array()))), "html", null, true);
        } else {
            echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        }
        echo "</h1>
                    </div>
                </div>
                <div class=\"col-sm-4 col-xs-4\">
                    <!-- start: LOGO -->
                    <a class=\"navbar-brand\" href=\"javascript:;\">
                        <img src=\"assets/images/logos/";
        // line 48
        echo twig_escape_filter($this->env, ($context["COMPANY_LOGO"] ?? null), "html", null, true);
        echo "\">
                    </a>
                    <!-- end: LOGO -->
                </div>
                <div class=\"col-sm-4 col-xs-8\">
                    <a href=\"javascript:void(0)\" class=\"back-subviews\">
                        <i class=\"fa fa-chevron-left\"></i>";
        // line 54
        echo twig_escape_filter($this->env, lang("back"), "html", null, true);
        echo "
                    </a>
                    <a href=\"javascript:void(0)\" class=\"close-subviews\">
                        <i class=\"fa fa-times\"></i>";
        // line 57
        echo twig_escape_filter($this->env, lang("close"), "html", null, true);
        echo "
                    </a>
                    <div class=\"toolbar-tools pull-right\">
                        <!-- start: TOP NAVIGATION MENU -->
                        <ul class=\"nav navbar-right\">
                            <!-- start: TO-DO DROPDOWN -->
                            <li class=\"dropdown\">
                                <a data-toggle=\"dropdown\" data-hover=\"dropdown\" class=\"dropdown-toggle\" data-close-others=\"true\" href=\"#\">
                                    <i class=\"fa fa-list\"><!-- fa-arrow-circle-down --></i>";
        // line 65
        echo twig_escape_filter($this->env, lang("quick_links"), "html", null, true);
        echo "
                                    <div class=\"tooltip-notification hide\">
                                        <!--  <div class=\"tooltip-notification-arrow\"></div>
                                         <div class=\"tooltip-notification-inner\">
                                             <div>
                                                 <div class=\"semi-bold\">";
        // line 71
        echo twig_escape_filter($this->env, lang("hi_there"), "html", null, true);
        echo "
                                    </div>
                                    <div class=\"message\">";
        // line 74
        echo twig_escape_filter($this->env, lang("more_options"), "html", null, true);
        echo "
                                    </div>
                                </div>
                            </div> -->
                                    </div>
                                </a>
                                <ul class=\"dropdown-menu dropdown-light dropdown-subview\">
                                    <li class=\"dropdown-header\">";
        // line 82
        echo twig_escape_filter($this->env, lang("news"), "html", null, true);
        echo "
                                    </li>
                                    <li>
                                        <a href=\"admin/news-add\" class=\"new-note\"><span class=\"fa-stack\"> <i class=\"fa fa-file-text-o fa-stack-1x fa-lg\"></i> <i class=\"fa fa-plus fa-stack-1x stack-right-bottom text-danger\"></i> </span>";
        // line 85
        echo twig_escape_filter($this->env, lang("add_new_news"), "html", null, true);
        echo "</a>
                                    </li>
                                    <li>
                                        <a href=\"admin/news-view\" class=\"read-all-notes\"><span class=\"fa-stack\"> <i class=\"fa fa-file-text-o fa-stack-1x fa-lg\"></i> <i class=\"fa fa-share fa-stack-1x stack-right-bottom text-danger\"></i> </span>";
        // line 88
        echo twig_escape_filter($this->env, lang("read_all_news"), "html", null, true);
        echo "</a>
                                    </li>
                                    <li class=\"dropdown-header\">";
        // line 91
        echo twig_escape_filter($this->env, lang("events"), "html", null, true);
        echo "
                                    </li>
                                    <li>
                                        <a href=\"admin/event-manage\" class=\"new-event\"><span class=\"fa-stack\"> <i class=\"fa fa-calendar-o fa-stack-1x fa-lg\"></i> <i class=\"fa fa-plus fa-stack-1x stack-right-bottom text-danger\"></i> </span>";
        // line 94
        echo twig_escape_filter($this->env, lang("add_new_events"), "html", null, true);
        echo "</a>
                                    </li>
                                    <li>
                                        <a href=\"admin/event-view\" class=\"show-calendar\"><span class=\"fa-stack\"> <i class=\"fa fa-calendar-o fa-stack-1x fa-lg\"></i> <i class=\"fa fa-share fa-stack-1x stack-right-bottom text-danger\"></i> </span>";
        // line 97
        echo twig_escape_filter($this->env, lang("view_all_events"), "html", null, true);
        echo "</a>
                                    </li>";
        // line 100
        if ((($context["LOG_USER_TYPE"] ?? null) != "employee")) {
            // line 101
            echo "                                        <li class=\"dropdown-header\">";
            // line 102
            echo twig_escape_filter($this->env, lang("users"), "html", null, true);
            echo "
                                        </li>
                                        <li>
                                            <a href=\"";
            // line 105
            echo twig_escape_filter($this->env, ($context["REG_MODE"] ?? null), "html", null, true);
            echo "\" class=\"new-contributor\"><span class=\"fa-stack\"> <i class=\"fa fa-user fa-stack-1x fa-lg\"></i> <i class=\"fa fa-plus fa-stack-1x stack-right-bottom text-danger\"></i> </span>";
            echo twig_escape_filter($this->env, lang("add_new_users"), "html", null, true);
            echo "</a>
                                        </li>
                                        <li>
                                            <a href=\"admin/join-report\" class=\"show-contributors\"><span class=\"fa-stack\"> <i class=\"fa fa-user fa-stack-1x fa-lg\"></i> <i class=\"fa fa-share fa-stack-1x stack-right-bottom text-danger\"></i> </span>";
            // line 108
            echo twig_escape_filter($this->env, lang("view_all_users"), "html", null, true);
            echo "</a>
                                        </li>";
        }
        // line 111
        echo "                                </ul>
                            </li>
                            <li class=\"dropdown\">
                                <a data-toggle=\"dropdown\" data-hover=\"dropdown\" class=\"dropdown-toggle\" data-close-others=\"true\" href=\"#\">
                                    <i class=\"fa fa-envelope\"></i><span class=\"messages-count badge badge-default\"></span>";
        // line 115
        echo twig_escape_filter($this->env, lang("messages"), "html", null, true);
        echo "
                                </a>
                                <ul class=\"dropdown-menu dropdown-light dropdown-messages\" id=\"message-container\">
                                    <div class=\"padding-10 text-alert\">";
        // line 118
        echo twig_escape_filter($this->env, lang("loading"), "html", null, true);
        echo " </div>
                                </ul>
                            </li>
                        </ul>
                        <!-- end: TOP NAVIGATION MENU -->
                    </div>
                </div>
            </div>
            <!-- end: TOOLBAR -->
            <!-- end: PAGE HEADER -->
            <!-- start: BREADCRUMB -->
            <div class=\"row\">
                <div class=\"col-md-9\">
                    <ol class=\"breadcrumb\">
                        <li>
                            <a href=\"";
        // line 133
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "\">";
        // line 134
        echo twig_escape_filter($this->env, lang("menu_name_1"), "html", null, true);
        echo "
                            </a>
                        </li>";
        // line 137
        if ($this->getAttribute(($context["BREADCRUMBS"] ?? null), "page_header", array())) {
            // line 138
            echo "                            <li class=\"active\">
                                <a href=\"";
            // line 139
            echo twig_escape_filter($this->env, $this->getAttribute(($context["BREADCRUMBS"] ?? null), "page_header_link", array()), "html", null, true);
            echo "\">";
            // line 140
            echo twig_escape_filter($this->env, lang(("menu_name_" . $this->getAttribute(($context["BREADCRUMBS"] ?? null), "page_header", array()))), "html", null, true);
            echo "
                                </a>
                            </li>";
            // line 144
            if ((($context["HELP_STATUS"] ?? null) && (($context["LOG_USER_TYPE"] ?? null) != "employee"))) {
                // line 145
                echo "                                /
                                <li>
                                    <a href=\"javascript:void(0)\"> <i class=\"help-button popovers\" title=\"\" data-content=\"";
                // line 147
                echo twig_escape_filter($this->env, lang(("menu_help_" . $this->getAttribute(($context["BREADCRUMBS"] ?? null), "page_header", array()))), "html", null, true);
                echo "\" data-placement=\"right\" data-trigger=\"hover\" data-rel=\"popover\" data-original-title=\"";
                echo twig_escape_filter($this->env, lang(("menu_name_" . $this->getAttribute(($context["BREADCRUMBS"] ?? null), "page_header", array()))), "html", null, true);
                echo "\"></i></a>
                                </li>";
            }
        }
        // line 151
        echo "
                    </ol>
                </div>
                <div class=\"col-md-3\">";
        // line 155
        if ((($context["PRESET_DEMO_STATUS"] ?? null) && ($context["demo_switcher"] ?? null))) {
            // line 156
            $this->loadTemplate("admin/layout/module_container.twig", "admin/layout/main_container.twig", 156)->display($context);
        }
        // line 158
        echo "                </div>
            </div>
            <!-- end: BREADCRUMB -->
            <!-- start: MAIN CONTENT -->




";
    }

    public function getTemplateName()
    {
        return "admin/layout/main_container.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  263 => 158,  260 => 156,  258 => 155,  253 => 151,  245 => 147,  241 => 145,  239 => 144,  234 => 140,  231 => 139,  228 => 138,  226 => 137,  221 => 134,  218 => 133,  200 => 118,  194 => 115,  188 => 111,  183 => 108,  175 => 105,  169 => 102,  167 => 101,  165 => 100,  161 => 97,  155 => 94,  149 => 91,  144 => 88,  138 => 85,  132 => 82,  122 => 74,  117 => 71,  109 => 65,  98 => 57,  92 => 54,  83 => 48,  70 => 42,  51 => 26,  46 => 23,  40 => 19,  34 => 15,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/layout/main_container.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\layout\\main_container.twig");
    }
}

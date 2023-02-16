<?php

/* admin/layout/menu.twig */
class __TwigTemplate_c3f0d2dfd2b8776f7faa43eaa90a4c660ca3fa3a9cf313a8b43f247e4ad33bb1 extends Twig_Template
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
<!-- start: PAGESLIDE LEFT -->
<a class=\"closedbar inner hidden-sm hidden-xs\" href=\"#\">
</a>
<nav id=\"pageslide-left\" class=\"pageslide inner\">
    <div class=\"navbar-content\">
        <!-- start: SIDEBAR -->
        <div class=\"main-navigation left-wrapper transition-left\">
            <span id=\"date\"></span>
            <div class=\"navigation-toggler hidden-sm hidden-xs\">
                <a href=\"#main-navbar\" class=\"sb-toggle-left\">

                </a>
            </div>

            <div class=\"user-profile border-top padding-horizontal-10 block\">
                <div class=\"inline-block\">
                    <img src=\"assets/images/users/";
        // line 18
        echo twig_escape_filter($this->env, ($context["LOG_USER_DP"] ?? null), "html", null, true);
        echo "\" width=\"50px;\" height=\"50px;\" alt=\"";
        echo twig_escape_filter($this->env, ($context["LOG_USER_NAME"] ?? null), "html", null, true);
        echo "\">
                </div>
                <div class=\"inline-block\">
                    <h5 class=\"no-margin\">";
        // line 21
        echo twig_escape_filter($this->env, lang("welcome"), "html", null, true);
        echo " &nbsp;<span id=\"time\"></span> </h5>
                    <h4 class=\"no-margin\">";
        // line 22
        echo twig_escape_filter($this->env, ($context["LOG_USER_NAME"] ?? null), "html", null, true);
        echo " &nbsp;<span id=\"datess\"></span></h4>
                    <!-- for top slider
                            <a class=\"btn user-options sb_toggle\">
                            <i class=\"fa fa-cog\"></i> 
                            </a>
                    -->
                </div>

            </div>
            <!-- start: MAIN NAVIGATION MENU -->
            <ul class=\"main-navigation-menu\">";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["USER_MENU"] ?? null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["MENU"]) {
            // line 35
            echo "
                    <li";
            // line 36
            if ((($this->getAttribute($context["MENU"], "selected", array()) == "selected") && ($this->getAttribute($context["MENU"], "id", array()) != "1"))) {
                if (($this->getAttribute($context["loop"], "index", array()) > 5)) {
                    echo " id=\"active_menu_id\"";
                }
                echo " class=\"active open\"";
            }
            echo " >
                        <a href=\"";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute($context["MENU"], "link", array()), "html", null, true);
            echo "\" target=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["MENU"], "target", array()), "html", null, true);
            echo "\"><i class=\"fa";
            echo twig_escape_filter($this->env, $this->getAttribute($context["MENU"], "icon", array()), "html", null, true);
            echo "\"  ></i> 
                            <span class=''>";
            // line 38
            echo twig_escape_filter($this->env, lang(("menu_name_" . $this->getAttribute($context["MENU"], "id", array()))), "html", null, true);
            echo "  </span><span id=\"menu_msg_count_";
            echo twig_escape_filter($this->env, $this->getAttribute($context["MENU"], "id", array()), "html", null, true);
            echo "\"></span>";
            // line 39
            if ( !(null === $this->getAttribute($context["MENU"], "sub_menu", array()))) {
                // line 40
                echo "                                <i class=\"icon-arrow\"></i>";
            }
            // line 41
            echo "  
                            <!-- <span class=\"label label-default pull-right \">LABEL</span> --> 
                        </a>";
            // line 44
            if ( !(null === $this->getAttribute($context["MENU"], "sub_menu", array()))) {
                // line 45
                echo "                            <ul class=\"sub-menu\">";
                // line 46
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["MENU"], "sub_menu", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["SUB_MENU"]) {
                    // line 47
                    echo "                                    <li";
                    if (($this->getAttribute($context["SUB_MENU"], "selected", array()) == "selected")) {
                        echo " class=\"active open\"";
                    }
                    echo ">
                                            <a href=\"";
                    // line 48
                    echo twig_escape_filter($this->env, $this->getAttribute($context["SUB_MENU"], "link", array()), "html", null, true);
                    echo "\"  target=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["SUB_MENU"], "target", array()), "html", null, true);
                    echo "\"><!--<i class=\"fa";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["SUB_MENU"], "icon", array()), "html", null, true);
                    echo "\"></i>-->
                                            <span class=\"\">";
                    // line 49
                    echo twig_escape_filter($this->env, lang(("menu_name_" . $this->getAttribute($context["SUB_MENU"], "id", array()))), "html", null, true);
                    echo "  </span>";
                    // line 50
                    if ( !(null === $this->getAttribute($context["SUB_MENU"], "sub_menu", array()))) {
                        // line 51
                        echo "                                                <i class=\"icon-arrow\"></i>";
                    }
                    // line 52
                    echo "  
                                        </a>";
                    // line 54
                    if ( !(null === $this->getAttribute($context["SUB_MENU"], "sub_menu", array()))) {
                        // line 55
                        echo "                                            <ul class=\"sub-menu\">";
                        // line 56
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["SUB_MENU"], "sub_menu", array()));
                        foreach ($context['_seq'] as $context["_key"] => $context["SUB_SUB_MENU"]) {
                            // line 57
                            echo "                                                    <li";
                            if (($this->getAttribute($context["SUB_SUB_MENU"], "selected", array()) == "selected")) {
                                echo " class=\"active open\"";
                            }
                            echo ">
                                                        <a href=\"";
                            // line 58
                            echo twig_escape_filter($this->env, $this->getAttribute($context["SUB_SUB_MENU"], "link", array()), "html", null, true);
                            echo "\"  target=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["SUB_SUB_MENU"], "target", array()), "html", null, true);
                            echo "\">
                                                                <!--<i class=\"fa";
                            // line 59
                            echo twig_escape_filter($this->env, $this->getAttribute($context["SUB_MENU"], "icon", array()), "html", null, true);
                            echo "\"></i>-->";
                            // line 60
                            echo twig_escape_filter($this->env, lang(("menu_name_" . $this->getAttribute($context["SUB_SUB_MENU"], "id", array()))), "html", null, true);
                            echo " 
                                                        </a>
                                                    </li>";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['SUB_SUB_MENU'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 64
                        echo "                                            </ul>";
                    }
                    // line 65
                    echo "    
                                    </li>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['SUB_MENU'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 68
                echo "                            </ul>";
            }
            // line 69
            echo "                            
                    </li>";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['MENU'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 72
        echo "            </ul>
            <!-- end: MAIN NAVIGATION MENU -->
        </div>
        <!-- end: SIDEBAR -->
    </div>
    <div class=\"slide-tools\">
        <div class=\"col-xs-6 text-left no-padding\">";
        // line 79
        if (((($context["LOG_USER_TYPE"] ?? null) != "affiliate") && (($context["LOG_USER_TYPE"] ?? null) != "employee"))) {
            // line 80
            echo "            <a class=\"btn btn-sm log-out text-right\" href=\"";
            echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
            echo "login/automatic_systemlock\">
                <i class=\"fa fa-lock text-white\"></i>";
            // line 81
            echo twig_escape_filter($this->env, lang("lock_screen"), "html", null, true);
            echo "
            </a>";
        }
        // line 84
        echo "        </div> 
        <div class=\"col-xs-6 text-right no-padding\">
            <a class=\"btn btn-sm log-out text-right\" href=\"";
        // line 86
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "logout-site\">
                <i class=\"fa fa-power-off text-red\"></i>";
        // line 87
        echo twig_escape_filter($this->env, lang("log_out"), "html", null, true);
        echo "
            </a>
        </div> 
    </div>
</nav>

<script type=\"text/javascript\">
    var newDate = new Date('";
        // line 94
        echo twig_escape_filter($this->env, ($context["SERVER_TIME"] ?? null), "html", null, true);
        echo "');
    function makeTimer() {
        var monthNames = [\"Jan\",\"Feb\",\"Mar\",\"Apr\",\"May\",\"Jun\",\"Jul\",\"Aug\",\"Sep\",\"Oct\",\"Nov\",\"Dec\"];
        var dayNames = [\"Sun\",\"Mon\",\"Tues\",\"Wed\",\"Thu\",\"Fri\",\"Sat\"];   
        var seconds = newDate.getSeconds();
        var minutes = newDate.getMinutes();
        var hours = newDate.getHours();
        newDate.setDate(newDate.getDate());
        \$('#date').html(\"<i class='fa fa-clock-o'/> \" + dayNames[newDate.getDay()] + \" , \" + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear() + ' ' + (hours < 10 ? \"0\" : \"\") + hours + ':' + (minutes < 10 ? \"0\" : \"\") + minutes + ':' + (seconds < 10 ? \"0\" : \"\") + seconds);        
        newDate.setSeconds(newDate.getSeconds() + 1);
    }
    setInterval(function () {
        makeTimer();
    }, 1000);
</script>
";
    }

    public function getTemplateName()
    {
        return "admin/layout/menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  247 => 94,  237 => 87,  233 => 86,  229 => 84,  224 => 81,  219 => 80,  217 => 79,  209 => 72,  194 => 69,  191 => 68,  184 => 65,  181 => 64,  172 => 60,  169 => 59,  163 => 58,  156 => 57,  152 => 56,  150 => 55,  148 => 54,  145 => 52,  142 => 51,  140 => 50,  137 => 49,  129 => 48,  122 => 47,  118 => 46,  116 => 45,  114 => 44,  110 => 41,  107 => 40,  105 => 39,  100 => 38,  92 => 37,  83 => 36,  80 => 35,  63 => 34,  50 => 22,  46 => 21,  38 => 18,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/layout/menu.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\layout\\menu.twig");
    }
}

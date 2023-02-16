<?php

/* admin/partials/sidebar.twig */
class __TwigTemplate_658fdf02f4d17dba577f37a8b3e8ef5b5748687f00d57b80a8b0f815c8226b42 extends Twig_Template
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
        echo "<!-- ========== Left Sidebar Start ========== -->


<div class=\"vertical-menu\">
    <div data-simplebar class=\"h-100\">
        <div id=\"sidebar-menu\">
            <ul class=\"metismenu list-unstyled\" id=\"side-menu\">";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["USER_MENU"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["MENU"]) {
            // line 9
            echo "                <li";
            if ((($this->getAttribute($context["MENU"], "selected", array()) == "selected") && ($this->getAttribute($context["MENU"], "id", array()) != 1))) {
                echo " class=\"mm-active\"";
            }
            echo ">
                    <a href=\"";
            // line 10
            echo twig_escape_filter($this->env, $this->getAttribute($context["MENU"], "link", array()), "html", null, true);
            echo "\"  target=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["MENU"], "target", array()), "html", null, true);
            echo "\"";
            if ((($this->getAttribute($context["MENU"], "selected", array()) == "selected") && ($this->getAttribute($context["MENU"], "id", array()) != "1"))) {
                echo " class=\"active\"";
            }
            if ($this->getAttribute($context["MENU"], "sub_menu", array())) {
                echo " class=\"has-arrow\"";
            }
            echo ">
                        <!-- <i data-feather=\"home\"></i> -->
                        <i class=\"bx";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute($context["MENU"], "icon", array()), "html", null, true);
            echo "\"></i>
                        <span >";
            // line 13
            echo twig_escape_filter($this->env, lang(("menu_name_" . $this->getAttribute($context["MENU"], "id", array()))), "html", null, true);
            echo "</span>
                    </a>";
            // line 16
            if ( !(null === $this->getAttribute($context["MENU"], "sub_menu", array()))) {
                // line 17
                echo "                    <ul class=\"sub-menu\" aria-expanded=\"false\">";
                // line 19
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["MENU"], "sub_menu", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["SUB_MENU"]) {
                    // line 20
                    echo "                        <li>
                            <a href=\"";
                    // line 21
                    echo twig_escape_filter($this->env, $this->getAttribute($context["SUB_MENU"], "link", array()), "html", null, true);
                    echo "\" target=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["SUB_MENU"], "target", array()), "html", null, true);
                    echo "\">
                                <span>";
                    // line 22
                    echo twig_escape_filter($this->env, lang(("menu_name_" . $this->getAttribute($context["SUB_MENU"], "id", array()))), "html", null, true);
                    echo " </span>
                            </a>
                        </li>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['SUB_MENU'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 26
                echo "                    </ul>";
            }
            // line 28
            echo "
                </li>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['MENU'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "            </ul>
        </div>
    </div>
</div>





";
    }

    public function getTemplateName()
    {
        return "admin/partials/sidebar.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 31,  89 => 28,  86 => 26,  77 => 22,  71 => 21,  68 => 20,  64 => 19,  62 => 17,  60 => 16,  56 => 13,  52 => 12,  38 => 10,  31 => 9,  27 => 8,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/partials/sidebar.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\partials\\sidebar.twig");
    }
}

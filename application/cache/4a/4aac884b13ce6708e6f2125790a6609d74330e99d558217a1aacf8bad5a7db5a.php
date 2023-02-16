<?php

/* admin/report/user_join.twig */
class __TwigTemplate_4cfe6d3f62444e1450ce3ff84965edd5efdf5b7902facdc58da89029680eb0a5 extends Twig_Template
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
        $this->loadTemplate("admin/partials/head-main.twig", "admin/report/user_join.twig", 1)->display($context);
        // line 2
        echo "<head>
    <base href=\"";
        // line 3
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" />
    <?= \$title_meta ?>";
        // line 6
        $this->loadTemplate("admin/partials/head-css.twig", "admin/report/user_join.twig", 6)->display($context);
        // line 7
        echo "    <link href=\"assets/libs/flatpickr/flatpickr.min.css\" rel=\"stylesheet\" type=\"text/css\">
    <!-- DataTables -->
    <link href=\"assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css\" rel=\"stylesheet\" type=\"text/css\" />

    <link href=\"assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css\" rel=\"stylesheet\" type=\"text/css\" />
</head>";
        // line 14
        $this->loadTemplate("admin/partials/body.twig", "admin/report/user_join.twig", 14)->display($context);
        // line 15
        echo "<!-- <body data-layout=\"horizontal\"> -->

<!-- Begin page -->
<div id=\"layout-wrapper\">";
        // line 20
        $this->loadTemplate("admin/partials/menu.twig", "admin/report/user_join.twig", 20)->display($context);
        // line 21
        echo "    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class=\"main-content\">

        <div class=\"page-content\">
            <div class=\"container-fluid\">

                <!-- start page title -->
                <?= \$page_title ?>
                 <div class=\"row\">
                    <div class=\"col-lg-12\">
                        <div class=\"card\">
                            <div class=\"card-header\">
                                <h4 class=\"card-title\"><i class=\"bx bx-list-ol\"></i> Customer List</h4>
                            </div>
                           
                            
                            <div class=\"card-body\">
                                <div class=\"table-responsive\">
                                    <table class=\"table mb-0\">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Customer Name</th>
                                                <th>E-mail </th>";
        // line 48
        echo "                                                <th>Status </th>
                                                <th>Date of joining </th>
                                                <th>Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>";
        // line 55
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["userreport"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["data"]) {
            // line 56
            echo "                                            <tr>
                                                <th scope=\"row\">";
            // line 57
            echo twig_escape_filter($this->env, $this->getAttribute($context["data"], "id", array()), "html", null, true);
            echo "</th>
                                                <td>";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute($context["data"], "first_name", array()), "html", null, true);
            echo "  &nbsp;";
            echo twig_escape_filter($this->env, $this->getAttribute($context["data"], "last_name", array()), "html", null, true);
            echo "</td>
                                                <td>";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute($context["data"], "email", array()), "html", null, true);
            echo "</td>";
            // line 61
            echo "                                                <td>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["data"], "user_status", array()), "html", null, true);
            echo "</td>
                                                <td>";
            // line 62
            echo twig_escape_filter($this->env, $this->getAttribute($context["data"], "date", array()), "html", null, true);
            echo "</td>
                                                <td>
                                                <a class=\"btn btn-outline-secondary btn-sm edit\" title=\"Edit\">
                                                        <i class=\"fas fa-pencil-alt\"></i>
                                                    </a>
                                                </td>
                                                 
                                            </tr>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['data'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "  
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->";
        // line 87
        $this->loadTemplate("admin/partials/footer.twig", "admin/report/user_join.twig", 87)->display($context);
        // line 88
        echo "    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->";
        // line 95
        $this->loadTemplate("admin/partials/right-sidebar.twig", "admin/report/user_join.twig", 95)->display($context);
        // line 96
        echo "<!-- JAVASCRIPT -->";
        // line 97
        $this->loadTemplate("admin/partials/vendor-scripts.twig", "admin/report/user_join.twig", 97)->display($context);
        // line 98
        echo "<script src=\"assets/js/app.js\"></script>
<script src=\"assets/libs/flatpickr/flatpickr.min.js\"></script>

<!-- Required datatable js -->
<script src=\"assets/libs/datatables.net/js/jquery.dataTables.min.js\"></script>
<script src=\"assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js\"></script>
<!-- Responsive examples -->
<script src=\"assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js\"></script>
<script src=\"assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js\"></script>
<script src=\"assets/js/pages/dashboard.init.js\"></script>
<script src=\"assets/js/pages/invoices-list.init.js\"></script>
<script src=\"assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js\"></script>
<script src=\"assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js\"></script>
<!-- dashboard init -->


<!-- App js -->";
        // line 116
        echo "<script>

\$(document).ready(function () {
    mapdata();
});
</script>
</body>

</html>";
    }

    public function getTemplateName()
    {
        return "admin/report/user_join.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  167 => 116,  149 => 98,  147 => 97,  145 => 96,  143 => 95,  137 => 88,  135 => 87,  119 => 70,  105 => 62,  100 => 61,  97 => 59,  91 => 58,  87 => 57,  84 => 56,  80 => 55,  73 => 48,  46 => 21,  44 => 20,  39 => 15,  37 => 14,  30 => 7,  28 => 6,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/report/user_join.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\report\\user_join.twig");
    }
}

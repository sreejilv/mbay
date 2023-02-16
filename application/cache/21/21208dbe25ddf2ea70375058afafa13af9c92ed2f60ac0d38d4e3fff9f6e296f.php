<?php

/* admin/product/categories.twig */
class __TwigTemplate_0bdf4365ec71a130626f8d9fb2d17d4af931e3d851f8f0fc45eb0a054a88f1b0 extends Twig_Template
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
        $this->loadTemplate("admin/partials/head-main.twig", "admin/product/categories.twig", 1)->display($context);
        // line 2
        echo "<head>
\t<base href=\"";
        // line 3
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\"/>
\t<?= \$title_meta ?>


\t<!-- DataTables -->
\t<link href=\"assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
\t<link href=\"assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
\t<link
\thref=\"assets/libs/dropzone/min/dropzone.min.css\" rel=\"stylesheet\" type=\"text/css\"/>
\t<!-- Responsive datatable examples -->
\t<link href=\"assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css\" rel=\"stylesheet\" type=\"text/css\"/>

\t<?= \$this->include('partials/head-css') ?>";
        // line 18
        $this->loadTemplate("admin/partials/head-css.twig", "admin/product/categories.twig", 18)->display($context);
        // line 19
        echo "</head>";
        // line 21
        $this->loadTemplate("admin/partials/body.twig", "admin/product/categories.twig", 21)->display($context);
        // line 22
        echo "<!-- <body data-layout=\"horizontal\"> -->

<!-- Begin page -->
\t<div id=\"layout-wrapper\">";
        // line 25
        $this->loadTemplate("admin/partials/menu.twig", "admin/product/categories.twig", 25)->display($context);
        // line 26
        echo "
\t<!-- ============================================================== -->
\t<!-- Start right Content here -->

\t<!-- ============================================================== -->
\t\t<div class=\"main-content\"> <div class=\"page-content\">
\t\t\t<div
\t\t\t\tclass=\"container-fluid\">

\t\t\t\t<!-- start page title -->
\t\t\t\t<?= \$page_title ?>
\t\t\t\t<h4 class=\"panel-title\">
\t\t\t\t\t<span class=\"text-bold\">";
        // line 39
        if (($context["edit_flag"] ?? null)) {
            // line 40
            echo twig_escape_filter($this->env, lang("update_category"), "html", null, true);
        } else {
            // line 42
            echo twig_escape_filter($this->env, lang("add_category"), "html", null, true);
        }
        // line 44
        echo "\t\t\t\t\t</span>
\t\t\t\t</h4>
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-lg-12\">
\t\t\t\t\t\t<div class=\"card\">
\t\t\t\t\t\t\t<div class=\"card-body\">
\t\t\t\t\t\t\t\t<div>";
        // line 51
        echo form_open_multipart("", " id=\"cat_form\" name=\"cat_form\"");
        // line 53
        echo "
\t\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t\t<div class=\"col-xl-4 col-md-6\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group mb-3\">
\t\t\t\t\t\t\t\t\t\t\t\t<label>Category</label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" required data-pristine-required-message=\"Please Enter a Category\" class=\"form-control\" id=\"category\" name=\"category\" value=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute(($context["category"] ?? null), "category", array()), "html", null, true);
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-xl-4 col-md-6\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group mb-3\">
\t\t\t\t\t\t\t\t\t\t\t\t<label>Description</label>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<textarea required data-pristine-required-message=\"Please Enter a Description\" class=\"ckeditor\" rows=\"2\" cols=\"36\" name=\"description\" id=\"description\" value=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute(($context["category"] ?? null), "description", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["category"] ?? null), "description", array()), "html", null, true);
        echo "</textarea>
\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-xl-4 col-md-6\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group mb-3\">
\t\t\t\t\t\t\t\t\t\t\t\t<label>Parent</label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" required data-pristine-required-message=\"Please Enter a Parent\" class=\"form-control\" name=\"parent\" id=\"parent\" value=\"";
        // line 72
        echo twig_escape_filter($this->env, $this->getAttribute(($context["category"] ?? null), "parent", array()), "html", null, true);
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div
\t\t\t\t\t\t\t\t\t\t\tclass=\"col-xl-4 col-md-6\">
\t\t\t\t\t\t\t\t\t\t\t<!-- <form action=\"#\" class=\"dropzone\"> -->
\t\t\t\t\t\t\t\t\t\t\t<div class=\"fallback\">
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"file\" multiple=\"multiple\" id=\"image\" name=\"image\">
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"dz-message needsclick\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"mb-3\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"display-4 text-muted bx bx-cloud-upload\"></i>
\t\t\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t\t\t<h5>Drop files here or click to upload.</h5>
\t\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-xl-4 col-md-6\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group mb-3\">
\t\t\t\t\t\t\t\t\t\t\t\t<label>Sort Order</label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" required data-pristine-required-message=\"Please Enter a Sort Order\" class=\"form-control\" name=\"sort_order\" id=\"sort_order\" value=\"";
        // line 93
        echo twig_escape_filter($this->env, $this->getAttribute(($context["category"] ?? null), "sort_order", array()), "html", null, true);
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"col-xl-4 col-md-6\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group mb-3\">
\t\t\t\t\t\t\t\t\t\t\t\t<label>Keyword</label>
\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" required data-pristine-required-message=\"Please Enter a Keyword\" class=\"form-control\" name=\"keyword\" id=\"keyword\" value=\"";
        // line 99
        echo twig_escape_filter($this->env, $this->getAttribute(($context["category"] ?? null), "keyword", array()), "html", null, true);
        echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<!-- end row -->

\t\t\t\t\t\t\t\t\t<div class=\"form-group\">";
        // line 107
        if (($context["edit_flag"] ?? null)) {
            // line 108
            echo "\t\t\t\t\t\t\t\t\t\t\t<button type=\"submit\" class=\"btn btn-primary\" value=\"";
            echo twig_escape_filter($this->env, ($context["product_id"] ?? null), "html", null, true);
            echo "\" name=\"update_cat\" id=\"update_cat\">";
            // line 109
            echo twig_escape_filter($this->env, lang("update"), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-arrow-circle-right\"></i>
\t\t\t\t\t\t\t\t\t\t\t</button>";
        } else {
            // line 113
            echo "\t\t\t\t\t\t\t\t\t\t\t<button type=\"submit\" class=\"btn btn-primary\" value=\"add_cat\" name=\"add_cat\">";
            // line 114
            echo twig_escape_filter($this->env, lang("add"), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-arrow-circle-right\"></i>
\t\t\t\t\t\t\t\t\t\t\t</button>";
        }
        // line 118
        echo "\t\t\t\t\t\t\t\t\t</div>";
        // line 120
        echo form_close();
        echo "
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<!-- end card -->
\t\t\t\t\t</div>
\t\t\t\t\t<!-- end col -->
\t\t\t\t</div>";
        // line 128
        if ( !($context["edit_flag"] ?? null)) {
            // line 129
            echo "
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-12\">
\t\t\t\t\t\t\t<div class=\"card\">
\t\t\t\t\t\t\t\t<div class=\"card-body\">
\t\t\t\t\t\t\t\t\t<table id=\"datatable\" class=\"table table-bordered dt-responsive  nowrap w-100\">
\t\t\t\t\t\t\t\t\t\t<thead>
\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t<th>#</th>
\t\t\t\t\t\t\t\t\t\t\t\t<th>";
            // line 138
            echo twig_escape_filter($this->env, lang("cat_name"), "html", null, true);
            echo "</th>
\t\t\t\t\t\t\t\t\t\t\t\t<th>";
            // line 139
            echo twig_escape_filter($this->env, lang("cat_desc"), "html", null, true);
            echo "</th>
\t\t\t\t\t\t\t\t\t\t\t\t<th>";
            // line 140
            echo twig_escape_filter($this->env, lang("cat_order"), "html", null, true);
            echo "</th>
\t\t\t\t\t\t\t\t\t\t\t\t<th>";
            // line 141
            echo twig_escape_filter($this->env, lang("date"), "html", null, true);
            echo "</th>
\t\t\t\t\t\t\t\t\t\t\t\t<th>";
            // line 142
            echo twig_escape_filter($this->env, lang("action"), "html", null, true);
            echo "</th>
\t\t\t\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t\t\t</thead>
\t\t\t\t\t\t\t\t\t\t<tbody>";
            // line 146
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["data"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 147
                echo "\t\t\t\t\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
                // line 148
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
                // line 149
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "category", array()), "html", null, true);
                echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
                // line 150
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "description", array()), "html", null, true);
                echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
                // line 151
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "sort_order", array()), "html", null, true);
                echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>";
                // line 152
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "creation_date", array()), "html", null, true);
                echo "</td>
\t\t\t\t\t\t\t\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a href=\"";
                // line 154
                echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
                echo "admin/categories/cat_edit/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "id", array()), "html", null, true);
                echo "\" button type=\"submit\" class=\"btn btn-primary\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fas fa-pencil-alt\"></i>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<a href=\"";
                // line 157
                echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
                echo "admin/categories/cat_delete/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "id", array()), "html", null, true);
                echo "\" button type=\"submit\" class=\"btn btn-danger\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-trash fa fa-white\"></i>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t\t\t\t</tr>";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 163
            echo "\t\t\t\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t\t\t\t</table>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>";
        }
        // line 170
        echo "\t\t\t</div>
\t\t</div>
\t\t<!-- container-fluid -->
\t</div>
</div>
<!-- End Page-content -->";
        // line 177
        $this->loadTemplate("admin/partials/footer.twig", "admin/product/categories.twig", 177)->display($context);
        // line 178
        echo "<!-- END layout-wrapper -->";
        // line 179
        $this->loadTemplate("admin/partials/right-sidebar.twig", "admin/product/categories.twig", 179)->display($context);
        echo "<!-- JAVASCRIPT -->";
        $this->loadTemplate("admin/partials/vendor-scripts.twig", "admin/product/categories.twig", 179)->display($context);
        echo "<!-- Required datatable js --><script src=\"assets/libs/datatables.net/js/jquery.dataTables.min.js\"> </script>
<script src=\"assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js\"></script><!-- Buttons examples --><script src=\"assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js\"></script>
<script src=\"assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js\"></script>
<script src=\"assets/libs/jszip/jszip.min.js\"></script>
<script src=\"assets/libs/pdfmake/build/pdfmake.min.js\"></script>
<script src=\"assets/libs/pdfmake/build/vfs_fonts.js\"></script>
<script src=\"assets/libs/datatables.net-buttons/js/buttons.html5.min.js\"></script>
<script src=\"assets/libs/datatables.net-buttons/js/buttons.print.min.js\"></script>
<script src=\"assets/libs/datatables.net-buttons/js/buttons.colVis.min.js\"></script><!-- Responsive examples --><script src=\"assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js\"></script>
<script src=\"assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js\"></script><!-- pristine js --><script src=\"assets/libs/pristinejs/pristine.min.js\"></script><!-- form validation --><script src=\"assets/js/pages/form-validation.init.js\"></script><!-- Datatable init js --><script src=\"assets/js/pages/datatables.init.js\"></script>
<script src=\"assets/libs/dropzone/min/dropzone.min.js\"></script>";
        // line 189
        echo "</body></html>
";
    }

    public function getTemplateName()
    {
        return "admin/product/categories.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  327 => 189,  312 => 179,  310 => 178,  308 => 177,  301 => 170,  293 => 163,  272 => 157,  264 => 154,  259 => 152,  255 => 151,  251 => 150,  247 => 149,  243 => 148,  240 => 147,  223 => 146,  217 => 142,  213 => 141,  209 => 140,  205 => 139,  201 => 138,  190 => 129,  188 => 128,  178 => 120,  176 => 118,  170 => 114,  168 => 113,  162 => 109,  158 => 108,  156 => 107,  146 => 99,  137 => 93,  113 => 72,  101 => 65,  91 => 58,  84 => 53,  82 => 51,  74 => 44,  71 => 42,  68 => 40,  66 => 39,  52 => 26,  50 => 25,  45 => 22,  43 => 21,  41 => 19,  39 => 18,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/product/categories.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\product\\categories.twig");
    }
}

<?php

/* admin/product/product_management.twig */
class __TwigTemplate_f95ffadf33af1d8875c585726983b6ecc1150f15f4132e10a48bd3b60c7081d6 extends Twig_Template
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
        $this->loadTemplate("admin/partials/head-main.twig", "admin/product/product_management.twig", 1)->display($context);
        // line 2
        echo "<head>
    <base href=\"";
        // line 3
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "\" />
    <?= \$title_meta ?>


    <!-- DataTables -->
    <link href=\"assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css\" rel=\"stylesheet\" type=\"text/css\" />
    <link href=\"assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css\" rel=\"stylesheet\" type=\"text/css\" />
    <link href=\"assets/libs/dropzone/min/dropzone.min.css\" rel=\"stylesheet\" type=\"text/css\" />
    <!-- Responsive datatable examples -->
    <link href=\"assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css\" rel=\"stylesheet\" type=\"text/css\" />

    <?= \$this->include('partials/head-css') ?>";
        // line 17
        $this->loadTemplate("admin/partials/head-css.twig", "admin/product/product_management.twig", 17)->display($context);
        // line 18
        echo "</head>";
        // line 20
        $this->loadTemplate("admin/partials/body.twig", "admin/product/product_management.twig", 20)->display($context);
        // line 21
        echo "<!-- <body data-layout=\"horizontal\"> -->

<!-- Begin page -->
<div id=\"layout-wrapper\">";
        // line 26
        $this->loadTemplate("admin/partials/menu.twig", "admin/product/product_management.twig", 26)->display($context);
        // line 27
        echo "
    <!-- ============================================================== -->
    <!-- Start right Content here -->

    <!-- ============================================================== -->
    <div class=\"main-content\">

        <div class=\"page-content\">
            <div class=\"container-fluid\">

                <!-- start page title -->
                <?= \$page_title ?>
                <h4 class=\"panel-title\">
                    <span class=\"text-bold\">";
        // line 41
        if (($context["edit_flag"] ?? null)) {
            // line 42
            echo twig_escape_filter($this->env, lang("update_product"), "html", null, true);
        } else {
            // line 44
            echo twig_escape_filter($this->env, lang("add_product"), "html", null, true);
        }
        // line 46
        echo "                    </span>
                </h4>
                <div class=\"row\">
                    <div class=\"col-lg-12\">
                        <div class=\"card\">
                            <div class=\"card-body\">
                                <div>
                                    <!--";
        // line 53
        echo form_open_multipart("", " id=\"product_form\" name=\"product_form\" class=\"dropzone\"");
        echo " -->
                                    <form id=\"pristine-valid-example\" novalidate method=\"post\" enctype=\"multipart/form-data\">
                                        <input type=\"hidden\" />
                                        <div class=\"row\">
                                            <div class=\"col-xl-4 col-md-6\">
                                                <div class=\"form-group mb-3\">
                                                    <label>Product Name</label>
                                                    <input type=\"text\" required data-pristine-required-message=\"Please Enter a Category\" class=\"form-control\" id=\"product_name\" name=\"product_name\" value=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "product_name", array()), "html", null, true);
        echo "\"/>

                                                    <input type=\"hidden\"  name=\"submit\" value=\"edit\"/>
                                                </div>
                                            </div>
                                            <div class=\"col-xl-4 col-md-6\">
                                                <div class=\"form-group mb-3\">
                                                    <label>Description</label>
                                                    <div class=\"col-sm-12\">
                                                        <textarea required data-pristine-required-message=\"Please Enter a Description\" class=\"ckeditor\"  rows=\"2\" cols=\"36\" name=\"description\" id=\"description\" value=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "description", array()), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "description", array()), "html", null, true);
        echo "</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=\"col-xl-4 col-md-6\">
                                                <div class=\"form-group mb-3\">
                                                    <label>Product Amount</label>
                                                    <input type=\"text\" required data-pristine-required-message=\"Please Enter a Parent\" class=\"form-control\" name=\"product_amount\" id=\"product_amount\" value=\"";
        // line 76
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "product_amount", array()), "html", null, true);
        echo "\"/>
                                                </div>
                                            </div>
                                            <div class=\"col-xl-4 col-md-6\">
                                                <div class=\"form-group mb-3\">
                                                    <label>Quantity</label>
                                                    <input type=\"text\" required data-pristine-required-message=\"Please Enter a Parent\" class=\"form-control\" name=\"quantity\" id=\"quantity\" value=\"";
        // line 82
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "quantity", array()), "html", null, true);
        echo "\"/>
                                                </div>
                                            </div>
                                            
                                            <div class=\"col-xl-4 col-md-6\">
                                                <div class=\"form-group mb-3\">
                                                    <label>Category</label>
                                                    <select class=\"form-control search-select\" id=\"category\" name=\"category\" tabindex='9'>
                                                        <option value=\"\">";
        // line 90
        echo twig_escape_filter($this->env, lang("select_a_category"), "html", null, true);
        echo "</option>";
        // line 91
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["cts"]) {
            // line 92
            echo "                                                            <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cts"], "id", array()), "html", null, true);
            echo "\"";
            if (($this->getAttribute(($context["product"] ?? null), "category", array()) == $this->getAttribute($context["cts"], "id", array()))) {
                echo " selected";
            }
            echo ">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["cts"], "category", array()), "html", null, true);
            echo "</option>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cts'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 94
        echo "                                                    </select>
                                                </div>
                                            </div>
                                        
                                            <div class=\"col-xl-4 col-md-6\">
                                                <div class=\"form-group mb-3\">
                                                    <label>Sort Order</label>
                                                    <input type=\"text\" required data-pristine-required-message=\"Please Enter a Sort Order\" class=\"form-control\" name=\"sort_order\" id=\"sort_order\" value=\"";
        // line 101
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "sort_order", array()), "html", null, true);
        echo "\"/>
                                                </div>
                                            </div>
                                            <div class=\"col-xl-4 col-md-6\">
                                                <div class=\"form-group mb-3\">
                                                    <label>Keyword</label>
                                                    <input type=\"text\" required data-pristine-required-message=\"Please Enter a Keyword\" class=\"form-control\" name=\"keyword\" id=\"keyword\" value=\"";
        // line 107
        echo twig_escape_filter($this->env, $this->getAttribute(($context["product"] ?? null), "keyword", array()), "html", null, true);
        echo "\" />
                                                </div>
                                            </div>
                                            <div class=\"col-xl-4 col-md-6\">
                                                <!-- <form action=\"#\" class=\"dropzone\"> -->
                                                    <div class=\"fallback\">
                                                        <input type=\"file\" multiple=\"multiple\" id=\"images\" name=\"images[]\" tabindex='10' accept=\"image/*\"/>
                                                    </div>
                                                    <div class=\"dz-message needsclick\">
                                                        <div class=\"mb-3\">
                                                            <i class=\"display-4 text-muted bx bx-cloud-upload\"></i>
                                                        </div>

                                                        <h5>Drop files here or click to upload.</h5>
                                                    </div>
                                                <!-- </form> -->

                                                <!-- <div class=\"text-center mt-4\">
                                                    <button type=\"button\" class=\"btn btn-primary waves-effect waves-light\">Send
                                                        Files</button>
                                                </div> -->
                           
                                            </div>

                                            <div class=\"text-center mt-4\">
                                            <button type=\"button\" class=\"btn btn-primary waves-effect waves-light\" name=\"dsfghdf\">Send
                                                Files</button>
                                        </div>
                                        <div class=\"col-xl-4 col-md-6\">

                                        <div class=\"form-group\">";
        // line 139
        if (($context["edit_flag"] ?? null)) {
            echo "                               
                                                <button type=\"button\"class=\"btn btn-primary\" value=\"";
            // line 140
            echo twig_escape_filter($this->env, ($context["product_id"] ?? null), "html", null, true);
            echo "\" name=\"update_product\" onclick=\"\$('#pristine-valid-example').submit();\" id=\"update_product\">";
            // line 141
            echo twig_escape_filter($this->env, lang("update"), "html", null, true);
            echo " <i class=\"fa fa-arrow-circle-right\"></i>
                                                </button>";
        } else {
            // line 144
            echo "                                                <button type=\"button\"class=\"btn btn-primary\" value=\"add_product\" name=\"add_product\" onclick=\"\$('#pristine-valid-example').submit();\">";
            // line 145
            echo twig_escape_filter($this->env, lang("add"), "html", null, true);
            echo " <i class=\"fa fa-arrow-circle-right\"></i>
                                                </button>";
        }
        // line 148
        echo "                                         </div>
                                         </div>
                                        </div>
                                        <!-- end row -->
                                    </form>
                                    <!--";
        // line 153
        echo form_close();
        echo " -->
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>";
        // line 161
        if ( !($context["edit_flag"] ?? null)) {
            echo " 
    
                <div class=\"row\">
                    <div class=\"col-12\">
                        <div class=\"card\">
                            <div class=\"card-body\">
                                <table id=\"datatable\" class=\"table table-bordered dt-responsive  nowrap w-100\">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>";
            // line 171
            echo twig_escape_filter($this->env, lang("product_name"), "html", null, true);
            echo "</th>
                                            <th>";
            // line 172
            echo twig_escape_filter($this->env, lang("product_amount"), "html", null, true);
            echo "</th>
                                            <th>";
            // line 173
            echo twig_escape_filter($this->env, lang("quantity"), "html", null, true);
            echo "</th>
                                            <th>";
            // line 174
            echo twig_escape_filter($this->env, lang("action"), "html", null, true);
            echo "</th>  
                                        </tr>
                                    </thead>
                                    <tbody>";
            // line 178
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
                echo " 
                                        <tr>
                                            <td>";
                // line 180
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "</td>
                                            <td>";
                // line 181
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "product_name", array()), "html", null, true);
                echo "</td>
                                            <td>";
                // line 182
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "product_amount", array()), "html", null, true);
                echo "</td>
                                            <td>";
                // line 183
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "quantity", array()), "html", null, true);
                echo "</td>
                                            <td><a href=\"";
                // line 184
                echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
                echo "admin/product-manage/edit/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "id", array()), "html", null, true);
                echo "\" button type=\"submit\"class=\"btn btn-primary\"><i class=\"fas fa-pencil-alt\"></i></a> <a href=\"";
                echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
                echo "admin/product-manage/delete/";
                echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "id", array()), "html", null, true);
                echo "\" button type=\"submit\"class=\"btn btn-danger\"><i class=\"fa fa-trash fa fa-white\"></i></a></td>
                                        </tr>";
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
            // line 187
            echo "                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                </div>";
        }
        // line 194
        echo "            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->";
        // line 199
        $this->loadTemplate("admin/partials/footer.twig", "admin/product/product_management.twig", 199)->display($context);
        // line 200
        echo "    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->";
        // line 206
        $this->loadTemplate("admin/partials/right-sidebar.twig", "admin/product/product_management.twig", 206)->display($context);
        // line 207
        echo "<!-- JAVASCRIPT -->";
        // line 208
        $this->loadTemplate("admin/partials/vendor-scripts.twig", "admin/product/product_management.twig", 208)->display($context);
        // line 209
        echo "<script src=\"assets/js/app.js\"></script>

<!-- Required datatable js -->
<script src=\"assets/libs/datatables.net/js/jquery.dataTables.min.js\"></script>
<script src=\"assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js\"></script>
<!-- Buttons examples -->
<script src=\"assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js\"></script>
<script src=\"assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js\"></script>
<script src=\"assets/libs/jszip/jszip.min.js\"></script>
<script src=\"assets/libs/pdfmake/build/pdfmake.min.js\"></script>
<script src=\"assets/libs/pdfmake/build/vfs_fonts.js\"></script>
<script src=\"assets/libs/datatables.net-buttons/js/buttons.html5.min.js\"></script>
<script src=\"assets/libs/datatables.net-buttons/js/buttons.print.min.js\"></script>
<script src=\"assets/libs/datatables.net-buttons/js/buttons.colVis.min.js\"></script>

<!-- Responsive examples -->
<script src=\"assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js\"></script>
<script src=\"assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js\"></script>

<!-- pristine js -->
<script src=\"assets/libs/pristinejs/pristine.min.js\"></script>
<!-- form validation -->
<script src=\"assets/js/pages/form-validation.init.js\"></script>

<!-- Datatable init js -->
<script src=\"assets/js/pages/datatables.init.js\"></script>

<script src=\"assets/libs/dropzone/min/dropzone.min.js\"></script>";
        // line 239
        echo "
</body>

</html>";
    }

    public function getTemplateName()
    {
        return "admin/product/product_management.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  389 => 239,  360 => 209,  358 => 208,  356 => 207,  354 => 206,  349 => 200,  347 => 199,  342 => 194,  334 => 187,  312 => 184,  308 => 183,  304 => 182,  300 => 181,  296 => 180,  276 => 178,  270 => 174,  266 => 173,  262 => 172,  258 => 171,  245 => 161,  235 => 153,  228 => 148,  223 => 145,  221 => 144,  216 => 141,  213 => 140,  209 => 139,  176 => 107,  167 => 101,  158 => 94,  144 => 92,  140 => 91,  137 => 90,  126 => 82,  117 => 76,  105 => 69,  93 => 60,  83 => 53,  74 => 46,  71 => 44,  68 => 42,  66 => 41,  51 => 27,  49 => 26,  44 => 21,  42 => 20,  40 => 18,  38 => 17,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "admin/product/product_management.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\admin\\product\\product_management.twig");
    }
}

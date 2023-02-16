<?php

/* shop/checkout.twig */
class __TwigTemplate_308fbb423ce3ad64c378513326a9f4304cae4dba7477c5a6d2a62118df3e5879 extends Twig_Template
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
        $this->loadTemplate("shop/layout/header.twig", "shop/checkout.twig", 1)->display($context);
        // line 2
        echo "
        <!-- Breadcrumb-area -->
        <div class=\"breadcrumb-area bg-gray\">
            <div class=\"container\">
                <div class=\"breadcrumb-content text-center\">
                    <ul>
                        <li><a href=\"";
        // line 8
        echo twig_escape_filter($this->env, ($context["BASE_URL"] ?? null), "html", null, true);
        echo "index\">Home</a></li>
                        <li class=\"active\">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-area -->



        <!-- CHECKOUT -->
        <section class=\"checkout-main-area pt-120 pb-120\">
            <div class=\"container\">


                <div class=\"checkout-wrap pt-30\">
                    <div class=\"row\">
                        <div class=\"col-lg-7\">


                            <!-- CLICK COLLECT & HOME DELIVERY TAB -->
                            <ul class=\"nav nav-pills nav-fill\" id=\"pills-tab\" role=\"tablist\">
                                <li class=\"nav-item\" role=\"presentation\">
                                    <button class=\"nav-link active\" id=\"pills-home-tab\" data-bs-toggle=\"pill\"
                                        data-bs-target=\"#pills-home\" type=\"button\" role=\"tab\" aria-controls=\"pills-home\"
                                        aria-selected=\"true\">
                                        Click & Collect</button>
                                </li>
                                <li class=\"nav-item\" role=\"presentation\">
                                    <button class=\"nav-link\" id=\"pills-profile-tab\" data-bs-toggle=\"pill\"
                                        data-bs-target=\"#pills-profile\" type=\"button\" role=\"tab\"
                                        aria-controls=\"pills-profile\" aria-selected=\"false\">Home Delivery</button>
                                </li>

                            </ul>

                            <div class=\"tab-content\" id=\"pills-tabContent\">
                                <div class=\"tab-pane fade show active\" id=\"pills-home\" role=\"tabpanel\"
                                    aria-labelledby=\"pills-home-tab\" tabindex=\"0\">
                                    <!--click & collect-->

                                    <!--store location map-->
                                    <iframe
                                        src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d532.8177231034424!2d58.19138790642781!3d23.6746034061987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e8dfd0a1c0b9a81%3A0xbb048c48328dd216!2zTWF4cGhvbmUgT21hbiAtINmF2YPYsyDZgdmI2YYg2LnZhdin2YY!5e0!3m2!1sen!2som!4v1674372358473!5m2!1sen!2som\"
                                        width=\"100%\" height=\"300\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\"
                                        referrerpolicy=\"no-referrer-when-downgrade\"></iframe>
                                    <!--end store location map-->

                                    <!--contact details-->
                                    <div class=\"billing-info-wrap mr-50 mt-4\">
                                        <h3>Add your contact details</h3>
                                        <div class=\"row\">
                                            <!--fullname-->
                                            <div class=\"col-lg-6\">
                                                <div class=\"billing-info mb-20\">
                                                    <label>Full Name<abbr class=\"required\"
                                                        title=\"required\">*</abbr></label>
                                                    <input type=\"text\">
                                                </div>
                                            </div>
                                            <!--end fullname-->
                                            <!--mobile number-->
                                            <div class=\"col-lg-6\">
                                                <div class=\"billing-info mb-20\">
                                                    <label>Mobile Number<abbr class=\"required\"
                                                            title=\"required\">*</abbr></label>
                                                    <input type=\"text\">
                                                </div>
                                            </div>
                                            <!--end mobile number-->
                                        </div>
                                        <div class=\"row\">
                                            <!--email-->
                                            <div class=\"col-lg-6\">
                                                <div class=\"billing-info mb-20\">
                                                    <label>Email</label>
                                                    <input type=\"text\">
                                                </div>
                                            </div>
                                            <!--end email-->
                                        </div>
                                    </div>
                                    <!--end contact details-->

                                    <!--end click & collect-->
                                </div>

                                <div class=\"tab-pane fade\" id=\"pills-profile\" role=\"tabpanel\"
                                    aria-labelledby=\"pills-profile-tab\" tabindex=\"0\">
                                    <!--home delivery-->
                                    <div class=\"billing-info-wrap mr-50\">
                                        <h3>Add your shipping address</h3>
                                        <div class=\"row\">
                                            <!--city-->
                                            <div class=\"col-lg-12\">
                                                <div class=\"billing-select mb-20\">
                                                    <label>City <abbr class=\"required\" title=\"required\">*</abbr></label>
                                                    <select>
                                                        <option>Select your city</option>
                                                        <option>Azerbaijan</option>
                                                        <option>Bahamas</option>
                                                        <option>Bahrain</option>
                                                        <option>Bangladesh</option>
                                                        <option>Barbados</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end city-->

                                            <!--area-->
                                            <div class=\"col-lg-12\">
                                                <div class=\"billing-select mb-20\">
                                                    <label>Area <abbr class=\"required\" title=\"required\">*</abbr></label>
                                                    <select>
                                                        <option>Select your area</option>
                                                        <option>Azerbaijan</option>
                                                        <option>Bahamas</option>
                                                        <option>Bahrain</option>
                                                        <option>Bangladesh</option>
                                                        <option>Barbados</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end area-->

                                            <!--apartment-->
                                            <div class=\"col-lg-12\">
                                                <div class=\"billing-info mb-20\">
                                                    <label>Building Name/House No, Floor, Apartment No. <abbr
                                                            class=\"required\" title=\"required\">*</abbr></label>
                                                    <input type=\"text\">
                                                </div>
                                            </div>
                                            <!--end apartment-->

                                            <!--street name-->
                                            <div class=\"col-lg-12\">
                                                <div class=\"billing-info mb-20\">
                                                    <label>Street Name/No, P.O. Box No. <abbr class=\"required\"
                                                            title=\"required\">*</abbr></label>
                                                    <input type=\"text\">
                                                </div>
                                            </div>
                                            <!--end street name-->

                                            <!--landmark-->
                                            <div class=\"col-lg-12\">
                                                <div class=\"billing-info mb-20\">
                                                    <label>Landmark <span class=\"text-muted\">(optional)</span></label>
                                                    <input type=\"text\">
                                                </div>
                                            </div>
                                            <!--end landmark-->

                                            <h4 class=\"mb-3 mt-2\">Personal Information</h4>

                                            <!--fullname-->
                                            <div class=\"col-lg-12\">
                                                <div class=\"billing-info mb-20\">
                                                    <label>Full Name</label>
                                                    <input type=\"text\">
                                                </div>
                                            </div>
                                            <!--end fullname-->

                                            <!--mobile number-->
                                            <div class=\"col-lg-12\">
                                                <div class=\"billing-info mb-20\">
                                                    <label>Mobile Number<abbr class=\"required\"
                                                            title=\"required\">*</abbr></label>
                                                    <input type=\"text\">
                                                </div>
                                            </div>
                                            <!--end mobile number-->

                                            <!--home or office-->
                                            <div class=\"col-lg-12\">
                                                <div class=\"mb-3\">
                                                    <label class=\"d-block mb-2\">Address Type <span
                                                            class=\"text-muted\">(optional)</span></label>

                                                    <div class=\"form-check form-check-inline\">
                                                        <input class=\"form-check-input\" type=\"radio\"
                                                            name=\"inlineRadioOptions\" id=\"inlineRadio1\" value=\"option1\">
                                                        <label class=\"form-check-label\" for=\"inlineRadio1\">Home</label>
                                                    </div>
                                                    <div class=\"form-check form-check-inline\">
                                                        <input class=\"form-check-input\" type=\"radio\"
                                                            name=\"inlineRadioOptions\" id=\"inlineRadio2\" value=\"option2\">
                                                        <label class=\"form-check-label\"
                                                            for=\"inlineRadio2\">Office</label>
                                                    </div>

                                                </div>

                                            </div>
                                            <!--end home or office-->
                                        </div>
                                    </div>
                                    <!--end home delivery-->
                                </div>
                            </div>
                            <!-- END CLICK COLLECT & HOME DELIVERY TAB -->


                        </div>

                        <div class=\"col-lg-5\">
                            <div class=\"your-order-area\">
                                <h3>Your order summary</h3>
                                <div class=\"your-order-wrap gray-bg-4\">
                                    <div class=\"your-order-info-wrap\">

                                        <div class=\"summary-item-main d-none d-sm-none d-md-none d-lg-block\">
                                            <!--summary loop items-->
                                            <div class=\"d-flex\">
                                                <div class=\"flex-shrink-0\">
                                                    <img src=\"assets/shop/images/product/product-sample-1.jpg\" alt=\"...\">
                                                </div>
                                                <div class=\"flex-grow-1 ms-3\">
                                                    <h5>SAMSUNG Galaxy F13 (Waterfall Blue, 64
                                                        GB)</h5>
                                                    <p>Colour: <span>Grey</span></p>
                                                    <div
                                                        class=\"d-flex-price justify-content-between align-items-center\">
                                                        <p>Qty: <span>1</span></p>
                                                        <p>Price: <span class=\"fw-semibold\">OMR 15.00</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end summary  loop items-->
                                            <!--summary loop items-->
                                            <div class=\"d-flex\">
                                                <div class=\"flex-shrink-0\">
                                                    <img src=\"assets/shop/images/product/product-sample-1.jpg\" alt=\"...\">
                                                </div>
                                                <div class=\"flex-grow-1 ms-3\">
                                                    <h5>SAMSUNG Galaxy F13 (Waterfall Blue, 64
                                                        GB)</h5>
                                                    <p>Colour: <span>Grey</span></p>
                                                    <div
                                                        class=\"d-flex-price justify-content-between align-items-center\">
                                                        <p>Qty: <span>1</span></p>
                                                        <p>Price: <span class=\"fw-semibold\">OMR 15.00</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end summary  loop items-->
                                        </div>


                                        <div class=\"your-order-info order-shipping\">
                                            <ul>
                                                <li>Price (2 items) <span class=\"fw-semibold\">OMR 329 </span></li>
                                                <li>Delivery Charges <span class=\"fw-semibold\">OMR 329 </span></li>
                                                <li>Secured Packaging Fee <span class=\"fw-semibold\">OMR 329 </span></li>
                                            </ul>
                                        </div>
                                        <div class=\"your-order-info order-total b-top-dashed\">
                                            <ul>
                                                <li class=\"fw-semibold\">Total Payable <span class=\"fw-semibold\">OMR
                                                        273.00 </span></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!--payment-->
                                    <div class=\"payment-method\">
                                        <div class=\"pay-top sin-payment\">
                                            <input id=\"payment_method_1\" class=\"input-radio\" type=\"radio\" value=\"cheque\"
                                                checked=\"checked\" name=\"payment_method\">
                                            <label for=\"payment_method_1\"> Direct Bank Transfer </label>
                                            <div class=\"payment-box payment_method_bacs\">
                                                <p>Make your payment directly into our bank account. Please use your
                                                    Order ID as the payment reference.</p>
                                            </div>
                                        </div>
                                        <div class=\"pay-top sin-payment\">
                                            <input id=\"payment-method-2\" class=\"input-radio\" type=\"radio\" value=\"cheque\"
                                                name=\"payment_method\">
                                            <label for=\"payment-method-2\">Check payments</label>
                                            <div class=\"payment-box payment_method_bacs\">
                                                <p>Make your payment directly into our bank account. Please use your
                                                    Order ID as the payment reference.</p>
                                            </div>
                                        </div>
                                        <div class=\"pay-top sin-payment\">
                                            <input id=\"payment-method-3\" class=\"input-radio\" type=\"radio\" value=\"cheque\"
                                                name=\"payment_method\">
                                            <label for=\"payment-method-3\">Cash on delivery </label>
                                            <div class=\"payment-box payment_method_bacs\">
                                                <p>Make your payment directly into our bank account. Please use your
                                                    Order ID as the payment reference.</p>
                                            </div>
                                        </div>
                                        <div class=\"pay-top sin-payment sin-payment-3\">
                                            <input id=\"payment-method-4\" class=\"input-radio\" type=\"radio\" value=\"cheque\"
                                                name=\"payment_method\">
                                            <label for=\"payment-method-4\">PayPal <img alt=\"\"
                                                    src=\"assets/shop/images/icon-img/payment.png\"><a href=\"#\">What is
                                                    PayPal?</a></label>
                                            <div class=\"payment-box payment_method_bacs\">
                                                <p>Make your payment directly into our bank account. Please use your
                                                    Order ID as the payment reference.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end payment-->

                                </div>
                                <div class=\"place-order\">
                                    <a href=\"#\">Place Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END CHECKOUT -->";
        // line 329
        $this->loadTemplate("shop/layout/footer.twig", "shop/checkout.twig", 329)->display($context);
    }

    public function getTemplateName()
    {
        return "shop/checkout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  351 => 329,  29 => 8,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "shop/checkout.twig", "C:\\wamp64\\www\\WC\\mbay\\application\\views\\shop\\checkout.twig");
    }
}

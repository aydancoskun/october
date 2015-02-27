<?php

/* @SecurityInfo/index.twig */
class __TwigTemplate_79da3bbaf6fd4807aefe823e0476247ec2ee61d0ee8736331544cb0623c31a85 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("admin.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "admin.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<h2>";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("SecurityInfo_SecurityInformation")), "html", null, true);
        echo "</h2>
<p>";
        // line 5
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("SecurityInfo_PluginDescription")), "html", null, true);
        echo "</p>
<p>Learn more: read our guide <a target='_blank' href='http://piwik.org/security/how-to-secure-piwik/'>Hardening Piwik: How to make Piwik and your web server
        more secure?</a></p>
<div style=\"max-width:980px;\">
    ";
        // line 9
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["results"]) ? $context["results"] : $this->getContext($context, "results")), "test_results", array()));
        foreach ($context['_seq'] as $context["i"] => $context["section"]) {
            // line 10
            echo "        <h2>";
            echo twig_escape_filter($this->env, $context["i"], "html", null, true);
            echo "</h2>
        <table class=\"dataTable entityTable\">
            <thead>
            <tr>
                <th>";
            // line 14
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("SecurityInfo_Test")), "html", null, true);
            echo "</th>
                <th>";
            // line 15
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("SecurityInfo_Result")), "html", null, true);
            echo "</th>
            </tr>
            </thead>
            <tbody>
            ";
            // line 19
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($context["section"]);
            foreach ($context['_seq'] as $context["j"] => $context["test"]) {
                // line 20
                echo "                <tr>
                    <td>";
                // line 21
                echo twig_escape_filter($this->env, $context["j"], "html", null, true);
                echo "</td>
                    ";
                // line 22
                ob_start();
                // line 23
                echo "                        ";
                if (($this->getAttribute($context["test"], "result", array()) == (-1))) {
                    // line 24
                    echo "                            background-color:#dff0d8;color:#468847;
                        ";
                } elseif (($this->getAttribute($context["test"], "result", array()) == (-2))) {
                    // line 26
                    echo "                            background-color:#ffffe0;color:#b94a48;
                        ";
                } elseif (($this->getAttribute($context["test"], "result", array()) == (-4))) {
                    // line 28
                    echo "                            background-color:#f2dede;color:#b94a48;font-weight:bold;
                        ";
                }
                // line 30
                echo "                    ";
                $context["color"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                // line 31
                echo "                    <td style=\"";
                echo twig_escape_filter($this->env, (isset($context["color"]) ? $context["color"] : $this->getContext($context, "color")), "html", null, true);
                echo "}\">";
                echo $this->getAttribute($context["test"], "message", array());
                echo "</td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['j'], $context['test'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 34
            echo "            </tbody>
        </table>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['i'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "@SecurityInfo/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 37,  109 => 34,  97 => 31,  94 => 30,  90 => 28,  86 => 26,  82 => 24,  79 => 23,  77 => 22,  73 => 21,  70 => 20,  66 => 19,  59 => 15,  55 => 14,  47 => 10,  43 => 9,  36 => 5,  31 => 4,  28 => 3,);
    }
}

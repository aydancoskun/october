<?php

/* @CoreAdminHome/_menu.twig */
class __TwigTemplate_463619e7c147bb86c708110cd81ac9129f0ace5dae3509beb3bc6dcbe7f375fc extends Twig_Template
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
        if ((twig_length_filter($this->env, (isset($context["adminMenu"]) ? $context["adminMenu"] : $this->getContext($context, "adminMenu"))) > 1)) {
            // line 2
            echo "    <div class=\"Menu Menu--admin\">
        <ul class=\"Menu-tabList\">
        ";
            // line 4
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["adminMenu"]) ? $context["adminMenu"] : $this->getContext($context, "adminMenu")));
            foreach ($context['_seq'] as $context["name"] => $context["submenu"]) {
                // line 5
                echo "            ";
                if ($this->getAttribute($context["submenu"], "_hasSubmenu", array())) {
                    // line 6
                    echo "            <li>
                <span>";
                    // line 7
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array($context["name"])), "html", null, true);
                    echo "</span>
                <ul>
                ";
                    // line 9
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($context["submenu"]);
                    foreach ($context['_seq'] as $context["sname"] => $context["url"]) {
                        // line 10
                        echo "                    ";
                        if ((twig_slice($this->env, $context["sname"], 0, 1) != "_")) {
                            // line 11
                            echo "                    <li>
                        <a href='index.php";
                            // line 12
                            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('urlRewriteWithParameters')->getCallable(), array($this->getAttribute($context["url"], "_url", array()))), "html", null, true);
                            echo "'
                           ";
                            // line 13
                            if ((array_key_exists("currentAdminMenuName", $context) && ($context["sname"] == (isset($context["currentAdminMenuName"]) ? $context["currentAdminMenuName"] : $this->getContext($context, "currentAdminMenuName"))))) {
                                echo "class='active'";
                            }
                            echo ">";
                            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array($context["sname"])), "html", null, true);
                            echo "</a>
                    </li>
                    ";
                        }
                        // line 16
                        echo "                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['sname'], $context['url'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 17
                    echo "                </ul>
            </li>
            ";
                }
                // line 20
                echo "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['submenu'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 21
            echo "        </ul>
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "@CoreAdminHome/_menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 21,  75 => 20,  70 => 17,  64 => 16,  54 => 13,  50 => 12,  47 => 11,  44 => 10,  40 => 9,  35 => 7,  32 => 6,  29 => 5,  25 => 4,  21 => 2,  19 => 1,);
    }
}

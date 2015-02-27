<?php

/* @Installation/_systemCheckLegend.twig */
class __TwigTemplate_c06bc24af04ca595c166887ead04f3608d8f56b8f19ded94809736119b62b0f3 extends Twig_Template
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
        echo "<div id=\"systemCheckLegend\">
    <span style=\"font-size: small;\">
        <h2>";
        // line 3
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_Legend")), "html", null, true);
        echo "</h2>
        <br/>
        <img src='plugins/Morpheus/images/warning.png'/> <span class=\"warn\">";
        // line 5
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Warning")), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_SystemCheckWarning")), "html", null, true);
        echo "</span>
        <br/>
        <img src='plugins/Morpheus/images/error.png'/> <span style=\"color:red;font-weight:bold;\">";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Error")), "html", null, true);
        echo "
            : ";
        // line 8
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_SystemCheckError")), "html", null, true);
        echo " </span><br/>
        <img src='plugins/Morpheus/images/ok.png'/> <span style=\"color:#26981C;font-weight:bold;\">";
        // line 9
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Ok")), "html", null, true);
        echo "</span><br/>
    </span>
</div>

<p class=\"nextStep\">
    <a href=\"";
        // line 14
        echo twig_escape_filter($this->env, (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_RefreshPage")), "html", null, true);
        echo " &raquo;</a>
</p>
";
    }

    public function getTemplateName()
    {
        return "@Installation/_systemCheckLegend.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 14,  43 => 9,  39 => 8,  35 => 7,  28 => 5,  23 => 3,  19 => 1,);
    }
}

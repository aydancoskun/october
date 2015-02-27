<?php

/* @CoreHome/_warningInvalidHost.twig */
class __TwigTemplate_98d2dbeecbf270424e8d3d07385c201fc7a215c06bc5d5a1750710fe46f967ed extends Twig_Template
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
        // line 2
        if (((array_key_exists("isValidHost", $context) && array_key_exists("invalidHostMessage", $context)) && ((isset($context["isValidHost"]) ? $context["isValidHost"] : $this->getContext($context, "isValidHost")) == false))) {
            // line 3
            echo "    ";
            ob_start();
            // line 4
            echo "        <a style=\"float:right;\" href=\"http://piwik.org/faq/troubleshooting/#faq_171\" target=\"_blank\"><img src=\"plugins/Morpheus/images/help.png\"/></a>
        <strong>";
            // line 5
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Warning")), "html", null, true);
            echo ":&nbsp;</strong>";
            echo (isset($context["invalidHostMessage"]) ? $context["invalidHostMessage"] : $this->getContext($context, "invalidHostMessage"));
            echo "

        <br>
        <br>

        <small>";
            // line 10
            echo (isset($context["invalidHostMessageHowToFix"]) ? $context["invalidHostMessageHowToFix"] : $this->getContext($context, "invalidHostMessageHowToFix"));
            echo "
        <br/><br/><a style=\"float:right;\" href=\"http://piwik.org/faq/troubleshooting/#faq_171\" target=\"_blank\">";
            // line 11
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Help")), "html", null, true);
            echo "
        <img style=\"vertical-align: bottom;\" src=\"plugins/Morpheus/images/help.png\"/></a><br/>
        </small>
    ";
            $context["invalidHostText"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 15
            echo "
    <div style=\"clear:both;width:800px;\">
        ";
            // line 17
            echo call_user_func_array($this->env->getFilter('notification')->getCallable(), array((isset($context["invalidHostText"]) ? $context["invalidHostText"] : $this->getContext($context, "invalidHostText")), array("noclear" => true, "raw" => true, "context" => "warning")));
            echo "
    </div>

";
        }
        // line 21
        echo "
";
    }

    public function getTemplateName()
    {
        return "@CoreHome/_warningInvalidHost.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 21,  52 => 17,  48 => 15,  41 => 11,  37 => 10,  27 => 5,  24 => 4,  21 => 3,  19 => 2,);
    }
}

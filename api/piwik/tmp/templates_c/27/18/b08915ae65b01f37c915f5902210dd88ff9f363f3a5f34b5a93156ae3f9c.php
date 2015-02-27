<?php

/* @PrivacyManager/getDatabaseSize.twig */
class __TwigTemplate_2718b08915ae65b01f37c915f5902210dd88ff9f363f3a5f34b5a93156ae3f9c extends Twig_Template
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
        echo "<p>";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("PrivacyManager_CurrentDBSize")), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["dbStats"]) ? $context["dbStats"] : $this->getContext($context, "dbStats")), "currentSize", array()), "html", null, true);
        echo "</p>
";
        // line 2
        if ($this->getAttribute((isset($context["dbStats"]) ? $context["dbStats"] : null), "sizeAfterPurge", array(), "any", true, true)) {
            // line 3
            echo "    <p>";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("PrivacyManager_EstimatedDBSizeAfterPurge")), "html", null, true);
            echo ": <strong>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["dbStats"]) ? $context["dbStats"] : $this->getContext($context, "dbStats")), "sizeAfterPurge", array()), "html", null, true);
            echo "</strong></p>
";
        }
        // line 5
        if ($this->getAttribute((isset($context["dbStats"]) ? $context["dbStats"] : null), "spaceSaved", array(), "any", true, true)) {
            // line 6
            echo "    <p>";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("PrivacyManager_EstimatedSpaceSaved")), "html", null, true);
            echo ": ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["dbStats"]) ? $context["dbStats"] : $this->getContext($context, "dbStats")), "spaceSaved", array()), "html", null, true);
            echo "</p>
";
        }
    }

    public function getTemplateName()
    {
        return "@PrivacyManager/getDatabaseSize.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 6,  36 => 5,  28 => 3,  26 => 2,  19 => 1,);
    }
}

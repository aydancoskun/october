<?php

/* @Referrers/getSearchEnginesAndKeywords.twig */
class __TwigTemplate_d2672073fcdbcca2dc15b67997f21b16f3955b72715dd1396131788a5eccbcc2 extends Twig_Template
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
        echo "<div id='leftcolumn'>
    <h2 piwik-enriched-headline>";
        // line 2
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Referrers_Keywords")), "html", null, true);
        echo "</h2>
    ";
        // line 3
        echo (isset($context["keywords"]) ? $context["keywords"] : $this->getContext($context, "keywords"));
        echo "
</div>

<div id='rightcolumn'>
    <h2 piwik-enriched-headline>";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Referrers_SearchEngines")), "html", null, true);
        echo "</h2>
    ";
        // line 8
        echo (isset($context["searchEngines"]) ? $context["searchEngines"] : $this->getContext($context, "searchEngines"));
        echo "
</div>
";
    }

    public function getTemplateName()
    {
        return "@Referrers/getSearchEnginesAndKeywords.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 8,  33 => 7,  26 => 3,  22 => 2,  19 => 1,);
    }
}

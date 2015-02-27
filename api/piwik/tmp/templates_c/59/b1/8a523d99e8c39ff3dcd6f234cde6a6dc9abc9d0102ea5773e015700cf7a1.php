<?php

/* @Actions/indexSiteSearch.twig */
class __TwigTemplate_59b18a523d99e8c39ff3dcd6f234cde6a6dc9abc9d0102ea5773e015700cf7a1 extends Twig_Template
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
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Actions_WidgetSearchKeywords")), "html", null, true);
        echo "</h2>
    ";
        // line 3
        echo (isset($context["keywords"]) ? $context["keywords"] : $this->getContext($context, "keywords"));
        echo "

    <h2 piwik-enriched-headline>";
        // line 5
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Actions_WidgetSearchNoResultKeywords")), "html", null, true);
        echo "</h2>
    ";
        // line 6
        echo (isset($context["noResultKeywords"]) ? $context["noResultKeywords"] : $this->getContext($context, "noResultKeywords"));
        echo "

    ";
        // line 8
        if (array_key_exists("categories", $context)) {
            // line 9
            echo "        <h2 piwik-enriched-headline>";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Actions_WidgetSearchCategories")), "html", null, true);
            echo "</h2>
        ";
            // line 10
            echo (isset($context["categories"]) ? $context["categories"] : $this->getContext($context, "categories"));
            echo "
    ";
        }
        // line 12
        echo "</div>

<div id='rightcolumn'>
    <h2 piwik-enriched-headline>";
        // line 15
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Actions_WidgetPageUrlsFollowingSearch")), "html", null, true);
        echo "</h2>
    ";
        // line 16
        echo (isset($context["pagesUrlsFollowingSiteSearch"]) ? $context["pagesUrlsFollowingSiteSearch"] : $this->getContext($context, "pagesUrlsFollowingSiteSearch"));
        echo "
</div>
";
    }

    public function getTemplateName()
    {
        return "@Actions/indexSiteSearch.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 16,  57 => 15,  52 => 12,  47 => 10,  42 => 9,  40 => 8,  35 => 6,  31 => 5,  26 => 3,  22 => 2,  19 => 1,);
    }
}

<?php

/* @Events/index.twig */
class __TwigTemplate_0e10239491ffe3601c1d1d0d65e3bb2f8fcc33e1f24786436d8fad12e131c9e9 extends Twig_Template
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
        echo (isset($context["leftMenuReports"]) ? $context["leftMenuReports"] : $this->getContext($context, "leftMenuReports"));
        echo "

";
    }

    public function getTemplateName()
    {
        return "@Events/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}

<?php

/* page-chapter-cover.html */
class __TwigTemplate_5307b2015cf4397033d7f4994427bb214667d51eb5bb4d414147c085f89f8868 extends Twig_Template
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
        echo "        <!-- Chapter Cover +++ ";
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo " -->
        <slide data-date class='fill nobackground'";
        // line 2
        if (((isset($context["backgroundImage"]) ? $context["backgroundImage"] : null) != false)) {
            echo " style=\"background-image: url(images/";
            echo twig_escape_filter($this->env, (isset($context["backgroundImage"]) ? $context["backgroundImage"] : null), "html", null, true);
            echo ")\"";
        }
        echo ">
            <hgroup class='new-chapter'>
                <h2";
        // line 4
        if (((isset($context["titleClass"]) ? $context["titleClass"] : null) != false)) {
            echo " class=\"";
            echo twig_escape_filter($this->env, (isset($context["titleClass"]) ? $context["titleClass"] : null), "html", null, true);
            echo "\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</h2>
            </hgroup>
        </slide>
";
    }

    public function getTemplateName()
    {
        return "page-chapter-cover.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 4,  24 => 2,  19 => 1,);
    }
}
/*         <!-- Chapter Cover +++ {{ title }} -->*/
/*         <slide data-date class='fill nobackground'{% if backgroundImage != false %} style="background-image: url(images/{{ backgroundImage }})"{% endif %}>*/
/*             <hgroup class='new-chapter'>*/
/*                 <h2{% if titleClass != false %} class="{{ titleClass }}"{% endif %}>{{ title }}</h2>*/
/*             </hgroup>*/
/*         </slide>*/
/* */

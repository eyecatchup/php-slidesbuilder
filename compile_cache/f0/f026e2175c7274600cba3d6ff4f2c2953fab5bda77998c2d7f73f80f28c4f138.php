<?php

/* page-iframe.html */
class __TwigTemplate_cc932a5ab4a123ea11718ab1a3c1b02bcb913aa6d5e652ef51d679c4e92494a3 extends Twig_Template
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
        echo "        <!-- Iframe Slide +++ ";
        echo twig_escape_filter($this->env, (isset($context["iframeUrl"]) ? $context["iframeUrl"] : null), "html", null, true);
        echo " -->
        <slide data-date>
            <hgroup>
                <h2>";
        // line 4
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</h2>
            </hgroup>
            <article>
                <iframe data-src=\"";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["iframeUrl"]) ? $context["iframeUrl"] : null), "html", null, true);
        echo "\"></iframe>
            </article>
        </slide>
";
    }

    public function getTemplateName()
    {
        return "page-iframe.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  32 => 7,  26 => 4,  19 => 1,);
    }
}
/*         <!-- Iframe Slide +++ {{ iframeUrl }} -->*/
/*         <slide data-date>*/
/*             <hgroup>*/
/*                 <h2>{{ title }}</h2>*/
/*             </hgroup>*/
/*             <article>*/
/*                 <iframe data-src="{{ iframeUrl }}"></iframe>*/
/*             </article>*/
/*         </slide>*/
/* */

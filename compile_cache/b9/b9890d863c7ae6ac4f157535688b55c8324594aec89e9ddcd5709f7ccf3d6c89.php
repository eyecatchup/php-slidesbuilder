<?php

/* page-default.html */
class __TwigTemplate_b06e3dbba2eb860636d6f237a11f61f069b7f52df6334aab4069c3bd2b868cfa extends Twig_Template
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
        echo "        <!-- Default Slide +++ ";
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo " -->
        <slide data-date";
        // line 2
        if (((isset($context["slideClass"]) ? $context["slideClass"] : null) != false)) {
            echo " class=\"";
            echo twig_escape_filter($this->env, (isset($context["slideClass"]) ? $context["slideClass"] : null), "html", null, true);
            echo "\"";
        }
        if (((isset($context["backgroundImage"]) ? $context["backgroundImage"] : null) != false)) {
            echo " style=\"background-image: url(images/";
            echo twig_escape_filter($this->env, (isset($context["backgroundImage"]) ? $context["backgroundImage"] : null), "html", null, true);
            echo ")\"";
        }
        echo ">
";
        // line 3
        if (((isset($context["headerAsideImageBadge"]) ? $context["headerAsideImageBadge"] : null) != false)) {
            // line 4
            echo "            <aside class=\"gdbar-aoe gdbar top-right\">
                <img src=\"";
            // line 5
            echo twig_escape_filter($this->env, (isset($context["headerAsideImageBadge"]) ? $context["headerAsideImageBadge"] : null), "html", null, true);
            echo "\" />
            </aside>
";
        }
        // line 8
        echo "            <hgroup";
        if (((isset($context["hgroupClass"]) ? $context["hgroupClass"] : null) != false)) {
            echo " class=\"";
            echo twig_escape_filter($this->env, (isset($context["hgroupClass"]) ? $context["hgroupClass"] : null), "html", null, true);
            echo "\"";
        }
        echo ">
                <h2";
        // line 9
        if (((isset($context["titleClass"]) ? $context["titleClass"] : null) != false)) {
            echo " class=\"";
            echo twig_escape_filter($this->env, (isset($context["titleClass"]) ? $context["titleClass"] : null), "html", null, true);
            echo "\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</h2>
            </hgroup>
            <article";
        // line 11
        if (((isset($context["articleClass"]) ? $context["articleClass"] : null) != false)) {
            echo " class=\"";
            echo twig_escape_filter($this->env, (isset($context["articleClass"]) ? $context["articleClass"] : null), "html", null, true);
            echo "\"";
        }
        echo ">
";
        // line 13
        echo "                ";
        echo (isset($context["content"]) ? $context["content"] : null);
        echo "
            </article>
";
        // line 16
        if (((isset($context["footer"]) ? $context["footer"] : null) != false)) {
            // line 17
            echo "            <footer class=\"";
            if (((isset($context["footerClass"]) ? $context["footerClass"] : null) != false)) {
                echo twig_escape_filter($this->env, (isset($context["footerClass"]) ? $context["footerClass"] : null), "html", null, true);
            } else {
                echo "source white";
            }
            echo "\">
                ";
            // line 18
            echo twig_escape_filter($this->env, (isset($context["footer"]) ? $context["footer"] : null), "html", null, true);
            echo "
            </footer>
";
        }
        // line 21
        echo "        </slide>
";
    }

    public function getTemplateName()
    {
        return "page-default.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 21,  93 => 18,  84 => 17,  82 => 16,  76 => 13,  68 => 11,  57 => 9,  48 => 8,  42 => 5,  39 => 4,  37 => 3,  24 => 2,  19 => 1,);
    }
}
/*         <!-- Default Slide +++ {{ title }} -->*/
/*         <slide data-date{% if slideClass != false %} class="{{ slideClass }}"{% endif %}{% if backgroundImage != false %} style="background-image: url(images/{{ backgroundImage }})"{% endif %}>*/
/* {% if headerAsideImageBadge != false %}*/
/*             <aside class="gdbar-aoe gdbar top-right">*/
/*                 <img src="{{ headerAsideImageBadge }}" />*/
/*             </aside>*/
/* {% endif %}*/
/*             <hgroup{% if hgroupClass != false %} class="{{ hgroupClass }}"{% endif %}>*/
/*                 <h2{% if titleClass != false %} class="{{ titleClass }}"{% endif %}>{{ title }}</h2>*/
/*             </hgroup>*/
/*             <article{% if articleClass != false %} class="{{ articleClass }}"{% endif %}>*/
/* {% autoescape %}*/
/*                 {{ content|raw }}*/
/*             </article>*/
/* {% endautoescape %}*/
/* {% if footer != false %}*/
/*             <footer class="{% if footerClass != false %}{{ footerClass  }}{% else %}source white{% endif %}">*/
/*                 {{ footer }}*/
/*             </footer>*/
/* {% endif %}*/
/*         </slide>*/
/* */

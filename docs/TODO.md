`assets\styles\bootstrap`
@import '~bootstrap/scss/functions';
@import '~bootstrap/scss/mixins';

@import '~@grinway/web-app-bundle/styles/bootstrap/functions';
@import '~@grinway/web-app-bundle/styles/bootstrap/mixin';
@import '~@grinway/web-app-bundle/styles/bootstrap/variables';

@import '~bootstrap/scss/variables';
@import '~@grinway/web-app-bundle/styles/bootstrap/generate';
@import '~bootstrap/scss/maps';

@import '~bootstrap/scss/utilities';
@import '~@grinway/web-app-bundle/styles/bootstrap/utilities';

@import '~bootstrap';
@import '~@grinway/web-app-bundle/styles/bootstrap/svg';


`<twig:grinway:Flash />`
`<twig:grinway:Alert />`

{{ stimulus_controller('grinway-web-app-transition') }}

dist\stimulus-use\useTransition.js

`grinway--copy`


TODO: BUNDLE_ALIAS:sitemap:generate -f 'xml' //default -t 'public' //default_rel_path

container->get('router')->getRouteCollection()

url is [
loc
lastmod
changefreq
priority
]

template
<?xml version="1.0" encoding="UTF-8"?>
<urlset
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    {% for url in urls %}
        <url>
            {% if url.loc|replace({hostname:''}) == url.loc %}
                <loc>{{ hostname }}{{ url.loc }}</loc>
            {% else %}
                <loc>{{ url.loc }}</loc>
            {% endif %}
            {% if url.lastmod is defined %}
                <lastmod>{{ url.lastmod }}</lastmod>
            {% endif %}
            {% if url.changefreq is defined %}
                <changefreq>{{ url.changefreq }}</changefreq>
            {% endif %}
            {% if url.priority is defined %}
                <priority>{{ url.priority }}</priority>
            {% endif %}
        </url>
    {% endfor %}
</urlset>


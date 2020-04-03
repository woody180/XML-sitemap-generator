# How to use
Set options and generate sitemap.xml file

```
XMLSitemap::set([
    "pages" => [
        "fie" => "fie",
        "fie1" => "fie1",
        "fie2" => "fie2",
    ],
    "priority" => "0.8",
    "changefreq" => "monthly"
]);

XMLSitemap::generate();
```

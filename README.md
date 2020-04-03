# How to use
Set options and generate sitemap.xml file

```
XMLSitemap::set([
    "pages" => [
        "https://sitename/page1",
        "https://sitename/page2",
        "https://sitename/page3",
    ],
    "priority" => "0.8",
    "changefreq" => "monthly",
    "dir" => "custom/directory"
]);

XMLSitemap::generate();
```

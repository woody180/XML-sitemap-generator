<?php

/* 
How to use
XMLSitemap::set([
    "pages" => [
        "fie" => "fie",
        "fie1" => "fie1",
        "fie2" => "fie2",
    ],
    "priority" => "0.8",
    "changefreq" => "monthly"
]);
*/

class XMLSitemap {
    protected static $options = array(
        "pages" => NULL,
        "dir" => NULL,
        "changefreq" => NULL,
        "priority" => NULL
    );


    // Setup options
    public static function set($args = []) {
        self::$options["pages"] = $args["pages"] ?? NULL;
        self::$options["dir"] = $args["dir"] ?? dirname(dirname(__DIR__))."/public";
        self::$options["changefreq"] = $args["changefreq"] ?? NULL;
        self::$options["priority"] = $args["priority"] ?? NULL;

        if (!is_dir(self::$options["dir"])) die('There is no such directory - '.self::$options["dir"]);

        if (!file_exists(self::$options["dir"]."/sitemap.xml")) {
            $sitemapStr = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>';
            file_put_contents(self::$options["dir"]."/sitemap.xml", $sitemapStr);
        }
    }

    
    // Get options
    public static function get() {
        return self::$options;
    }


    // Generate sitemap
    public static function generate() {
        
        // Load sitemap
        $xml = simplexml_load_file(self::$options["dir"]."/sitemap.xml");
        
        // Import data
        foreach (self::$options["pages"] as $url) {
            $str = "
            <loc>$url</loc>
            <lastmod>".date('Y-m-d')."</lastmod>";

            if (self::$options["changefreq"])   $str .= "<changefreq>".self::$options["changefreq"]."</changefreq>";
            if (self::$options["priority"])     $str .= "<priority>".self::$options["priority"]."</priority>";

            $xml->addChild("url", htmlspecialchars($str));
        }

        // Clean sitemap tags
        $sitemap = html_entity_decode ($xml->asXML(), ENT_COMPAT | ENT_HTML401, "UTF-8");
        
        // Save sitemap
        file_put_contents(self::$options["dir"]."/sitemap.xml", $sitemap);
    }

}

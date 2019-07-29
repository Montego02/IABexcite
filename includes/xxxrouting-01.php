<?php

/*
  SEO LINK HANDLING
  0. Route New SEO links
  1. try to find REQUEST_URI in #_menu, if so: show corresponding category or article
  3. else try to find it in #_content (that has no menu entry) before category because its more specific and otherwise articles which are
 *         in a subcategory will not be shown but category instead
  2. else look up REQUEST_URI in #_categories


  4. if URI was index.php check that its not in the old format or reformat it
 */


$uri = $_SERVER['REQUEST_URI'];
$path = explode("/", $uri);

// only route if there is a path at all
if ($path[1]) {


// ==================================================
// 0. NEW seo links routing
//------------
// programmierer/stadt/enttitle
// 


    if ($path[1] == "programmierer") {

        $_SESSION['com'] = 'verzeichnis';
        if ($path[2]) {
            $_SESSION['view'] = 'city';
        } else {
            $_SESSION['view'] = 'start';
        }
        if ($path[3]) {
            $_SESSION['view'] = 'detail';
        }
        //die( $_SESSION['view']);
    } else {


        // EXAMPLEX link content item
        //app-news/16-events/573-app-art-award-zkm-karlsruhe
        
//print_r($path);
// if request does not start with "index" we have a seo link 
        if (substr($path[1], 0, 5) !== "index") {

            // ==================================================
            // 1. search for title in #_menu
            // menu links always have only one level (REALLY??), so only search in Menu, if path has only one folder (depth)
            //      if (count($path) <= 2) {
            $db = IabDB::getInstance();
            $query = $db->query("SELECT * FROM j25f_menu WHERE alias LIKE '%" . $path[1] . "%'");
            $item = $query->fetch_object();

            if ($item) {
                $query_str = parse_url($item->link, PHP_URL_QUERY);
                parse_str($query_str, $params); // save parameter elements of URI 
                $_SESSION['debug'] .= "MENU Link found: " . implode(" - ", $params) . "<br>";
//            foreach ($params as $key => $value) {
//                $_SESSION[$key] = $value;
//            }
                // handling for Menu content links
                if ($params['option'] == "com_content") {
                    //  $com = "content"; // turn joomla options into exicte
                    $url = "t=".$item->alias."&";
                    $url .= "com=content&";
                    if ($params['view'] == "article") {
                        $url .= "view=detail&";
                        //$_SESSION['view'] = "detail";
                    } else {
                        //$_SESSION['view'] = 'category';
                        $url .= "view=category&";
                    }

                    
                } else {
                    $url = "com=";
                    $url .= str_replace("com_", "", $params['option']) . "&"; // remove joomla "com_" and transform it into blank [component] name
                    $url .= "view=" . str_replace("-", "",$params['layout']) . "&";
                }

                
                if ($params['id']) {
                    $url .="id=" . $params['id'];
                }




                $_SESSION['debug'] .= 'routing: menu link (1)';
                reroute($url);
            }
            //      }
            // ==================================================
            // 3. #_content
            // take last path-elemt (which could be content title)
            // we GUESS its a content-item if length is more than 26 digits (longest category name is 25 digits)

            $lastPathElementNum = count($path) - 1; // 0 based...       
            //   if (strlen($path[$lastPathElementNum]) >= 26 || $lastPathElementNum > 3) {
            $arrTitle = explode("-", $path[$lastPathElementNum]);
            // check if first title element is number and remove that (because we dont have the ids in the alias)
            if (is_numeric($arrTitle[0])) {
                $id = $arrTitle[0];
                // echo "<br>#_content search for: ". implode('-', $arrTitle);
                $db = IabDB::getInstance();
                $query = $db->query("SELECT * FROM j25f_content WHERE id = '" . $id . "'");
                $contentItem = $query->fetch_object();

                if ($contentItem) {
//            $com = "content";
//            $_SESSION['id'] = extractId($contentItem->id);
//            $_SESSION['view'] = 'detail';
//            $_SESSION['debug'] = 'routing: content->detail(3)';
                    $url = "t=" . $contentItem->alias;
                    $url .= "&com=content&";
                    $url .= "view=detail&";
                    $url .= "id=" . $contentItem->id;
                    $_SESSION['debug'] .= 'routing: content link (3)';
                    reroute($url);
                }
            }
            //  }
            // ==================================================
            // 2. if no item, search in CATEGORIES

            $catid = extractId($path[2]); // categories are linked by joomla in format: [id]-[alias] -> so extract id

            if ($catid) {
                $db = IabDB::getInstance();
                $query = $db->query("SELECT id, alias FROM j25f_categories WHERE id = '" . $catid . "'");
                $item = $query->fetch_object();

                if ($item) {
                    $url = "t=" . $item->alias;
                    $url .= "&com=content&";
                    $url .= "view=category&";
                    $url .= "id=" . $item->id;
                    $_SESSION['debug'] .= 'routing: category link (2)';
                    reroute($url);
                }
            }
        } else {
            // =====================================================================
            // 4. if URL has index.php still check, that its not in old joomla style
            $query_str = parse_url($uri, PHP_URL_QUERY);
            parse_str($query_str, $params);


            if ($params['option'] == "com_content") {

                $url = "t=" . extractAlias($params['id']);
                $url .= "&com=content&";
                $_SESSION['debug'] .= 'routing: joomla link reroute(4)';
                //$com = "content";
                // $_SESSION['com'] = "content"; // turn joomla options into exicte      

                if ($params['view'] == "article") {
                    $url .= "view=detail&";
                } else {
                    $url .= "view=category&";
                }

                $url .= "id=" . extractId($params['id']);

                reroute($url);
            }
        }
    }
} // 



/*
function reroute($url) {
    // FINALLY !
    // redirect if sef link or joomla link was found
    header('Location: /index.php?' . $url, TRUE, 301);
    exit();
}

 */

// get rid of ":" parameter after id
function extractId($id) {
    if (substr_count($id, "-") > 0) {
        $needle = "-";
    } else {
        $needle = ":";
    }
    $id = explode($needle, $id);
    // . "&t=".$id[1]
    return $id[0];
}

function extractAlias($id) {
    $id = explode(":", $id);
    return $id[1];
}

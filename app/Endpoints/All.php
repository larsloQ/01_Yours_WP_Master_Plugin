<?php
namespace Yours\Plugin\Endpoints;

use Yours\Plugin\Plugin;

class All extends Plugin
{

    public function __construct()
    {
        add_action('rest_api_init', array($this, 'yours_register_rest_routes'));
    }

    // Register our routes.

    public function yours_register_rest_routes()
    {
        // Endpoint available at {WPURL/TAXNAME/TERM_IDs,Comma Separeted
        register_rest_route("/yours/maps", "/tax/(?P<tax>[a-zA-Z0-9-]+)/(?P<term_ids>[0-9,]+)", array(
            // Here we register the readable endpoint for collections.
            'methods'             => 'GET',
            'args'                => array(
                'tax'      => array(
                    'validate_callback' => function ($param, $request, $key) {
                        return is_string($param);
                    },
                ),
                'term_ids' => array(
                    'validate_callback' => function ($param, $request, $key) {
                        $more = explode(",", $param);
                        foreach ($more as $m) {
                            if (!is_numeric($m)) {
                                return false;
                            }
                        }
                    },
                ),
            ),
            'callback'            => array($this, "items_via_tax"),
            'permission_callback' => function () {return true;},
            // Register our schema callback.
            // 'schema' => array( $this, 'get_item_schema' ),
        ));
        /*
         * via contenttype
         */
        register_rest_route("/yours/maps", "/ct/(?P<ct>[a-zA-Z0-9-,]+)", array(
            // Here we register the readable endpoint for collections.
            'methods'             => 'GET',
            'args'                => array(
                'ct' => array(
                    'validate_callback' => function ($param, $request, $key) {
                        $more = explode(",", $param);
                        foreach ($more as $m) {
                            if (!is_string($m)) {
                                return false;
                            }
                        }
                    },
                ),
            ),
            // 'callback'  => array( $this, 'get_items' ),
            'callback'            => array($this, "items_via_ct"),
            // 'permission_callback' => array( $this, 'get_items_permissions_check' ),
            'permission_callback' => function () {return true;},
            // Register our schema callback.
            // 'schema' => array( $this, 'get_item_schema' ),
        ));
    }

    public static $relevantTaxes = [
        "macro-region",
        "language",
        "casestudy-type",
        "thema",
        "country",
        "partner-type",
        "for-maps-only",
    ];

    public static function populateMapData($posts)
    {
        $data  = [];
        $index = 0;
        foreach ($posts as $post) {
            $index++;
            $meta      = get_post_meta($post->ID);
            $is_active = $meta['map_active'];
            $num       = isset($meta['casestudy_number']) ? $meta['casestudy_number'] : 0;

            /* only the once which have map acitve */
            if (is_array($is_active) && $is_active[0] == "on") {
                $allTax = [];
                foreach (self::$relevantTaxes as $t) {
                    $terms = get_the_terms($post->ID, $t);
                    if ($terms){

                        foreach ($terms as $te) {
                            $allTax[$t][] = [$te->name, $te->slug];
                        }
                    }
                }
                $loc  = $meta['location'];
                $link = get_permalink($post->ID);
                if (isset($meta['nolink']) && $meta['nolink'][0] == "on") {
                    $link = "";
                }
                $loca = [];
                if (!empty($loc)) {
                    $loca   = unserialize($loc[0]);
                    $data[] = array(
                        // "date" => $date,
                        "id"             => $post->ID,
                        "title"          => $post->post_title,
                        "post_type"      => $post->post_type,
                        "location"       => $loca,
                        "content"        => $meta['pin_desc'][0],
                        // "num" => $num,
                        "link"           => $link,
                        "external_link"  => $meta['url'][0],
                        "tax"            => $allTax,
                        "macro-region"   => isset($terms[0]->slug) ? $terms[0]->slug : "",
                        // "number" => $index,
                        "number"         => $num,
                        "contact_person" => $meta['contact_person'][0],
                        "contact_mail"   => $meta['contact_mail'][0],
                    );
                }
            }
        }
        /* sort by num */
        $typeSortOrder = ['partner' => [], 'team' => [], 'casestudy' => [], 'contribute' => []];
        // use reverse order than wanted here, 
        // $typeSortOrder = array_reverse(['partner' => [], 'team' => [], 'casestudy' => [], 'contribute' => []]);
        $fpt           = $data[0]['post_type'];
     
        /* ordering by numnber and post_type is not working need to split first*/
        /* this is a simple order by posttype based on the array above */
            // usort($type, function ($a, $b) use ($typeSortOrder) {
            //     $k1 = array_search($a['post_type'], $typeSortOrder);
            //     $k2 = array_search($b['post_type'], $typeSortOrder);
            //     return $k1 <=> $k2;
            // });
        
        $allsame = true;
        // adding them to corresponding type sort order
        foreach ($data as $item) {
            $typeSortOrder[$item['post_type']][] = $item;
            if ($item['post_type'] !== $fpt) {
                $allsame = false;
            }
        }
        // having only one "type", api call example
        //http://larslo.larslo/liaison/wp-json/yours/maps/ct/team
        if ($allsame) {
             usort($data, function($a, $b) {
                return $a['number'] <=> $b['number'];
            });
             return $data;
        }



        // having more than  one "type" 
        // http://larslo.larslo/liaison/wp-json/yours/maps/ct/team,partner,casestudy
        foreach ($typeSortOrder as $key => $value) {
            // order by numnber
            usort($typeSortOrder[$key], function($a, $b) {
                return $a['number'] <=> $b['number'];
            });
        } 
        /* now flatten again*/
        $orderedData = [];
        foreach ($typeSortOrder as $key => $value) {
            foreach ($value as $item) {
                $orderedData[] = $item;
            }
        }       
        return $orderedData;
    }

    /*not sure which content to show above map, probably its best to add an extra field,
    to have it similar */
    public function items_via_ct($params)
    {
        $posttypes         = explode(",", $params['ct']);
        $args['post_type'] = $posttypes;
        // $args['post_type'] = ['partner'];
        $args['post_status']    = 'any'; /* attachements can not be unpublished*/
        $args['posts_per_page'] = -1;
        $loop                   = new \WP_Query($args);
        if (!$loop->have_posts()) {
            return [];
        }
        $data = $this->populateMapData($loop->posts);
        return rest_ensure_response($data);
    }

    public function items_via_tax($params)
    {
        $args                = [];
        $args['post_type']   = 'any';
        $args['post_status'] = 'publish'; /* attachements can not be unpublished*/
        // $args['post_status'] = 'publish'; /* attachements can not be unpublished*/
        $args['posts_per_page'] = -1;
        /* we need terms as an array (backend fires this query and here we have an array*/
        $terms             = is_string($params['term_ids']) ? explode(",", $params['term_ids']) : $params['term_ids'];
        /*
        also here we experience differences in wordpress versions. this might fail.. uncomment, comment, test
        uncomment the second array
        */
        $args['tax_query'] = array(
            array( 
                'taxonomy' => $params['tax'],
                'field'    => 'id', //change to name or slug if necessary
                // 'terms'    => $terms, // before (wordpress 5.4) it was a string
                'terms'     =>  explode(",",$params['term_ids'])  // since wordpress 5.4 an array is used
            ),
        );
        $loop = new \WP_Query($args);
        // return rest_ensure_response($loop);
        if (!$loop->have_posts()) {
            return [];
        }
        
        $data = $this->populateMapData($loop->posts);
        return rest_ensure_response($data);
    }

    public function get_items_permissions_check($request)
    {
        if (!current_user_can('read')) {
            return new \WP_Error('rest_forbidden', esc_html__('You cannot view the post resource.'), array('status' => $this->authorization_status_code()));
        }
        return true;
    }

    // Sets up the proper HTTP status code for authorization.
    public function authorization_status_code()
    {

        $status = 401;

        if (is_user_logged_in()) {
            $status = 403;
        }

        return $status;
    }
}

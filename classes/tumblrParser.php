<?php
/**
 * Created by PhpStorm.
 * User: shpikyliak
 * Date: 01.09.15
 * Time: 16:23
 */

namespace classes;


use Tumblr\API\Client;

class tumblrParser
{

    public function getPictures($blogName)

    {
        $dotenv = new \Dotenv\Dotenv('.');
        $dotenv->load();
        $consumer = getenv('TUMBLR_ACCESS_TOKEN');

        $client = new Client($consumer);

        try {
            $blog = $client->getBlogPosts($blogName . '.tumblr.com');
        } catch (Exception $e) {
            echo $e->getMessage('Unknown blog ', $blogName, '');
            return false;
        }

        $post = $blog->posts;
        $images = array();
        echo '<div class="container">
             <div class="row">';
        for ($i = 0; $i < count($post); $i++) {
            if (isset($post[$i]->image_permalink)) {
                ?>
                <div class="col-md-3 col-sm-4 col-xs-6 thumb">
                    <img class="img-responsive"
                         src="<?php echo($images[$i] = $post[$i]->photos[0]->original_size->url) ?>"/>
                </div>
                <?php
                $images[$i] = $post[$i]->photos[0]->original_size->url;
            }
        }
        echo '</div>
              </div> ';
        return $images;

    }

} 
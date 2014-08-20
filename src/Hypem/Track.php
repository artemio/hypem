<?php
namespace Hypem;

class Track
{
    /**
    * @var string  $mediaid          Track ID
    * @var string  $artist           Artist name
    * @var string  $title            Track title
    * @var int     $dateposted       Unix timestamp (in seconds)
    * @var int     $siteid           ID of site which posted the track last
    * @var string  $sitename         Name of site which posted the track last
    * @var string  $posturl          Remote site post URL
    * @var int     $postid           Post ID
    * @var int     $loved_count      Favorites counter
    * @var int     $posted_count     Number of sites which posted the track
    * @var string  $thumb_url        Small post image
    * @var string  $thumb_url_medium Medium post image
    * @var string  $thumb_url_large  Large post image
    * @var string  $thumb_url_artist Artist image
    * @var int     $time             Track length in seconds
    * @var string  $description      Track description from remote site
    * @var array   $tags             Track tags
    * @var string  $itunes_link      Itunes URL
    */
    public $mediaid;
    public $artist;
    public $title;
    public $dateposted;
    public $siteid;
    public $sitename;
    public $posturl;
    public $postid;
    public $loved_count;
    public $posted_count;
    public $thumb_url;
    public $thumb_url_medium;
    public $thumb_url_large;
    public $thumb_url_artist;
    public $time;
    public $description;
    public $tags;
    public $itunes_link;

    private static $path_template  = '/playlist/track/{{mediaid}}/json';

    public function __construct($props = [])
    {
        if (is_string($props)) {
            $this->mediaid = $props;
            $props = $this->getProperties();
        }

        foreach ($props as $k => $v) {
            if (property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }

    private function getProperties()
    {
        $path = strtr(self::$path_template, ['{{mediaid}}' => $this->mediaid]);
        $track = (new Request)->getJson($path);
        return empty($track) ? [] : $track[0];
    }
}

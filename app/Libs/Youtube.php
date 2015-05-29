<?php

class Youtube {

    public static function YoutubeUser($username) {
        $url = 'http://gdata.youtube.com/feeds/api/users/' . $username . '/uploads';
        return simplexml_load_file($url);
    }

    public static function showFullFeed($feed) {
        foreach ($feed->entry as $video) {
            echo '<p>';
            echo "<a href='{$video->link['href']}'>" . $video->title . '</a><br />';
            echo $video->content;
            echo '</p>';
        }
    }

    public static function showTheFirst($feed, $limit = 12) {
        $i = 0;
        while (($video = $feed->entry[$i]) && ($i++ != $limit)) {
            echo '<p>';
            echo "<a href='{$video->link['href']}'>" . $video->title . '</a><br />';
            echo $video->content;
            echo '</p>';
        }
    }

}

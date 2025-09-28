<?php
if (!function_exists('auto_embed_media')) {
    function auto_embed_media($text) {
        // Youtube
        $text = preg_replace(
            '~https?://(?:www\.)?youtube\.com/watch\?v=([a-zA-Z0-9_-]+)~',
            '<div class="ratio ratio-16x9 mb-3"><iframe src="https://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe></div>',
            $text
        );
        $text = preg_replace(
            '~https?://youtu\.be/([a-zA-Z0-9_-]+)~',
            '<div class="ratio ratio-16x9 mb-3"><iframe src="https://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe></div>',
            $text
        );
        // Vimeo
        $text = preg_replace(
            '~https?://(?:www\.)?vimeo\.com/([0-9]+)~',
            '<div class="ratio ratio-16x9 mb-3"><iframe src="https://player.vimeo.com/video/$1" frameborder="0" allowfullscreen></iframe></div>',
            $text
        );
        // Dailymotion
        $text = preg_replace(
            '~https?://(?:www\.)?dailymotion\.com/video/([a-zA-Z0-9]+)~',
            '<div class="ratio ratio-16x9 mb-3"><iframe src="https://www.dailymotion.com/embed/video/$1" frameborder="0" allowfullscreen></iframe></div>',
            $text
        );
        // Facebook Video
        $text = preg_replace(
            '~https?://(?:www\.)?facebook\.com/.*/videos/([0-9]+)~',
            '<div class="ratio ratio-16x9 mb-3"><iframe src="https://www.facebook.com/plugins/video.php?href=https://www.facebook.com/facebook/videos/$1/&show_text=0" frameborder="0" allowfullscreen></iframe></div>',
            $text
        );
        // TikTok
        $text = preg_replace(
            '~https?://(?:www\.)?tiktok\.com/@([^/]+)/video/([0-9]+)~',
            '<blockquote class="tiktok-embed" cite="https://www.tiktok.com/@$1/video/$2" data-video-id="$2" style="max-width: 605px;min-width: 325px;" > </blockquote>\n            <script async src="https://www.tiktok.com/embed.js"></script>',
            $text
        );
        // SoundCloud
        $text = preg_replace(
            '~https?://(?:www\.)?soundcloud\.com/([^/]+)/([^/\s]+)~',
            '<div class="mb-3"><iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay"\n            src="https://w.soundcloud.com/player/?url=https%3A//soundcloud.com/$1/$2&color=%230066cc&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"></iframe></div>',
            $text
        );
        // Google Drive PDF preview
        $text = preg_replace(
            '~https?://drive\.google\.com/file/d/([a-zA-Z0-9_-]+)/view\?usp=sharing~',
            '<div class="ratio ratio-16x9 mb-3"><iframe src="https://drive.google.com/file/d/$1/preview" allow="autoplay"></iframe></div>',
            $text
        );
        // PDF direct links (ending with .pdf)
        $text = preg_replace(
            '~https?://[^
]+\.pdf~',
            '<div class="ratio ratio-16x9 mb-3"><iframe src="$0#toolbar=1" style="border:0;width:100%;height:100%;" allowfullscreen></iframe></div>',
            $text
        );
        // Gambar (ending with .jpg/.png/.webp)
        $text = preg_replace(
            '~https?://[^
]+?\.(jpg|jpeg|png|webp|gif)~i',
            '<img src="$0" class="img-fluid rounded mb-3" style="max-width: 100%; height:auto;">',
            $text
        );
        // Audio (ending with .mp3/.wav/.ogg)
        $text = preg_replace(
            '~https?://[^
]+?\.(mp3|wav|ogg)~i',
            '<audio controls class="mb-3"><source src="$0"></audio>',
            $text
        );
        return $text;
    }
}
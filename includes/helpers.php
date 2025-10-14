<?php
function mapMoodToCategoryId($mood) {
    switch ($mood) {
        case 'very-happy':
            return 1;
        case 'happy':
            return 2;
        case 'neutral':
            return 3;
        case 'sad':
            return 4;
        case 'very-sad':
            return 5;
        default:
            return null;
    }
}
?>
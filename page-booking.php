<?php
/*
Template Name: Custom Booking Template
*/
get_header();

$title = get_the_title();
$description = get_the_excerpt();

?>
<div id="content">
    <h1><?php echo esc_html($title); ?></h1>
    <p><?php echo esc_html($description); ?></p>
</div>


<?php
$start_date = get_post_meta(get_the_ID(), '_start_date', true);
$end_date = get_post_meta(get_the_ID(), '_end_date', true);
$address = get_post_meta(get_the_ID(), '_address', true);

if ($start_date && $end_date) {
    echo '<p><strong>Booking Dates:</strong> ' . date('d F Y g:i A', $start_date) . ' - ' . date('d F Y g:i A', $end_date) . '</p>';
}

if ($address) {
    echo '<p><strong>Address:</strong> ' . esc_html($address) . '</p>';
}
?>



<?php get_footer();
?>

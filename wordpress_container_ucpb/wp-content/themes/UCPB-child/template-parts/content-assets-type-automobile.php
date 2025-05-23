<?php $image_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' ); // Fetch the post thumbnail?>
<style>
.container {
    width: 100%;
    margin: 0 auto;
}
.row {
    display: flex
;
    align-items: center;
    justify-content: start;
    flex-wrap: nowrap;
    gap: 20px;
    /*border-bottom: 1px solid green;*/
    /*margin: 10px 0;*/
}
.hyperlink {
    text-decoration:none;
    color: #000;
}
h3 {
    font-family: "Work-san", sans-serif;
    color: #00984b;
    font-size: 18px;
    line-height: 1.6rem;
    text-transform: uppercase;
    font-weight: 700;
    margin-bottom: 15px;
}
img {
    border-radius:10px;
}
</style>
<!--  -->
    <div class="container">
    <a class="hyperlink" href="<?php the_permalink(); ?>" class="btn">
        <div class="row">
            <div class="col"><img src="<?php echo esc_url( $image_url ); ?>" alt="<?php the_title(); ?>"></div>
            <div class="col"><h3><?php the_title(); ?></h3></div>
        </div>
    </a>
    </div>
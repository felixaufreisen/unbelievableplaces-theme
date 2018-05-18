<?php
/**
* The main template file
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package Unbelievable_Places
*/

get_header();
?>

<div class="cover" id="front-page">
  <img src="https://www.unbelievableplaces.de/design/DSC01346.jpg" alt="">
</div>

<main id="main" class="container-fluid">

  <section class="fp-wrap">
    <div class="title">
      <h2>Wer ich bin</h2>
    </div>
    <div class="aboutme row">
      <div class="desc col-lg-5">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat laboriosam dicta aperiam, expedita iusto accusantium ipsam consequuntur recusandae dignissimos cumque, mollitia voluptatem. Laboriosam sint, obcaecati facere iure eos voluptatibus in suscipit cum vel, asperiores neque! Odio ab hic voluptatum at ducimus unde, nulla maxime recusandae. Neque quis consectetur totam. Ab eveniet veritatis aut neque tempora cupiditate, fugit reiciendis, velit dolorum vero. Sunt voluptatibus temporibus, totam tenetur neque iusto, nisi cumque accusantium. Assumenda accusamus nam perferendis neque minima optio error dolore, est ea facere reiciendis illo quod. Cum suscipit fugit possimus architecto a aperiam modi quia iure. Quasi eius, ratione doloremque!
      </div>
      <div class="col-lg-6 offset-lg-1">

      </div>
    </div>
  </section>

  <section class="fp-wrap">
    <div class="title">
      <h2>Worüber ich schon geschrieben habe</h2>
    </div>
    <div class="map-wrap embed-responsive embed-responsive-16by9">
      <?php do_action( 'unbelievable_loader' ) ?>
      <?php do_action( 'get_unbelievable_map', '50.1', '8.7', '3.6' ) ?>
    </div>
  </section>

  <section class="fp-wrap">
    <div class="title">
      <h2>Reisezählwerk</h2>
    </div>
    <div class="travel-details row">
      <div class="travel-details-wrap col-12">
        <div class="travel-details-item">
          <div class="desc-wrap">
            <span class="desc">0 Kontinente</span>
          </div>
          <div class="icon"><i class="fas fa-globe"></i></div>
        </div>
        <div class="travel-details-item">
          <div class="desc-wrap">
            <span class="desc">0 Länder</span>
          </div>
          <div class="icon"><i class="fas fa-flag"></i></div>
        </div>
        <div class="travel-details-item">
          <div class="desc-wrap">
            <span class="desc">0 Tage</span>
          </div>
          <div class="icon"><i class="fas fa-calendar-alt"></i></div>
        </div>
        <div class="travel-details-item">
          <div class="desc-wrap">
            <span class="desc">0 Kilometer</span>
          </div>
          <div class="icon"><i class="fas fa-map-signs"></i></div>
        </div>
        <div class="travel-details-item">
          <div class="desc-wrap">
            <span class="desc">0 Euro</span>
          </div>
          <div class="icon"><i class="fas fa-euro-sign"></i></div>
        </div>
      </div>
    </div>
  </section>

  <section class="fp-wrap">
    <div class="title">
      <h2>Neuste Beiträge</h2>
    </div>
    <div class="fp-grid row">
      <?php
      $args = array(
        'numberposts' => '5',
        'orderby' => 'post_date',
        'post_status' => 'publish'
      );

      $recent_posts = wp_get_recent_posts( $args );

      foreach( $recent_posts as $recent ){
        $cats = get_the_category($recent["ID"]);
        $cat_name = $cats[0]->name;
        $cat_id = get_cat_ID( $cat_name ); ?>
        <article class="item-wrap">
          <div class="item">
            <div class="pic">
              <a href="<?php echo esc_url( get_permalink( $recent["ID"] )) ?>">
                <?php echo get_the_post_thumbnail( $recent["ID"], 'medium_large' ) ?>
              </a>
            </div><!-- .pic -->
            <div class="desc">
              <div class="content-meta">
                <span class="category">
                  <a href="<?php echo esc_url( get_category_link( $cat_id ) ); ?>">
                    <?php echo esc_html( $cat_name ) ?>
                  </a>
                </span>
                <time datetime="<?php echo get_the_date( 'c',  $recent["ID"] ) ?>">
                  <?php echo get_the_date( 'j F Y',  $recent["ID"] ); ?>
                </time>
              </div> <!-- .content-meta -->
              <h3>
                <a href="<?php echo esc_url( get_permalink( $recent["ID"] )) ?>">
                  <?php echo esc_html( $recent["post_title"] ) ?>
                </a>
              </h3>
            </div> <!-- .desc -->
          </div> <!-- .item -->
        </article> <!-- .item-wrap -->
        <?php
      }

      wp_reset_query();
      ?>
    </div> <!-- .fp-grid -->
  </section>
</main><!-- #main -->

<?php
get_footer();

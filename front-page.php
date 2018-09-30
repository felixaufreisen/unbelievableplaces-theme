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
  <img src="https://www.felixaufreisen.de/bilder/DSC01346.jpg" alt="Blaue Grotte auf Malta" data-pin-nopin="true">
</div>

<main id="main" class="container-fluid">

  <section class="fp-wrap">
    <div class="title">
      <h2>Was ist hier los?</h2>
    </div>
    <div class="aboutme row">
      <div class="desc col-lg-7">
        <?php
          $today = date_create("now");
          $birthday = date_create("1990-12-15");
          $myage = date_diff($today,$birthday);
        ?>
        <p>Mitte 2018 habe ich meinen ganzen Mut zusammen genommen und die bisher wahrscheinlich größte Entscheidung meines Lebens getroffen. Job und Wohnung sind zum 31.10.2018 gekündigt. Gespart habe ich in den letzten Jahren fleißig und <strong>auf geht's die Welt zu entdecken</strong>. Also so richtig! One-Way geht's am 04. November 2018 von Berlin Schönefeld über Athen nach Kairo und dann schauen wir mal. Meine Idee ist mich auf dem Landweg Richtung Süden vorzuarbeiten. Wenn es mir gefällt vielleicht bis Südafrika. Ich möchte mir Zeit nehmen Länder und Leute kennenzulernen. Couchsurfing soll dabei eine Rolle spielen. Langfristige Planungen erzeugen nur unnötigen Stress, also lasse ich das lieber gleich von Anfang an.</p>
        <p>Ach so. Wer hätte das gedacht? Mein Name ist <strong>Felix</strong>. <?php echo $myage->format("Ich bin %y Jahre alt."); ?> Und ab November 2018 bin ich <strong>auf Reisen</strong>.</p>
      </div>
      <div class="selfie col-lg-5">
        <img src="https://www.felixaufreisen.de/bilder/Selfie_Petra.jpg" class="aligncenter" alt="Selfie in Petra, Jordanien">
      </div>
    </div>
  </section>

  <section class="fp-wrap">
    <div class="title">
      <h2>Weltreise-Zählwerk</h2>
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
            <span class="desc">
               <?php
                 $today = date_create("now");
                 $startdate = date_create("2018-11-04");
                 $timetravelled = date_diff($startdate,$today);
                 echo $timetravelled->format("%r%a Tage");
               ?>
             </span>
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
      <h2>Worüber ich schon geschrieben habe</h2>
    </div>
    <div class="map-wrap embed-responsive embed-responsive-16by9">
      <?php do_action( 'unbelievable_loader' ) ?>
      <?php do_action( 'get_unbelievable_map', '50.1', '8.7', '3.6' ) ?>
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

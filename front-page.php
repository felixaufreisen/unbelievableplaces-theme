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
  <img src="https://www.felixaufreisen.de/images/DSC01346.jpg" alt="Blaue Grotte auf Malta" data-pin-nopin="true">
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
        <img src="https://www.felixaufreisen.de/images/Selfie_Petra.jpg" class="aligncenter" alt="Selfie in Petra, Jordanien">
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
            <span class="desc">2 Kontinente</span>
          </div>
          <div class="icon">
            <svg class="svg-inline--fa fa-globe fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="globe" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
              <path fill="currentColor" d="M336.5 160C322 70.7 287.8 8 248 8s-74 62.7-88.5 152h177zM152 256c0 22.2 1.2 43.5 3.3 64h185.3c2.1-20.5 3.3-41.8 3.3-64s-1.2-43.5-3.3-64H155.3c-2.1 20.5-3.3 41.8-3.3 64zm324.7-96c-28.6-67.9-86.5-120.4-158-141.6 24.4 33.8 41.2 84.7 50 141.6h108zM177.2 18.4C105.8 39.6 47.8 92.1 19.3 160h108c8.7-56.9 25.5-107.8 49.9-141.6zM487.4 192H372.7c2.1 21 3.3 42.5 3.3 64s-1.2 43-3.3 64h114.6c5.5-20.5 8.6-41.8 8.6-64s-3.1-43.5-8.5-64zM120 256c0-21.5 1.2-43 3.3-64H8.6C3.2 212.5 0 233.8 0 256s3.2 43.5 8.6 64h114.6c-2-21-3.2-42.5-3.2-64zm39.5 96c14.5 89.3 48.7 152 88.5 152s74-62.7 88.5-152h-177zm159.3 141.6c71.4-21.2 129.4-73.7 158-141.6h-108c-8.8 56.9-25.6 107.8-50 141.6zM19.3 352c28.6 67.9 86.5 120.4 158 141.6-24.4-33.8-41.2-84.7-50-141.6h-108z"></path>
            </svg>
          </div>
        </div>
        <div class="travel-details-item">
          <div class="desc-wrap">
            <span class="desc">8 Länder</span>
          </div>
          <div class="icon">
            <svg class="svg-inline--fa fa-flag fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="flag" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
              <path fill="currentColor" d="M349.565 98.783C295.978 98.783 251.721 64 184.348 64c-24.955 0-47.309 4.384-68.045 12.013a55.947 55.947 0 0 0 3.586-23.562C118.117 24.015 94.806 1.206 66.338.048 34.345-1.254 8 24.296 8 56c0 19.026 9.497 35.825 24 45.945V488c0 13.255 10.745 24 24 24h16c13.255 0 24-10.745 24-24v-94.4c28.311-12.064 63.582-22.122 114.435-22.122 53.588 0 97.844 34.783 165.217 34.783 48.169 0 86.667-16.294 122.505-40.858C506.84 359.452 512 349.571 512 339.045v-243.1c0-23.393-24.269-38.87-45.485-29.016-34.338 15.948-76.454 31.854-116.95 31.854z"></path>
            </svg>
          </div>
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
          <div class="icon">
            <svg class="svg-inline--fa fa-calendar-alt fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="calendar-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
              <path fill="currentColor" d="M436 160H12c-6.6 0-12-5.4-12-12v-36c0-26.5 21.5-48 48-48h48V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h128V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h48c26.5 0 48 21.5 48 48v36c0 6.6-5.4 12-12 12zM12 192h424c6.6 0 12 5.4 12 12v260c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V204c0-6.6 5.4-12 12-12zm116 204c0-6.6-5.4-12-12-12H76c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm0-128c0-6.6-5.4-12-12-12H76c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm128 128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm0-128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm128 128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40zm0-128c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-40z"></path>
            </svg>
          </div>
        </div>
        <div class="travel-details-item">
          <div class="desc-wrap">
            <span class="desc">5300 Kilometer</span>
          </div>
          <div class="icon">
            <svg class="svg-inline--fa fa-map-signs fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="map-signs" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
              <path fill="currentColor" d="M507.31 84.69L464 41.37c-6-6-14.14-9.37-22.63-9.37H288V16c0-8.84-7.16-16-16-16h-32c-8.84 0-16 7.16-16 16v16H56c-13.25 0-24 10.75-24 24v80c0 13.25 10.75 24 24 24h385.37c8.49 0 16.62-3.37 22.63-9.37l43.31-43.31c6.25-6.26 6.25-16.38 0-22.63zM224 496c0 8.84 7.16 16 16 16h32c8.84 0 16-7.16 16-16V384h-64v112zm232-272H288v-32h-64v32H70.63c-8.49 0-16.62 3.37-22.63 9.37L4.69 276.69c-6.25 6.25-6.25 16.38 0 22.63L48 342.63c6 6 14.14 9.37 22.63 9.37H456c13.25 0 24-10.75 24-24v-80c0-13.25-10.75-24-24-24z"></path>
            </svg>
          </div>
        </div>
        <div class="travel-details-item">
          <div class="desc-wrap">
            <span class="desc">4539 Euro</span>
          </div>
          <div class="icon">
            <svg class="svg-inline--fa fa-euro-sign fa-w-10" aria-hidden="true" data-prefix="fas" data-icon="euro-sign" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
              <path fill="currentColor" d="M310.706 413.765c-1.314-6.63-7.835-10.872-14.424-9.369-10.692 2.439-27.422 5.413-45.426 5.413-56.763 0-101.929-34.79-121.461-85.449h113.689a12 12 0 0 0 11.708-9.369l6.373-28.36c1.686-7.502-4.019-14.631-11.708-14.631H115.22c-1.21-14.328-1.414-28.287.137-42.245H261.95a12 12 0 0 0 11.723-9.434l6.512-29.755c1.638-7.484-4.061-14.566-11.723-14.566H130.184c20.633-44.991 62.69-75.03 117.619-75.03 14.486 0 28.564 2.25 37.851 4.145 6.216 1.268 12.347-2.498 14.002-8.623l11.991-44.368c1.822-6.741-2.465-13.616-9.326-14.917C290.217 34.912 270.71 32 249.635 32 152.451 32 74.03 92.252 45.075 176H12c-6.627 0-12 5.373-12 12v29.755c0 6.627 5.373 12 12 12h21.569c-1.009 13.607-1.181 29.287-.181 42.245H12c-6.627 0-12 5.373-12 12v28.36c0 6.627 5.373 12 12 12h30.114C67.139 414.692 145.264 480 249.635 480c26.301 0 48.562-4.544 61.101-7.788 6.167-1.595 10.027-7.708 8.788-13.957l-8.818-44.49z"></path>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="fp-wrap d-none d-md-block">
    <div class="title">
      <h2>Worüber ich schon geschrieben habe</h2>
    </div>
    <div class="map-wrap embed-responsive embed-responsive-16by9">
      <?php do_action( 'unbelievable_loader' ) ?>
      <?php do_action( 'get_unbelievable_map', '3.6' ) ?>
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

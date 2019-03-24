<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package boylerplate
 */
?>
        </main><!-- main .site-main -->

        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="site-info">
            <?php echo data_copyright(); ?>
            </div><!-- .site-info -->
        </footer><!-- #colophon .site-footer -->

<?php wp_footer(); ?>

<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>

    </body>
</html>
<?php
/**
 * @package antonia
 */
?>
	</div><!-- .site-content -->
	<footer class="site-footer" role="contentinfo">
		<div>
			Site designed by <a href="http://nevskiy.com" rel="designer">Nevskiy</a>
		</div><!-- .site-info -->
	</footer>
</div><!-- .site -->
<?php wp_footer(); ?>
<!-- Safely using .ready() before including jQuery -->
<!-- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/ -->
<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
</body>
</html>
<?php
/**
 * Template Name: Colors
 * 
 * The Template for the Colors page
 *
 * This page uses a template becuase there is custom markup to display the 
 * colors in a nice way. Try to avoid using too many template pages to create 
 * the generic style guide.
 *
 */

get_header(); ?>

	<div id="primary" class="site-content">
	<?php get_sidebar(); ?>
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

			<!-- Call The Title -->
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<!-- Introduction -->
			<p>InterNations has a very specific color pallet, It conveys the idea of formal, professional and secure. While not alienating any of our members. There are a number of different colors that we use, here are some guidelines on the actual color values and how the colors should be used.</p>
				<hr>

				<!-- The Primary Brand Colors -->
				<h3>Brand Colors</h3>
				<p>Our brand colors must be used to convey the actual brand accurately online and in print.<p/>

				<div class="brand-colors">

					<div class="color">
						<div class="colorbox inblue">
							<ul>
								<li><span class="color-name">InterNations Blue</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
							<div class="colorbox inbluegrad"></div>
					</div>

					<div class="color">
						<div class="colorbox inyellow">
							<ul>
								<li><span class="color-name">Yellow</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
							<div class="colorbox inyellowgrad"></div>
					</div>

					<div class="color">
						<div class="colorbox inlightblue">
							<ul>
								<li><span class="color-name">Light Blue</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
							<div class="colorbox inlightbluegrad"></div>
					</div>

				</div> <!-- End Primary Brand Colors -->

				<hr>

				<!-- Interface Colors -->

				<h3>Interface & Label Colors</h3>
				<p>Interface & label colors are only be used online, while they have other values, these are for reference for when we do want to use them offline. They are primarily used for the labels in the Wire and My Calendar, however they may be used together else where when referring to these sections of the site. The "Other" or Gray, is used in the footer.</p>

				<div class="secondary-colors">

					<div class="color">
						<div class="colorbox inevent">
							<ul>
								<li><span class="color-name">Events</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
					</div>

					<div class="color">
						<div class="colorbox inactivity">
							<ul>
								<li><span class="color-name">Activities</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
					</div>

					<div class="color">
						<div class="colorbox inother">
							<ul>
								<li><span class="color-name">Other</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
					</div>
					<div class="color">
						<div class="colorbox inadvertising">
							<ul>
								<li><span class="color-name">Avertising</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
					</div>
				</div> <!-- End Interface Colors -->

				<hr>

				<!-- Alert Colors -->

				<h3>Alert Colors</h3>
				<p>Currnetly we only use one type of alert color, the yellow color below. We should make these contextual, and give each alert more prominance. here are the other colours we should use.</p>

				<div class="secondary-colors">

					<div class="color">
						<div class="colorbox ininfo radius3">
							<ul>
								<li><span class="color-name">Info</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
					</div>

					<div class="color">
						<div class="colorbox inalert radius3">
							<ul>
								<li><span class="color-name">Alert</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
					</div>

					<div class="color">
						<div class="colorbox insuccess radius3">
							<ul>
								<li><span class="color-name">Success</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
					</div>
					<div class="color">
						<div class="colorbox inwarning radius3">
							<ul>
								<li><span class="color-name">Warning</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
					</div>
				</div> <!-- End Alert Colors -->
				<hr>
				<h3>Buttons</h3>
				<p>Button colors have a strict hierarchy, while the InterNations platform might not currnetly follow this heirarcy, we are working towards creating a consistant experience here.</p>
				
				<div class="button-colors">

					<div class="color">
						<div class="colorbox btn-darkblue">
							<ul>
								<li><span class="color-name">Primary Action</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
					</div>

					<div class="color">
						<div class="colorbox btn-lightblue">
							<ul>
								<li><span class="color-name">Secondary Action</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
					</div>

					<div class="color">
						<div class="colorbox btn-gray">
							<ul>
								<li><span class="color-name">Cancel / Back</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
					</div>
					<div class="color">
						<div class="colorbox btn-red">
							<ul>
								<li><span class="color-name">Call To action</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
					</div>
					<div class="color">
						<div class="colorbox btn-green">
							<ul>
								<li><span class="color-name">Call To action</span></li>
								<li><label>Pantone</label>#000000</li>
								<li><label>CMYK</label>#000000</li>
								<li><label>RGB</label>#000000</li>
								<li><label>HTML</label>#000000</li>
							</ul>
						</div>
					</div>
				</div> <!-- End Supporting Colors -->


				<ul>
					<li>CTA Green:</li>
					<li>Primary Dark Blue (used for the main call to action on a page)</li>
					<li>Secondary Light Blue (used for all other econdary actions on a page)</li>
					<li>Tertiary Gray (usually used for cancel or third level actions on a page, such as member search)</li>
					<li>CTA Green: (To be specified, but should be used to do mark the completion of a funnel, e.g. Upgrading.)</li>
				</ul>


			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
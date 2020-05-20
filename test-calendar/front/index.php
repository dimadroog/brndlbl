<div id="script-warning">
	<code>php/get-events.php</code> must be running.
</div>

<div id="loading">loading...</div>

<div id="calendar" data-jsonurl="<?php echo plugin_dir_url( __FILE__ ) ?>/lib/fullcalendar/"></div>

<div class="scroll-to">
	<div class="event-details" style="display: none;">
		<h2><?php echo __('Event Details', 'test_calendar') ?>:</h2>
		<ul>
			<li> <strong><?php echo __('Event Title', 'test_calendar') ?></strong> - <span class="event-details__title"></span></li>
			<li> <strong><?php echo __('Event Date', 'test_calendar') ?></strong> - <span class="event-details__date"></span></li>
			<li> <strong><?php echo __('Country', 'test_calendar') ?></strong> - <span class="event-details__country"></span></li>
			<li> <strong><?php echo __('City', 'test_calendar') ?></strong> - <span class="event-details__city"></span></li>
			<li> <strong><?php echo __('Category', 'test_calendar') ?></strong> - <span class="event-details__category"></span></li>
			<li><a target="_blank" href="#" class="event-details__link"><?php echo __('View Event', 'test_calendar') ?></a></li>
		</ul>	
	</div>
</div>


<div class="event-categories">
	<h2><?php echo __('All Categories', 'test_calendar') ?>:</h2>	
	<?php $tax_terms = get_terms('tc_categories', array('hide_empty' => false)); ?>
	<ul>
		<?php foreach ($tax_terms as $term_single): ?>
			<li>	
				<a href="<?php echo get_term_link( $term_single ) ?>">
					<?php echo $term_single->name; ?>
				</a>
			</li>
		<?php endforeach ?>
	</ul>
</div>
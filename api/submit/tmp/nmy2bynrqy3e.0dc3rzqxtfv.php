<taconite>

	<eval>
		search_reset();
		$( "#autocomplete-ajax" ).val('<?php echo $searchvalue; ?>');
		$( "#searchvalue" ).html('<?php echo $searchvalue; ?>');
		$( "#str_status_msg" ).html('<?php echo $str_status_msg; ?>');
	</eval>

	<?php if ($str_suppliers !=false OR
					$str_prime_definition != false OR
					$str_prime_examples != false OR
					$str_related_items != false OR
					$str_linked_items != false OR
					$str_collective_items != false): ?>
		<show select="#tabbed_content" />
		<?php else: ?><hide select="#tabbed_content" />
	<?php endif; ?>

	<?php if ($str_suppliers_head != false): ?>
		
			<replaceContent select="#str_suppliers_head">
				<?php echo $str_suppliers_head; ?>
			</replaceContent>
		
	<?php endif; ?>

	<?php if ($str_suppliers != false): ?>
		
			<!--replaceContent select="#main-tab-title"><?php echo $str_search_field; ?></replaceContent-->
			<show select="#str_suppliers_tab"/>
			<replaceContent select="#str_suppliers">
				<?php echo $str_suppliers; ?>
			</replaceContent>
		
		<?php else: ?>
			<hide select="#str_suppliers_tab" />
		
	<?php endif; ?>

	<?php if ($str_prime_definition != false): ?>
		
			<show select="#str_prime_definition_tab" />
			<replaceContent select="#str_prime_definition">
				<p><strong>Definition: </strong><?php echo $str_prime_definition; ?></p><p><strong>Example Usage: </strong><?php echo $str_prime_examples; ?></p>
			</replaceContent>
		
		<?php else: ?>
			<hide select="#str_prime_definition_tab" />
		
	<?php endif; ?>

	<?php if ($str_related_items != false): ?>
		
			<show select="#str_related_items_tab" />
			<replaceContent select="#str_related_items">
				<p><?php echo $str_related_items; ?></p>
			</replaceContent>
		
		<?php else: ?>
			<hide select="#str_related_items_tab" />
		
	<?php endif; ?>

	<?php if ($str_linked_items != false): ?>
		
			<show select="#str_linked_items_tab" />
			<replaceContent select="#str_linked_items">
				<p><?php echo $str_linked_items; ?></p>
			</replaceContent>
		
		<?php else: ?>
			<hide select="#str_linked_items_tab" />
		
	<?php endif; ?>

	<?php if ($str_collective_items != false): ?>
		
			<show select="#str_collective_items_tab" />
			<replaceContent select="#str_collective_items">
				<p><?php echo $str_collective_items; ?></p>
			</replaceContent>
		
		<?php else: ?>
			<hide select="#str_collective_items_tab" />
		
	<?php endif; ?>

	<?php if ($str_nicknames != false): ?>
		
			<show select="#str_nicknames_tab" />
			<replaceContent select="#str_nicknames">
				<p><?php echo $str_nicknames; ?></p>
			</replaceContent>
		
		<?php else: ?>
			<hide select="#str_nicknames_tab" />
		
	<?php endif; ?>

	<eval>
		convert_links_to_ajax();
		readmore_init();
	</eval>

</taconite>



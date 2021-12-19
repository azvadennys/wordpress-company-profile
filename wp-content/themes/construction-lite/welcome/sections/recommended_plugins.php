<?php
	wp_enqueue_style( 'plugin-install' );
	wp_enqueue_script( 'plugin-install' );
	wp_enqueue_script( 'updates' );
	$free_plugins = $this->free_plugins;
	$pro_plugins = $this->pro_plugins;

	if(!empty($pro_plugins)) {
		?>
		<h4 class="recomplug-title"><?php echo esc_html__('Pro Plugins', 'construction-lite'); ?></h4>
		<p><?php echo esc_html__('Take Advantage of some of our Premium Plugins', 'construction-lite'); ?></p>
		<div class="recomended-plugin-wrap clearfix">
		<?php
		foreach($pro_plugins as $plugin) {

			$status = $this->construction_lite_plugin_active($plugin);
			$icon_url = $plugin['screenshot'];
			switch($status) {
				case 'install' :
					$btn_class = 'install-offline button';
					$label = __('Install and Activate', 'construction-lite');
					$link = $plugin['location'];
					break;

				case 'inactive' :
					$btn_class = 'button';
					$label = __('Deactivate', 'construction-lite');
					$link = admin_url('plugins.php');
					break;

				case 'active' :
					$btn_class = 'activate-offline button button-primary';
					$label = __('Activate', 'construction-lite');
					$link = $plugin['location'];
					break;
			}

			?>
				<div class="recom-plugin-wrap">
					<div class="plugin-img-wrap">
						<img src="<?php echo esc_url($icon_url); ?>" />
						<div class="version-author-info">
							<span class="version"><?php printf('Version %s', esc_html($plugin['version'])); ?></span>
							<span class="seperator">|</span>
							<span class="author"><?php echo esc_html($plugin['author']); ?></span>
						</div>
					</div>
					<div class="plugin-title-install clearfix">
						<span class="title" title="<?php echo esc_attr($plugin['name']); ?>">
							<?php echo esc_html($plugin['name']); ?>
						</span>

						<span class="plugin-btn-wrapper plugin-card-<?php echo esc_attr($plugin['slug']); ?>">
							<a class="<?php echo esc_attr($btn_class); ?>" data-file="<?php echo esc_attr($plugin['slug']).'/'.esc_attr($plugin['filename']); ?>" data-slug="<?php echo esc_attr($plugin['slug']); ?>" href="<?php echo esc_html($link); ?>"><?php echo esc_html($label); ?></a>
						</span>
					</div>
				</div>
			<?php
		} ?>
		</div>
	<?php
	}

	if(!empty($free_plugins)) {
		?>
		<h4 class="recomplug-title"><?php echo esc_html__('Free Plugins', 'construction-lite'); ?></h4>
		<p><?php echo esc_html__('These Free Plugins might be handy for you.', 'construction-lite'); ?></p>
		<div class="recomended-plugin-wrap">
		<?php
		foreach($free_plugins as $plugin) {
			$info = $this->construction_lite_call_plugin_api($plugin['slug']);

			$icon_url = $this->construction_lite_check_for_icon($info->icons);
			$status = $this->construction_lite_plugin_active($plugin);
			$btn_url = $this->construction_lite_plugin_generate_url($status, $plugin);

			switch($status) {
				case 'install' :
					$btn_class = 'install button';
					$label = esc_html__('Install and Activate', 'construction-lite');
					break;

				case 'inactive' :
					$btn_class = 'button';
					$label = esc_html__('Deactivate', 'construction-lite');
					break;

				case 'active' :
					$btn_class = 'activate button button-primary';
					$label = esc_html__('Activate', 'construction-lite');
					break;
			}

			?>
				<div class="recom-plugin-wrap">
					<div class="plugin-img-wrap">
						<img src="<?php echo esc_url($icon_url); ?>" />
						<div class="version-author-info">
							<span class="version"><?php printf('Version %s', esc_html($info->version)); ?></span>
							<span class="seperator">|</span>
							<span class="author"><?php echo wp_kses_post($info->author); ?></span>
						</div>
					</div>
					<div class="plugin-title-install clearfix">
						<span class="title" title="<?php echo esc_attr($info->name); ?>">
							<?php
								echo esc_html($info->name);
							?>
						</span>

						<span class="plugin-btn-wrapper plugin-card-<?php echo esc_attr($plugin['slug']); ?>" action_button>
							<a class="<?php echo esc_attr($btn_class); ?>" data-file="<?php echo esc_attr($plugin['filename']); ?>" data-slug="<?php echo esc_attr($plugin['slug']); ?>" href="<?php echo esc_url($btn_url); ?>"><?php echo esc_html($label); ?></a>
						</span>
					</div>
				</div>
			<?php
		} ?>
		</div>
	<?php
	}
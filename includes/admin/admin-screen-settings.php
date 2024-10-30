<?php
namespace HappyFiles;

$setting_user_roles = get_option( HAPPYFILES_SETTING_USER_ROLES, [] );

if ( empty( $setting_user_roles ) ) {
  $setting_user_roles = [];
}

global $wpdb;
?>

<div class="wrap">
	<h1 class="wp-heading-inline" style="margin-bottom: 15px"><?php esc_html_e( 'HappyFiles Settings', 'happyfiles' ); ?></h1>

	<ul id="happyfiles-settings-tabs" class="nav-tab-wrapper">
		<li><a href="#tab-general" class="nav-tab nav-tab-active" data-tab-id="tab-general"><?php esc_html_e( 'General', 'happyfiles' ); ?></a></li>
		<li><a href="#tab-import" class="nav-tab" data-tab-id="tab-import"><?php esc_html_e( 'Import', 'happyfiles' ); ?></a></li>
	</ul>

	<div id="happyfiles-settings-wrapper">
		<form id="happyfiles-settings" action="options.php" method="post">
			<?php settings_fields( HAPPYFILES_SETTINGS_GROUP ); ?>

			<table id="tab-general" class="form-table active" role="presentation">
				<tbody>
					<?php do_action( 'happyfiles_admin_settings_top' ); ?>

					<tr>
						<th><?php esc_html_e( 'Category Editing', 'happyfiles' ); ?></th>
						<td>
							<fieldset>
								<legend class="screen-reader-text"><span><?php esc_html_e( 'Category Editing', 'happyfiles' ); ?></span></legend>

								<?php
								// NOTE: Don't use as we need to save user role name, not the label (e.g.: 'shop_manager' instead of "Shop manager")
								// $user_roles = get_editable_roles();

								global $wp_roles;
								$user_roles = $wp_roles->role_names;

								foreach ( $user_roles as $user_role_name => $user_role_label ) {
									if ( strtolower( $user_role_name ) === 'administrator' ) {
										continue;
									}
									?>

									<label for="<?php echo esc_attr( strtolower( HAPPYFILES_SETTING_USER_ROLES . '_' . $user_role_name ) ); ?>">
									<input name="<?php echo HAPPYFILES_SETTING_USER_ROLES . '[]'; ?>" type="checkbox" id="<?php echo esc_attr( strtolower( HAPPYFILES_SETTING_USER_ROLES . '_' . $user_role_name ) ); ?>" value="<?php echo esc_attr( $user_role_name ); ?>" <?php checked( in_array( $user_role_name, $setting_user_roles ), true, true ); ?>/>
									<?php echo  $user_role_label; ?>
									</label>

									<br>
								<?php } ?>
								<p class="description"><?php esc_html_e( 'Only selected user roles can create, rename, delete, arrange and upload to categories. Administrators always have full control over file categories.', 'happyfiles' ); ?></p>
							</fieldset>
						</td>
					</tr>

					<tr>
						<th><?php esc_html_e( 'Assign multiple categories', 'happyfiles' ); ?></th>
						<td>
							<fieldset>
								<?php $multiple_categories = get_option( HAPPYFILES_SETTING_MULTIPLE_CATEGORIES, false ); ?>
								<label for="<?php echo esc_attr( HAPPYFILES_SETTING_MULTIPLE_CATEGORIES ); ?>">
									<input type="checkbox" name="<?php echo esc_attr( HAPPYFILES_SETTING_MULTIPLE_CATEGORIES ); ?>" id="<?php echo esc_attr( HAPPYFILES_SETTING_MULTIPLE_CATEGORIES ); ?>" value="1" <?php checked( $multiple_categories, true, true ); ?>>
									<?php esc_html_e( 'Enable multiple categories', 'happyfiles' ); ?>
								</label>
								<br>
								<p class="description"><?php esc_html_e( 'Set this option to enable assigning multiple categories. If disabled only a single category can be assigned for each item.', 'happyfiles' ); ?></p>
							</fieldset>
						</td>
					</tr>

					<tr>
						<th><?php esc_html_e( 'Remove from all categories', 'happyfiles' ); ?></th>
						<td>
							<fieldset>
								<?php $remove_from_all_categories = get_option( HAPPYFILES_SETTING_REMOVE_FROM_ALL_CATEGORIES, false ); ?>
								<label for="<?php echo esc_attr( HAPPYFILES_SETTING_REMOVE_FROM_ALL_CATEGORIES ); ?>">
									<input type="checkbox" name="<?php echo esc_attr( HAPPYFILES_SETTING_REMOVE_FROM_ALL_CATEGORIES ); ?>" id="<?php echo esc_attr( HAPPYFILES_SETTING_REMOVE_FROM_ALL_CATEGORIES ); ?>" value="1" <?php checked( $remove_from_all_categories, true, true ); ?>>
									<?php esc_html_e( 'Enable to remove an item from all categories', 'happyfiles' ); ?>
								</label>
								<br>
								<p class="description"><?php esc_html_e( 'When removing a category from an item all other categories of this item will be removed. If disabled only the open category will be removed from an item.', 'happyfiles' ); ?></p>
							</fieldset>
						</td>
					</tr>

					<tr>
						<th><?php esc_html_e( 'Disable AJAX (List View)', 'happyfiles' ); ?></th>
						<td>
							<fieldset>
								<?php $ajax_list_view = get_option( HAPPYFILES_SETTING_LIST_VIEW_DISABLE_AJAX, false ); ?>
								<label for="<?php echo esc_attr( HAPPYFILES_SETTING_LIST_VIEW_DISABLE_AJAX ); ?>">
									<input type="checkbox" name="<?php echo esc_attr( HAPPYFILES_SETTING_LIST_VIEW_DISABLE_AJAX ); ?>" id="<?php echo esc_attr( HAPPYFILES_SETTING_LIST_VIEW_DISABLE_AJAX ); ?>" value="1" <?php checked( $ajax_list_view, true, true ); ?>>
									<?php esc_html_e( 'Disable AJAX refresh in list view (media library)', 'happyfiles' ); ?>
								</label>
								<br>
								<p class="description"><?php esc_html_e( 'Set when you experience problems using plugins alongside HappyFiles that alter the media library list view (such as Imagify).', 'happyfiles' ); ?></p>
							</fieldset>
						</td>
					</tr>

					<tr>
						<th><?php esc_html_e( 'Alternative Count', 'happyfiles' ); ?></th>
						<td>
							<fieldset>
								<?php $alternative_count = get_option( HAPPYFILES_SETTING_ALTERNATIVE_COUNT, false ); ?>
								<label for="<?php echo esc_attr( HAPPYFILES_SETTING_ALTERNATIVE_COUNT ); ?>">
									<input type="checkbox" name="<?php echo esc_attr( HAPPYFILES_SETTING_ALTERNATIVE_COUNT ); ?>" id="<?php echo esc_attr( HAPPYFILES_SETTING_ALTERNATIVE_COUNT ); ?>" value="1" <?php checked( $alternative_count, true, true ); ?>>
									<?php esc_html_e( 'Enable alternative count calculation', 'happyfiles' ); ?>
								</label>
								<br>
								<p class="description"><?php esc_html_e( 'Set when you experience problems using plugins alongside HappyFiles that can alter your media files (such as WPML). Requires more queries.', 'happyfiles' ); ?></p>
							</fieldset>
						</td>
					</tr>

					<tr>
						<th><?php esc_html_e( 'Show ID on hover', 'happyfiles' ); ?></th>
						<td>
							<fieldset>
								<?php $show_category_id_on_hover = get_option( HAPPYFILES_SETTING_SHOW_ID_ON_HOVER, false ); ?>
								<label for="<?php echo esc_attr( HAPPYFILES_SETTING_SHOW_ID_ON_HOVER ); ?>">
									<input type="checkbox" name="<?php echo esc_attr( HAPPYFILES_SETTING_SHOW_ID_ON_HOVER ); ?>" id="<?php echo esc_attr( HAPPYFILES_SETTING_SHOW_ID_ON_HOVER ); ?>" value="1" <?php checked( $show_category_id_on_hover, true, true ); ?>>
									<?php esc_html_e( 'Show ID on hover', 'happyfiles' ); ?>
								</label>
								<br>
								<p class="description"><?php esc_html_e( 'Enable to show the category ID when hovering with your mouse over it. Useful to get IDs for the [happyfiles_gallery] shortcode.', 'happyfiles' ); ?></p>
							</fieldset>
						</td>
					</tr>

					<tr>
						<th><?php esc_html_e( 'Hide rating notification', 'happyfiles' ); ?></th>
						<td>
							<fieldset>
								<?php $hide_rating_notification = get_option( HAPPYFILES_SETTING_HIDE_RATING_NOTIFICATION, false ); ?>
								<label for="<?php echo esc_attr( HAPPYFILES_SETTING_HIDE_RATING_NOTIFICATION ); ?>">
									<input type="checkbox" name="<?php echo esc_attr( HAPPYFILES_SETTING_HIDE_RATING_NOTIFICATION ); ?>" id="<?php echo esc_attr( HAPPYFILES_SETTING_HIDE_RATING_NOTIFICATION ); ?>" value="1" <?php checked( $hide_rating_notification, true, true ); ?>>
									<?php esc_html_e( 'Hide rating notification', 'happyfiles' ); ?>
								</label>
								<br>
								<p class="description"><?php esc_html_e( 'Set in case clicking the HappyFiles rating notification close icon doesn\'t hide it permanently.', 'happyfiles' ); ?></p>
							</fieldset>
						</td>
					</tr>

					<?php do_action( 'happyfiles_admin_settings_bottom' ); ?>
				</tbody>

				<tfoot>
					<tr>
						<td class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_html_e( 'Save Changes', 'happyfiles' ); ?>"></td>
						<td class="delete"><button id="hf-delete-plugin-data" class="button button-primary"><?php esc_html_e( 'Delete Plugin Data', 'happyfiles' ); ?></button></td>
					</tr>
				</tfoot>
			</table>
		</form>

		<table id="tab-import" class="form-table" role="presentation">
			<tbody>
				<?php foreach ( Import::$plugins as $slug => $plugin_data ) { ?>
				<tr id="<?php echo $slug; ?>">
					<th>
						<div><?php echo $plugin_data['name']; ?></div>
					</th>

					<td>
						<?php
						$plugin_folders = Import::$plugins[$slug]['folders'];
						$plugin_attachments = Import::$plugins[$slug]['attachments'];

						if ( count( $plugin_folders ) ) {
							echo '<p class="message">';
							echo sprintf(
								esc_html__( '%s folders and %s attachments found to import.', 'happyfiles' ),
								count( $plugin_folders ),
								count( $plugin_attachments )
							);
							echo '</p><br>';

							echo '<button class="button button-primary happyfiles-import" data-plugin="' . $slug . '">' . esc_html__( 'Import', 'happyfiles' ) . '<span class="spinner"></span></button>';
							echo '<button class="button button-secondary happyfiles-delete" data-plugin="' . $slug . '">' . esc_html__( 'Delete plugin data', 'happyfiles' ) . '<span class="spinner"></span></button>';
						} else {
							esc_html_e( 'No folders found to import.', 'happyfiles' );
						}
						?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

</div>
